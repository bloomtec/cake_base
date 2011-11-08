<?php
/* Cuisines Test cases generated on: 2011-11-08 10:32:32 : 1320766352*/
App::import('Controller', 'Cuisines');

class TestCuisinesController extends CuisinesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CuisinesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.cuisine', 'app.deal', 'app.restaurant', 'app.zone', 'app.city', 'app.country', 'app.address', 'app.user', 'app.role', 'app.order', 'app.order_state', 'app.state', 'app.cuisines_deal');

	function startTest() {
		$this->Cuisines =& new TestCuisinesController();
		$this->Cuisines->constructClasses();
	}

	function endTest() {
		unset($this->Cuisines);
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
