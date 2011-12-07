<?php
/* Address Test cases generated on: 2011-11-08 10:16:36 : 1320765396*/
App::import('Model', 'Address');

class AddressTestCase extends CakeTestCase {
	var $fixtures = array('app.address', 'app.user', 'app.role', 'app.city', 'app.order', 'app.country', 'app.state');

	function startTest() {
		$this->Address =& ClassRegistry::init('Address');
	}

	function endTest() {
		unset($this->Address);
		ClassRegistry::flush();
	}

}
