<?php
class ProductPicturesController extends AppController {

	var $name = 'ProductPictures';
	var $components = array('Attachment');
	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}

	function index() {
		$this -> ProductPicture -> recursive = 0;
		$this -> set('productPictures', $this -> paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid product picture', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> ProductPicture -> recursive = 0;
		$this -> set('productPictures', $this -> ProductPicture -> find('all', array('conditions' => array('product_id' => $id))));
		$this -> set('parent_id', $id);
		$parent = $this -> ProductPicture -> Product -> read(null, $id);
		if (isset($parent['Product']['name'])) {
			$this -> set('parentName', $parent['Product']['name']);
		} else {
			if (isset($parent['Product']['title']))
				$this -> set('parentName', $parent['Product']['title']);
		}
	}

	function admin_index() {
		$this -> ProductPicture -> recursive = 0;
		$this -> set('productPictures', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid product picture', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> ProductPicture -> recursive = 0;
		$this -> set('productPictures', $this -> ProductPicture -> find('all', array('conditions' => array('product_id' => $id))));
		$this -> set('parent_id', $id);
		$parent = $this -> ProductPicture -> Product -> read(null, $id);
		if (isset($parent['Product']['name'])) {
			$this -> set('parentName', $parent['Product']['name']);
		} else {
			if (isset($parent['Product']['title']))
				$this -> set('parentName', $parent['Product']['title']);
		}
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> ProductPicture -> create();
			if ($this -> ProductPicture -> save($this -> data)) {
				$this -> Session -> setFlash(__('The product picture has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The product picture could not be saved. Please, try again.', true));
			}
		}
		$products = $this -> ProductPicture -> Product -> find('list');
		$this -> set(compact('products'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid product picture', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> ProductPicture -> save($this -> data)) {
				$this -> Session -> setFlash(__('The product picture has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The product picture could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> ProductPicture -> read(null, $id);
		}
		$products = $this -> ProductPicture -> Product -> find('list');
		$this -> set(compact('products'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for product picture', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> ProductPicture -> delete($id)) {
			$this -> Session -> setFlash(__('Product picture deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Product picture was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_reOrder() {
		foreach ($this->data["Item"] as $id => $position) {
			$this -> ProductPicture -> id = $id;
			$this -> ProductPicture -> saveField("sort", $position);
		}
		echo true;
		Configure::write('debug', 0);
		$this -> autoRender = false;
		exit();
	}

}
