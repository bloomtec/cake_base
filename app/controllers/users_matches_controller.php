<?php
class UsersMatchesController extends AppController {

	var $name = 'UsersMatches';
	
	function getUsers() {
		
	}
	
	function createMatch() {
		
	}
	
	function getInvites() {
		
	}

	function index() {
		$this->UsersMatch->recursive = 0;
		$this->set('usersMatches', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid users match', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('usersMatch', $this->UsersMatch->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->UsersMatch->create();
			if ($this->UsersMatch->save($this->data)) {
				$this->Session->setFlash(__('The users match has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The users match could not be saved. Please, try again.', true));
			}
		}
		$users = $this->UsersMatch->User->find('list');
		$matches = $this->UsersMatch->Match->find('list');
		$userMatchStatuses = $this->UsersMatch->UserMatchStatus->find('list');
		$this->set(compact('users', 'matches', 'userMatchStatuses'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid users match', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->UsersMatch->save($this->data)) {
				$this->Session->setFlash(__('The users match has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The users match could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->UsersMatch->read(null, $id);
		}
		$users = $this->UsersMatch->User->find('list');
		$matches = $this->UsersMatch->Match->find('list');
		$userMatchStatuses = $this->UsersMatch->UserMatchStatus->find('list');
		$this->set(compact('users', 'matches', 'userMatchStatuses'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for users match', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->UsersMatch->delete($id)) {
			$this->Session->setFlash(__('Users match deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Users match was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for users match', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->UsersMatch->read(null,$id);
		$oldData["UsersMatch"]["active"]=false;
		if ($this->UsersMatch->save($oldData)) {
			$this->Session->setFlash(__('Users match archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Users match was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for users match', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->UsersMatch->read(null,$id);
		$oldData["UsersMatch"]["active"]=true;
		if ($this->UsersMatch->save($oldData)) {
			$this->Session->setFlash(__('Users match archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Users match was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->UsersMatch->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->UsersMatch->recursive = 0;
		$this->set('usersMatches', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid users match', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('usersMatch', $this->UsersMatch->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->UsersMatch->create();
			if ($this->UsersMatch->save($this->data)) {
				$this->Session->setFlash(__('The users match has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The users match could not be saved. Please, try again.', true));
			}
		}
		$users = $this->UsersMatch->User->find('list');
		$matches = $this->UsersMatch->Match->find('list');
		$userMatchStatuses = $this->UsersMatch->UserMatchStatus->find('list');
		$this->set(compact('users', 'matches', 'userMatchStatuses'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid users match', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->UsersMatch->save($this->data)) {
				$this->Session->setFlash(__('The users match has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The users match could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->UsersMatch->read(null, $id);
		}
		$users = $this->UsersMatch->User->find('list');
		$matches = $this->UsersMatch->Match->find('list');
		$userMatchStatuses = $this->UsersMatch->UserMatchStatus->find('list');
		$this->set(compact('users', 'matches', 'userMatchStatuses'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for users match', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->UsersMatch->delete($id)) {
			$this->Session->setFlash(__('Users match deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Users match was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for users match', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->UsersMatch->read(null,$id);
		$oldData["UsersMatch"]["active"]=false;
		if ($this->UsersMatch->save($oldData)) {
			$this->Session->setFlash(__('Users match archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Users match was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for users match', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->UsersMatch->read(null,$id);
		$oldData["UsersMatch"]["active"]=true;
		if ($this->UsersMatch->save($oldData)) {
			$this->Session->setFlash(__('Users match archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Users match was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->UsersMatch->find($type, $findParams);
	}else{
		return null;
	}
}
}
