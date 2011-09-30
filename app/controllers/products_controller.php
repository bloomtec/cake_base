<?php
class ProductsController extends AppController {

	var $name = 'Products';

	function index() {
		$this->Product->recursive = 0;
		$this->set('products', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('product', $this->Product->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Product->create();
			if ($this->Product->save($this->data)) {
				$this->Session->setFlash(__('The product has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
			}
		}
		$collections = $this->Product->Collection->find('list');
		$subcategories = $this->Product->Subcategory->find('list');
		$this->set(compact('collections', 'subcategories'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Product->save($this->data)) {
				$this->Session->setFlash(__('The product has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Product->read(null, $id);
		}
		$collections = $this->Product->Collection->find('list');
		$subcategories = $this->Product->Subcategory->find('list');
		$this->set(compact('collections', 'subcategories'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Product->delete($id)) {
			$this->Session->setFlash(__('Product deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Product was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Product->read(null,$id);
		$oldData["Product"]["active"]=false;
		if ($this->Product->save($oldData)) {
			$this->Session->setFlash(__('Product archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Product was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Product->read(null,$id);
		$oldData["Product"]["active"]=true;
		if ($this->Product->save($oldData)) {
			$this->Session->setFlash(__('Product archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Product was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Product->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->Product->recursive = 0;
		$this->set('products', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('product', $this->Product->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Product->create();
			if ($this->Product->save($this->data)) {
				$this->Session->setFlash(__('The product has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
			}
		}
		$collections = $this->Product->Collection->find('list');
		$subcategories = $this->Product->Subcategory->find('list');
		$this->set(compact('collections', 'subcategories'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Product->save($this->data)) {
				$this->Session->setFlash(__('The product has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Product->read(null, $id);
		}
		$collections = $this->Product->Collection->find('list');
		$subcategories = $this->Product->Subcategory->find('list');
		$this->set(compact('collections', 'subcategories'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Product->delete($id)) {
			$this->Session->setFlash(__('Product deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Product was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Product->read(null,$id);
		$oldData["Product"]["active"]=false;
		if ($this->Product->save($oldData)) {
			$this->Session->setFlash(__('Product archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Product was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Product->read(null,$id);
		$oldData["Product"]["active"]=true;
		if ($this->Product->save($oldData)) {
			$this->Session->setFlash(__('Product archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Product was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Product->find($type, $findParams);
	}else{
		return null;
	}
}
}
