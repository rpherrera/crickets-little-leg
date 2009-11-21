<?php 
/* SVN FILE: $Id$ */
/* Entry Fixture generated on: 2009-11-19 15:45:30 : 1258652730*/

class EntryFixture extends CakeTestFixture {
	var $name = 'Entry';
	var $table = 'entries';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'ip_address' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 15),
		'user' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'password' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 256),
		'incident_time' => array('type'=>'datetime', 'null' => false, 'default' => NULL),
		'created' => array('type'=>'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => false, 'default' => NULL),
		'country' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 256),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id'  => 1,
		'ip_address'  => 'Lorem ipsum d',
		'user'  => 'Lorem ipsum dolor sit amet',
		'password'  => 'Lorem ipsum dolor sit amet',
		'incident_time'  => '2009-11-19 15:45:30',
		'created'  => '2009-11-19 15:45:30',
		'modified'  => '2009-11-19 15:45:30',
		'country'  => 'Lorem ipsum dolor sit amet'
	));
}
?>