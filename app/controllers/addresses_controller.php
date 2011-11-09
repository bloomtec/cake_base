<?php
class AddressesController extends AppController {

	var $name = 'Addresses';
	
	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}
	
	function index() {
		$this->Address->recursive = 0;
		$this->set('addresses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid address', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('address', $this->Address->read(null, $id));	
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid address', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Address->save($this->data)) {
				$this->Session->setFlash(__('The address has been saved', true));
				$this->redirect(array('controller'=>'users','action' => 'edit',$this->data['Address']['user_id']));
			} else {
				$this->Session->setFlash(__('The address could not be saved. Please, try again.', true));
				$this->redirect(array('controller'=>'users','action' => 'edit',$this->data['Address']['user_id']));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Address->read(null, $id);
		}
		$users = $this->Address->User->find('list');
		$countries = $this->Address->Country->find('list');
		$cities = $this->Address->City->find('list');
		$this->set(compact('users', 'countries', 'cities'));
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->Address->create();
			if ($this->Address->save($this->data)) {
				$this->Session->setFlash(__('The address has been saved', true));
				$this->redirect(array('controller'=>'users','action' => 'edit',$this->data['Address']['user_id']));
			} else {
				$this->Session->setFlash(__('The address could not be saved. Please, try again.', true));
				$this->redirect(array('controller'=>'users','action' => 'edit',$this->data['Address']['user_id']));
			}
		}
		$users = $this->Address->User->find('list');
		$countries = $this->Address->Country->find('list');
		$cities = $this->Address->City->find('list');
		$this->set(compact('users', 'countries', 'cities'));
	}
	
	function admin_index() {
		$this->Address->recursive = 0;
		$this->set('addresses', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid address', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('address', $this->Address->read(null, $id));	
	}
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->Address->create();
			if ($this->Address->save($this->data)) {
				$this->Session->setFlash(__('The address has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The address could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Address->User->find('list');
		$countries = $this->Address->Country->find('list');
		$cities = $this->Address->City->find('list');
		$this->set(compact('users', 'countries', 'cities'));
	}
	
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid address', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Address->save($this->data)) {
				$this->Session->setFlash(__('The address has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The address could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Address->read(null, $id);
		}
		$users = $this->Address->User->find('list');
		$countries = $this->Address->Country->find('list');
		$cities = $this->Address->City->find('list');
		$this->set(compact('users', 'countries', 'cities'));
	}
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for address', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Address->delete($id)) {
			$this->Session->setFlash(__('Address deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Address was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	

}
