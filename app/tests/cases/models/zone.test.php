<?php
/* Zone Test cases generated on: 2011-11-08 10:20:21 : 1320765621*/
App::import('Model', 'Zone');

class ZoneTestCase extends CakeTestCase {
	var $fixtures = array('app.zone', 'app.city', 'app.country', 'app.address', 'app.user', 'app.role', 'app.order', 'app.deal', 'app.restaurant', 'app.cuisine', 'app.cuisines_deal', 'app.order_state', 'app.state');

	function startTest() {
		$this->Zone =& ClassRegistry::init('Zone');
	}

	function endTest() {
		unset($this->Zone);
		ClassRegistry::flush();
	}

}
