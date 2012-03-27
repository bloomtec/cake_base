<?php
/* Orders Test cases generated on: 2011-11-08 10:31:09 : 1320766269*/
App::import('Controller', 'Orders');

class TestOrdersController extends OrdersController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class OrdersControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.order', 'app.user', 'app.role', 'app.city', 'app.country', 'app.address', 'app.state', 'app.order_state', 'app.zone', 'app.restaurant', 'app.deal', 'app.cuisine', 'app.cuisines_deal');

	function startTest() {
		$this->Orders =& new TestOrdersController();
		$this->Orders->constructClasses();
	}

	function endTest() {
		unset($this->Orders);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdminIndex() {

	}

	function testAdminView() {

	}

	function testAdminAdd() {

	}

	function testAdminEdit() {

	}

	function testAdminDelete() {

	}

}
