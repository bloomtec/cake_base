<?php
/* Deals Test cases generated on: 2011-11-08 10:31:52 : 1320766312*/
App::import('Controller', 'Deals');

class TestDealsController extends DealsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DealsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.deal', 'app.restaurant', 'app.zone', 'app.city', 'app.country', 'app.address', 'app.user', 'app.role', 'app.order', 'app.order_state', 'app.state', 'app.cuisine', 'app.cuisines_deal');

	function startTest() {
		$this->Deals =& new TestDealsController();
		$this->Deals->constructClasses();
	}

	function endTest() {
		unset($this->Deals);
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
