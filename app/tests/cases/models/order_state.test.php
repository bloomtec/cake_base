<?php
/* OrderState Test cases generated on: 2011-11-08 10:19:15 : 1320765555*/
App::import('Model', 'OrderState');

class OrderStateTestCase extends CakeTestCase {
	var $fixtures = array('app.order_state', 'app.order');

	function startTest() {
		$this->OrderState =& ClassRegistry::init('OrderState');
	}

	function endTest() {
		unset($this->OrderState);
		ClassRegistry::flush();
	}

}
