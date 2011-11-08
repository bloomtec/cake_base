<?php
class OrdersController extends AppController {

	var $name = 'Orders';
	
	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}
	
	function index() {
		$this->Order->recursive = 0;
		$this->set('orders', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid order', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('order', $this->Order->read(null, $id));	
	}
	
	
	function admin_index() {
		$this->Order->recursive = 0;
		$this->set('orders', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid order', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('order', $this->Order->read(null, $id));	
	}
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->Order->create();
			if ($this->Order->save($this->data)) {
				$this->Session->setFlash(__('The order has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The order could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Order->User->find('list');
		$addresses = $this->Order->Address->find('list');
		$deals = $this->Order->Deal->find('list');
		$orderStates = $this->Order->OrderState->find('list');
		$this->set(compact('users', 'addresses', 'deals', 'orderStates'));
	}
	
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid order', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Order->save($this->data)) {
				$this->Session->setFlash(__('The order has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The order could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Order->read(null, $id);
		}
		$users = $this->Order->User->find('list');
		$addresses = $this->Order->Address->find('list');
		$deals = $this->Order->Deal->find('list');
		$orderStates = $this->Order->OrderState->find('list');
		$this->set(compact('users', 'addresses', 'deals', 'orderStates'));
	}
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for order', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Order->delete($id)) {
			$this->Session->setFlash(__('Order deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Order was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	

}
