<?php
class ConfigController extends AppController {

	var $name = 'Config';

	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}

	function admin_edit($id = 1) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Configuración no válida', true));
		}
		if (!empty($this -> data)) {
			if ($this -> Config -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se guardó la configuración', true));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar la configuración. Por favor, intente de nuevo.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Config -> read(null, $id);
		}

	}

}
