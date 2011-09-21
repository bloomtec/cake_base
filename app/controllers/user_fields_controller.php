<?php
class UserFieldsController extends AppController {

	var $name = 'UserFields';
	
	function searchUsersByNameSurname($nombre = null) {
		$this -> autoRender = false;
		$criteria = null;
		if(isset($nombre) && !empty($nombre)) {
			$criteria = $nombre;
		} else {
			$criteria = "";
		}
		$result = $this -> UserField -> find(
			'list',
			array(
				'recursive' => -1,
				'conditions' => array(
					'OR' => array(
						'UserField.name LIKE' => "%$criteria%",
						'UserField.surname LIKE' => "%$criteria%"
					),
					'NOT' => array(
						'UserField.user_id' => $this->Session->read('Auth.User.id')
					)
				),
				'fields' => array(
					'UserField.user_id'
				)
			)
		);
		return $result;
	}

	function index() {
		$this->UserField->recursive = 0;
		$this->set('userFields', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user field', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('userField', $this->UserField->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->UserField->create();
			if ($this->UserField->save($this->data)) {
				$this->Session->setFlash(__('The user field has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user field could not be saved. Please, try again.', true));
			}
		}
		$users = $this->UserField->User->find('list');
		$feets = $this->UserField->Feet->find('list');
		$this->set(compact('users', 'feets'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user field', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->UserField->save($this->data)) {
				$this->Session->setFlash(__('The user field has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user field could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->UserField->read(null, $id);
		}
		$users = $this->UserField->User->find('list');
		$feets = $this->UserField->Feet->find('list');
		$this->set(compact('users', 'feets'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user field', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->UserField->delete($id)) {
			$this->Session->setFlash(__('User field deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User field was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user field', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->UserField->read(null,$id);
		$oldData["UserField"]["active"]=false;
		if ($this->UserField->save($oldData)) {
			$this->Session->setFlash(__('User field archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User field was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user field', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->UserField->read(null,$id);
		$oldData["UserField"]["active"]=true;
		if ($this->UserField->save($oldData)) {
			$this->Session->setFlash(__('User field archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User field was not archived', true));
		$this->redirect(array('action' => 'index'));
	}

	function requestFind($type,$findParams,$key) {
		if($key==Configure::read("key")){
			return $this->UserField->find($type, $findParams);
		}else{
			return null;
		}
	}
	
	function admin_index() {
		$this->UserField->recursive = 0;
		$this->set('userFields', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user field', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('userField', $this->UserField->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->UserField->create();
			if ($this->UserField->save($this->data)) {
				$this->Session->setFlash(__('The user field has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user field could not be saved. Please, try again.', true));
			}
		}
		$users = $this->UserField->User->find('list');
		$feets = $this->UserField->Feet->find('list');
		$this->set(compact('users', 'feets'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user field', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->UserField->save($this->data)) {
				$this->Session->setFlash(__('The user field has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user field could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->UserField->read(null, $id);
		}
		$users = $this->UserField->User->find('list');
		$feets = $this->UserField->Feet->find('list');
		$this->set(compact('users', 'feets'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user field', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->UserField->delete($id)) {
			$this->Session->setFlash(__('User field deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User field was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user field', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->UserField->read(null,$id);
		$oldData["UserField"]["active"]=false;
		if ($this->UserField->save($oldData)) {
			$this->Session->setFlash(__('User field archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User field was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user field', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->UserField->read(null,$id);
		$oldData["UserField"]["active"]=true;
		if ($this->UserField->save($oldData)) {
			$this->Session->setFlash(__('User field archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User field was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_requestFind($type,$findParams,$key) {
		if($key==Configure::read("key")){
			return $this->UserField->find($type, $findParams);
		}else{
			return null;
		}
	}
}