<?php
/* Country Test cases generated on: 2011-11-08 10:17:15 : 1320765435*/
App::import('Model', 'Country');

class CountryTestCase extends CakeTestCase {
	var $fixtures = array('app.country', 'app.address', 'app.user', 'app.role', 'app.city', 'app.zone', 'app.order', 'app.state');

	function startTest() {
		$this->Country =& ClassRegistry::init('Country');
	}

	function endTest() {
		unset($this->Country);
		ClassRegistry::flush();
	}

}
