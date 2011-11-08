<?php
/* Deal Test cases generated on: 2011-11-08 10:18:59 : 1320765539*/
App::import('Model', 'Deal');

class DealTestCase extends CakeTestCase {
	var $fixtures = array('app.deal', 'app.restaurant', 'app.order', 'app.cuisine', 'app.cuisines_deal');

	function startTest() {
		$this->Deal =& ClassRegistry::init('Deal');
	}

	function endTest() {
		unset($this->Deal);
		ClassRegistry::flush();
	}

}
