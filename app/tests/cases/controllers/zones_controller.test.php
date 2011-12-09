<?php
/* Zones Test cases generated on: 2011-11-09 10:54:00 : 1320854040*/
App::import('Controller', 'Zones');

class TestZonesController extends ZonesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ZonesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.zone', 'app.city', 'app.country', 'app.address', 'app.user', 'app.role', 'app.order', 'app.deal', 'app.restaurant', 'app.cuisine', 'app.cuisines_deal', 'app.order_state');

	function startTest() {
		$this->Zones =& new TestZonesController();
		$this->Zones->constructClasses();
	}

	function endTest() {
		unset($this->Zones);
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
