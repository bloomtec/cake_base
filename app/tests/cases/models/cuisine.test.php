<?php
/* Cuisine Test cases generated on: 2011-11-08 10:18:34 : 1320765514*/
App::import('Model', 'Cuisine');

class CuisineTestCase extends CakeTestCase {
	var $fixtures = array('app.cuisine', 'app.deal', 'app.cuisines_deal');

	function startTest() {
		$this->Cuisine =& ClassRegistry::init('Cuisine');
	}

	function endTest() {
		unset($this->Cuisine);
		ClassRegistry::flush();
	}

}
