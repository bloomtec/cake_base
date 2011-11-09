<?php
/* Addresses Test cases generated on: 2011-11-08 19:23:00 : 1320798180*/
App::import('Controller', 'Addresses');

class TestAddressesController extends AddressesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class AddressesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.address', 'app.user', 'app.role', 'app.city', 'app.country', 'app.zone', 'app.restaurant', 'app.deal', 'app.order', 'app.order_state', 'app.cuisine', 'app.cuisines_deal');

	function startTest() {
		$this->Addresses =& new TestAddressesController();
		$this->Addresses->constructClasses();
	}

	function endTest() {
		unset($this->Addresses);
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
