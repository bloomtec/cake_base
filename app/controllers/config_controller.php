<?php
class ConfigController extends AppController {

	var $name = 'Config';

	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}

	function admin_edit($id = 1) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid city', true));

		}
		if (!empty($this -> data)) {
			if ($this -> Config -> save($this -> data)) {
				$this -> Session -> setFlash(__('The configuration has been saved', true));
			} else {
				$this -> Session -> setFlash(__('The configuration could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Config -> read(null, $id);
		}

	}

}
