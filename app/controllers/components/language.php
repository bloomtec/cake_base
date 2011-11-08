<?php
class LanguageComponent extends Object {
	public $controller = null;
	public $components = array('Cookie');
	public $languages = array();
	public function initialize($controller) {
		$this -> controller = $controller;
		if (empty($languages)) {
			$this -> languages = Configure::read('Config.languages');
		}
		$this -> set();
	}

	public function set($language = null) {
		$saveCookie = false;
		if (empty($language) && isset($this -> controller)) {
			if (!empty($this -> controller -> params['named']['lang'])) {
				$language = $this -> controller -> params['named']['lang'];
			} elseif (!empty($this -> controller -> params['url']['lang'])) {
				$language = $this -> controller -> params['url']['lang'];
			}
			if (!empty($language)) {
				$saveCookie = true;
			}
		}
		if (empty($language)) {
			$language = $this -> Cookie -> read('language');
			if (empty($language)) {
				$saveCookie = true;
			}
		}
		if (empty($language) && !array_key_exists($language, $this -> languages)) {
			$language = Configure::read('Config.language');
		}
		Configure::write('Config.language', $language);
		if ($saveCookie) {
			$this -> Cookie -> write('language', $language, false, '1
year');
		}
	}

}
?>