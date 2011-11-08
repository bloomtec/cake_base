<?php
/* User Test cases generated on: 2011-11-08 10:15:45 : 1320765345*/
App::import('Model', 'User');

class UserTestCase extends CakeTestCase {
	var $fixtures = array('app.user', 'app.role', 'app.city', 'app.address', 'app.order');

	function startTest() {
		$this->User =& ClassRegistry::init('User');
	}

	function endTest() {
		unset($this->User);
		ClassRegistry::flush();
	}

}
