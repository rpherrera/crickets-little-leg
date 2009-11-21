<?php
class Entry extends AppModel {

    var $name = 'Entry';

	function findUniqueIPAddressesWithoutCountry() {
		$uniqueIPAddresses = $this->find(
			'all',
			array(
				'fields' => array('DISTINCT Entry.ip_address'),
				'conditions' => array('Entry.country' => null)
			)
		);

		return set::Extract('*/Entry/ip_address', $uniqueIPAddresses);
	}

	function updateCountries($ipsAndCountries) {
		if (empty($ipsAndCountries) || !is_array($ipsAndCountries)) {
			return false;
		}

		foreach ($ipsAndCountries as $ip => $country) {
			$this->updateAll(
				array('Entry.country' => '\''.$country.'\''),
				array('Entry.ip_address' => $ip)
			);
		}

	}

}
?>