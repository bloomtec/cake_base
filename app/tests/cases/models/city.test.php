<?php
/* City Test cases generated on: 2011-11-08 10:16:53 : 1320765413*/
App::import('Model', 'City');

class CityTestCase extends CakeTestCase {
	var $fixtures = array('app.city', 'app.country', 'app.address', 'app.user', 'app.role', 'app.order', 'app.state', 'app.zone');

	function startTest() {
		$this->City =& ClassRegistry::init('City');
	}

	function endTest() {
		unset($this->City);
		ClassRegistry::flush();
	}

}
