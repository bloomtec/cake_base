<?php
/* State Test cases generated on: 2011-11-08 10:20:09 : 1320765609*/
App::import('Model', 'State');

class StateTestCase extends CakeTestCase {
	var $fixtures = array('app.state', 'app.address', 'app.user', 'app.role', 'app.city', 'app.country', 'app.zone', 'app.order', 'app.deal', 'app.restaurant', 'app.cuisine', 'app.cuisines_deal', 'app.order_state');

	function startTest() {
		$this->State =& ClassRegistry::init('State');
	}

	function endTest() {
		unset($this->State);
		ClassRegistry::flush();
	}

}
