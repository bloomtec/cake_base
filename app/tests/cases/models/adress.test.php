<?php
/* Adress Test cases generated on: 2011-11-08 10:05:50 : 1320764750*/
App::import('Model', 'Adress');

class AdressTestCase extends CakeTestCase {
	var $fixtures = array('app.adress', 'app.user', 'app.role', 'app.city', 'app.order', 'app.country', 'app.state');

	function startTest() {
		$this->Adress =& ClassRegistry::init('Adress');
	}

	function endTest() {
		unset($this->Adress);
		ClassRegistry::flush();
	}

}
