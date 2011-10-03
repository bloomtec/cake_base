<?php
/* ProductPicture Test cases generated on: 2011-09-30 14:43:44 : 1317411824*/
App::import('Model', 'ProductPicture');

class ProductPictureTestCase extends CakeTestCase {
	var $fixtures = array('app.product_picture', 'app.product');

	function startTest() {
		$this->ProductPicture =& ClassRegistry::init('ProductPicture');
	}

	function endTest() {
		unset($this->ProductPicture);
		ClassRegistry::flush();
	}

}
