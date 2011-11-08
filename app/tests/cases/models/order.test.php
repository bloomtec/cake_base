<?php
/* Order Test cases generated on: 2011-11-08 10:19:32 : 1320765572*/
App::import('Model', 'Order');

class OrderTestCase extends CakeTestCase {
	var $fixtures = array('app.order', 'app.user', 'app.role', 'app.city', 'app.country', 'app.address', 'app.state', 'app.zone', 'app.deal', 'app.restaurant', 'app.cuisine', 'app.cuisines_deal', 'app.order_state');

	function startTest() {
		$this->Order =& ClassRegistry::init('Order');
	}

	function endTest() {
		unset($this->Order);
		ClassRegistry::flush();
	}

}
