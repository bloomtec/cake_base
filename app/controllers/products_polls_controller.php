<?php
class ProductsPollsController extends AppController {

	var $name = 'ProductsPolls';
	
	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}
	
	function index() {
		$this->ProductsPoll->recursive = 0;
		$this->set('productsPolls', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid products poll', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('productsPoll', $this->ProductsPoll->read(null, $id));	
	}
	
	
	function admin_index() {
		$this->ProductsPoll->recursive = 0;
		$this->set('productsPolls', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid products poll', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('productsPoll', $this->ProductsPoll->read(null, $id));	
	}
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->ProductsPoll->create();
			if ($this->ProductsPoll->save($this->data)) {
				$this->Session->setFlash(__('The products poll has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The products poll could not be saved. Please, try again.', true));
			}
		}
		$users = $this->ProductsPoll->User->find('list');
		$products = $this->ProductsPoll->Product->find('list');
		$this->set(compact('users', 'products'));
	}
	
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid products poll', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ProductsPoll->save($this->data)) {
				$this->Session->setFlash(__('The products poll has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The products poll could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ProductsPoll->read(null, $id);
		}
		$users = $this->ProductsPoll->User->find('list');
		$products = $this->ProductsPoll->Product->find('list');
		$this->set(compact('users', 'products'));
	}
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for products poll', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ProductsPoll->delete($id)) {
			$this->Session->setFlash(__('Products poll deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Products poll was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	

}
