<?php 
/* SVN FILE: $Id$ */
/* Entry Test cases generated on: 2009-11-19 15:45:30 : 1258652730*/
App::import('Model', 'Entry');

class EntryTestCase extends CakeTestCase {
	var $Entry = null;
	var $fixtures = array('app.entry');

	function startTest() {
		$this->Entry =& ClassRegistry::init('Entry');
	}

	function testEntryInstance() {
		$this->assertTrue(is_a($this->Entry, 'Entry'));
	}

	function testEntryFind() {
		$this->Entry->recursive = -1;
		$results = $this->Entry->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Entry' => array(
			'id'  => 1,
			'ip_address'  => 'Lorem ipsum d',
			'user'  => 'Lorem ipsum dolor sit amet',
			'password'  => 'Lorem ipsum dolor sit amet',
			'incident_time'  => '2009-11-19 15:45:30',
			'created'  => '2009-11-19 15:45:30',
			'modified'  => '2009-11-19 15:45:30',
			'country'  => 'Lorem ipsum dolor sit amet'
		));
		$this->assertEqual($results, $expected);
	}
}
?>