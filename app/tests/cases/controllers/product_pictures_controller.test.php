<?php
/* ProductPictures Test cases generated on: 2011-09-30 20:52:28 : 1317433948*/
App::import('Controller', 'ProductPictures');

class TestProductPicturesController extends ProductPicturesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ProductPicturesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.product_picture', 'app.product');

	function startTest() {
		$this->ProductPictures =& new TestProductPicturesController();
		$this->ProductPictures->constructClasses();
	}

	function endTest() {
		unset($this->ProductPictures);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

	function testSetInactive() {

	}

	function testSetActive() {

	}

	function testRequestFind() {

	}

	function testUploadfyAdd() {

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

	function testAdminSetInactive() {

	}

	function testAdminSetActive() {

	}

	function testAdminRequestFind() {

	}

	function testAdminUploadfyAdd() {

	}

}
