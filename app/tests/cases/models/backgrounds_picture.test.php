<?php
/* BackgroundsPicture Test cases generated on: 2011-10-25 11:48:19 : 1319561299*/
App::import('Model', 'BackgroundsPicture');

class BackgroundsPictureTestCase extends CakeTestCase {
	var $fixtures = array('app.backgrounds_picture');

	function startTest() {
		$this->BackgroundsPicture =& ClassRegistry::init('BackgroundsPicture');
	}

	function endTest() {
		unset($this->BackgroundsPicture);
		ClassRegistry::flush();
	}

}
