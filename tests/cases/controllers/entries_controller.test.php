<?php 
/* SVN FILE: $Id$ */
/* EntriesController Test cases generated on: 2009-11-19 15:46:05 : 1258652765*/
App::import('Controller', 'Entries');

class TestEntries extends EntriesController {
	var $autoRender = false;
}

class EntriesControllerTest extends CakeTestCase {
	var $Entries = null;

	function startTest() {
		$this->Entries = new TestEntries();
		$this->Entries->constructClasses();
	}

	function testEntriesControllerInstance() {
		$this->assertTrue(is_a($this->Entries, 'EntriesController'));
	}

	function endTest() {
		unset($this->Entries);
	}
}
?>