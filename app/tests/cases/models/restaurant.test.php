<?php
/* Restaurant Test cases generated on: 2011-11-08 10:19:48 : 1320765588*/
App::import('Model', 'Restaurant');

class RestaurantTestCase extends CakeTestCase {
	var $fixtures = array('app.restaurant', 'app.zone', 'app.deal', 'app.order', 'app.user', 'app.role', 'app.city', 'app.country', 'app.address', 'app.state', 'app.order_state', 'app.cuisine', 'app.cuisines_deal');

	function startTest() {
		$this->Restaurant =& ClassRegistry::init('Restaurant');
	}

	function endTest() {
		unset($this->Restaurant);
		ClassRegistry::flush();
	}

}
