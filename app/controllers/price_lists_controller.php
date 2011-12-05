<?php
class PriceListsController extends AppController {

	var $name = 'PriceLists';

	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}

	function download() {
		$list = $this -> PriceList -> find('first');
		$this -> view = 'Media';
		$fileParts = pathinfo($list['PriceList']['path']);
		//debug(APP.'webroot/img/uploads/'.$fileParts['basename'].DS );
		$params = array(
			'id' => $fileParts['basename'], 
			'name' => $fileParts['filename'], 
			'download' => true, 
			'extension' => $fileParts['extension'], // must be lower case
			'path' => APP.'webroot/files/uploads'.DS  // don't forget terminal 'DS'
		);
		$this -> set($params);

	}

	function admin_index() {
		$this -> PriceList -> recursive = 0;
		$this -> set('priceLists', $this -> paginate());
	}

	function admin_view($id = null) {
		$list = $this -> PriceList -> read(null, $id);
		$this -> view = 'Media';
		$fileParts = pathinfo($list['PriceList']['path']);
		//debug(APP.'webroot/img/uploads/'.$fileParts['basename'].DS );
		$params = array(
			'id' => $fileParts['basename'], 
			'name' => $fileParts['filename'], 
			'download' => true, 
			'extension' => $fileParts['extension'], // must be lower case
			'path' => APP.'webroot/files/uploads'.DS  // don't forget terminal 'DS'
		);
		$this -> set($params);

	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> PriceList -> create();
			if ($this -> PriceList -> save($this -> data)) {
				$this -> Session -> setFlash(__('Lista de precio subida con éxito', true));
				echo true;
			} else {
				echo false;
			}
			$this -> autoRender = false;
			Configure::write('debug', 0);
			exit(0);
		}

	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid price list', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> PriceList -> save($this -> data)) {
				$this -> Session -> setFlash(__('The price list has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The price list could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> PriceList -> read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for price list', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> PriceList -> delete($id)) {
			$this -> Session -> setFlash(__('Price list deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Price list was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

}
