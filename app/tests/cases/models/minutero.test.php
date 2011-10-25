<?php
/* Minutero Test cases generated on: 2011-10-25 17:42:47 : 1319582567*/
App::import('Model', 'Minutero');

class MinuteroTestCase extends CakeTestCase {
	var $fixtures = array('app.minutero');

	function startTest() {
		$this->Minutero =& ClassRegistry::init('Minutero');
	}

	function endTest() {
		unset($this->Minutero);
		ClassRegistry::flush();
	}

}
