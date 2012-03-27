<?php
/* Prizes Test cases generated on: 2012-01-10 11:59:03 : 1326214743*/
App::import('Controller', 'Prizes');

class TestPrizesController extends PrizesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PrizesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.prize');

	function startTest() {
		$this->Prizes =& new TestPrizesController();
		$this->Prizes->constructClasses();
	}

	function endTest() {
		unset($this->Prizes);
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
