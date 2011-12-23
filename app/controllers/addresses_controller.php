<?php
class AddressesController extends AppController {

	var $name = 'Addresses';
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('getAddresses');
	}
	
	function getAddresses($address_id = null) {
		$this->autoRender=false;
		$user_id = $this->Session->read('Auth.User.id');
		if($user_id && $address_id) {
			$this->Address->recursive=-1;
			$address = $this->Address->find('first', array('conditions'=>array('Address.id'=>$address_id, 'Address.user_id'=>$user_id)));
			$address = $address['Address'];
			echo json_encode($address);
		} else {
			echo 'null';
		}
		exit(0);
	}
	
	private function verifyDefaultAddress($data = null) {
		$this->Address->recursive=-1;
		$user_addresses = $this -> Address -> find('all', array('conditions'=>array('Address.id <>'=>$data['Address']['id'])));
		
		if(isset($data['Address']['default']) && $data['Address']['default']) {
			// Asignar como defecto
			foreach($user_addresses as $address) {
				$this->Address->read(null, $address['Address']['id']);
				$this->Address->saveField('default', false);
			}
		} else {
			// No asignar como defecto
			$previous_default_address = null;
			foreach($user_addresses as $address) {
				if($address['default']) {
					$previous_default_address = $address['id'];
					break;
				}
			}
			if(!$previous_default_address) {
				$data['Address']['default'] = true;
				$this->Address->save($data);
			}
		}
	}
	
	function index() {
		$this->Address->recursive = 0;
		$this->set('addresses', $this->paginate());
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->Address->create();
			if ($this->Address->save($this->data)) {
				$this->data['Address']['id'] = $this -> Address -> id;
				$this->verifyDefaultAddress($this->data);
				$this->Session->setFlash(__('The address has been saved', true));
				$this->redirect(array('controller'=>'users', 'action' => 'profile'));
			} else {
				$this->Session->setFlash(__('The address could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Address->User->findById($this->Session->read('Auth.User.id'));
		$user_id = $users['User']['id'];
		$users = array('0'=>$user_id);
		$this->set(compact('users'));
	}
	
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid address', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Address->save($this->data)) {
				$this->verifyDefaultAddress($this->data);
				$this->Session->setFlash(__('The address has been saved', true));
				$this->redirect(array('controller'=>'users', 'action' => 'profile'));
			} else {
				$this->Session->setFlash(__('The address could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Address->read(null, $id);
		}
		$users = $this->Address->User->findById($this->Session->read('Auth.User.id'));
		$user_id = $users['User']['id'];
		$users = array('0'=>$user_id);
		$this->set(compact('users'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid address', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('address', $this->Address->read(null, $id));	
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for address', true));
			$this->redirect(array('controller'=>'users', 'action' => 'profile'));
		}
		if ($this->Address->delete($id)) {
			$this->Session->setFlash(__('Address deleted', true));
			$this->redirect(array('controller'=>'users', 'action' => 'profile'));
		}
		$this->Session->setFlash(__('Address was not deleted', true));
		$this->redirect(array('controller'=>'users', 'action' => 'profile'));
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
		$this->set(compact('users'));
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
		$this->set(compact('users'));
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
