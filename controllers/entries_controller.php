<?php
class EntriesController extends AppController {

    var $name = 'Entries';
    var $components = array("Geoip");
    var $helpers = array('Html', 'Form');
    var $paginate = array(
        'limit' => 20
    );

    function beforeFilter()
    {
        parent::beforeFilter();
    }

    function index() {
        $this->redirect(array('action'=>'show'));
    }

    function show( $data_inicial = null, $data_final = null ) {
        if( (!empty($data_inicial) && !empty($data_final)) || (!empty($this->data['data_inicial']) && !empty($this->data['data_final'])) )
        {
            if(empty($data_inicial) || empty($data_final))
            {
                $data_inicial = strtotime($this->data['data_inicial']['year'].'-'.$this->data['data_inicial']['month'].'-'.$this->data['data_inicial']['day'].' '.$this->data['data_inicial']['hour'].':'.$this->data['data_inicial']['min'].':00');

                $data_final = strtotime($this->data['data_final']['year'].'-'.$this->data['data_final']['month'].'-'.$this->data['data_final']['day'].' '.$this->data['data_final']['hour'].':'.$this->data['data_final']['min'].':00');
            }

            $paginate_conditions = array(
                    'Entry.incident_time BETWEEN ? AND ?' => array(
                        date('Y-m-d H:i:s', $data_inicial),
                        date('Y-m-d H:i:s', $data_final)
                    )
                );
            $this->set('no_busca', false);
        }
        else
        {
            $paginate_conditions = array();
            $data_inicial = strtotime('now');
            $data_final = strtotime('now');
            
            $this->set('no_busca', true);
        }

        $this->set('data_inicial', date('Y-m-d H:i:s', $data_inicial));
        $this->set('data_final', date('Y-m-d H:i:s', $data_final));

	$this->set('entries', $this->paginate('Entry', $paginate_conditions));
    }

    private function _getFileContents( $filePath )
    {
        if( file_exists($filePath) )
        {
            return file_get_contents( $filePath );
        }
        else
        {
            return false;
        }
    }

    function add() {

        if( !empty($this->data) )
        {
            if( !empty($this->data['Entry']['logfile']['tmp_name']) )
            {
                $logContent = $this->_getFileContents( $this->data['Entry']['logfile']['tmp_name'] );
            }
            else if( !empty($this->data['Entry']['logpath']) )
            {
                $logContent = $this->_getFileContents( $this->data['Entry']['logpath'] );
            }

            if( $logContent !== false )
            {
                $return = $this->_fazAParada( $logContent );

		$uniqueIPAddresses = $this->Entry->findUniqueIPAddressesWithoutCountry();
		$ipsAndCountrys = $this->_identifyAttackersCountries($uniqueIPAddresses);
		$this->Entry->updateCountries($ipsAndCountrys);

                $this->Session->setFlash('There was '.$return.' entries saved.');
                $this->redirect( array('action' => 'show') );
            }
            else
            {
                $this->Session->setFlash(__('Couldn\'t read the specified file.', true));
            }
        }
    }

    private function _fazAParada( $log_content )
    {
        // incident_time
        $regex =  "/(?P<incident_time>(\w{3})\s(\d{1,2})\s(((\d){2}:){2}\d{2}))\s";
        // ssh-service
        $regex .= "[^\s]+\ssshd\[\d+\]:\sFailed\spassword\sfor\s";
        // user
        $regex .= "(invalid\suser\s)?(?P<user>[^\s]+)\s";
        // ip
        $regex .= "from\s(?P<ip_address>[^\s]+)\s/";
        $regex_matches = preg_match_all($regex, $log_content, $matches);

        set_time_limit( 3600 );

	$matches = array(
	      'incident_time' => $matches['incident_time'],
	      'user' => $matches['user'],
	      'ip_address' => $matches['ip_address']
	);

	$data_set = array('Entry' => array());

        for( $i = 0; $i < $regex_matches; ++$i )
        {
	    array_push($data_set['Entry'], array(
		'user' => $matches['user'][$i],
		'incident_time' => date('Y-m-d H:i:s', strtotime($matches['incident_time'][$i])),
		'ip_address' => $matches['ip_address'][$i]
	    ));
        }

	$matches = null;

	$this->Entry->create();
	if (! $this->Entry->saveAll($data_set['Entry']))
	{
		$regex_matches = 0;
	}

	$filtered_data = null;

	return $regex_matches;

    }

    function delete($id = null) {
	    if (!$id) {
		    $this->Session->setFlash(__('Invalid id for Entry', true));
		    $this->redirect(array('action'=>'index'));
	    }
	    if ($this->Entry->del($id)) {
		    $this->Session->setFlash(__('Entry deleted', true));
		    $this->redirect(array('action'=>'index'));
	    }
    }

    function iptables() {
	    $entries = $this->Entry->find(
		'all',
		array(
		    'fields' => array('Entry.ip_address'),
		    'group' => array('Entry.ip_address')
		)
	    );

	    $ip_entries = Set::extract('*/Entry/ip_address', $entries);
	    $this->set('ip_entries', $ip_entries);
    }

    function _identifyAttackersCountries($ips) {
	if (empty($ips) || !is_array($ips)) {
		return false;
	}

	$ipsAndCountrys = array();

	foreach ($ips as $key => $ip) {
		$ipsAndCountries[$ip] = $this->Geoip->countryCode($ip);
	}

	$ips = null;
	return $ipsAndCountries;
    }

}
?>
