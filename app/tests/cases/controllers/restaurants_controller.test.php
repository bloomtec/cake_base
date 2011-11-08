<?php
/* Restaurants Test cases generated on: 2011-11-08 10:40:57 : 1320766857*/
App::import('Controller', 'Restaurants');

class TestRestaurantsController extends RestaurantsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class RestaurantsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.restaurant', 'app.zone', 'app.city', 'app.country', 'app.address', 'app.user', 'app.role', 'app.order', 'app.deal', 'app.cuisine', 'app.cuisines_deal', 'app.order_state', 'app.state');

	function startTest() {
		$this->Restaurants =& new TestRestaurantsController();
		$this->Restaurants->constructClasses();
	}

	function endTest() {
		unset($this->Restaurants);
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
