<?php
/* Prize Test cases generated on: 2012-01-10 11:58:32 : 1326214712*/
App::import('Model', 'Prize');

class PrizeTestCase extends CakeTestCase {
	var $fixtures = array('app.prize');

	function startTest() {
		$this->Prize =& ClassRegistry::init('Prize');
	}

	function endTest() {
		unset($this->Prize);
		ClassRegistry::flush();
	}

}
