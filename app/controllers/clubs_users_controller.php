<?php
class ClubsUsersController extends AppController {

	var $name = 'ClubsUsers';

	function index() {
		$this->ClubsUser->recursive = 0;
		$this->set('clubsUsers', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid clubs user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('clubsUser', $this->ClubsUser->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ClubsUser->create();
			if ($this->ClubsUser->save($this->data)) {
				$this->Session->setFlash(__('The clubs user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The clubs user could not be saved. Please, try again.', true));
			}
		}
		$clubs = $this->ClubsUser->Club->find('list');
		$users = $this->ClubsUser->User->find('list');
		$this->set(compact('clubs', 'users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid clubs user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ClubsUser->save($this->data)) {
				$this->Session->setFlash(__('The clubs user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The clubs user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ClubsUser->read(null, $id);
		}
		$clubs = $this->ClubsUser->Club->find('list');
		$users = $this->ClubsUser->User->find('list');
		$this->set(compact('clubs', 'users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for clubs user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ClubsUser->delete($id)) {
			$this->Session->setFlash(__('Clubs user deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Clubs user was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for clubs user', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->ClubsUser->read(null,$id);
		$oldData["ClubsUser"]["active"]=false;
		if ($this->ClubsUser->save($oldData)) {
			$this->Session->setFlash(__('Clubs user archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Clubs user was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for clubs user', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->ClubsUser->read(null,$id);
		$oldData["ClubsUser"]["active"]=true;
		if ($this->ClubsUser->save($oldData)) {
			$this->Session->setFlash(__('Clubs user archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Clubs user was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->ClubsUser->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->ClubsUser->recursive = 0;
		$this->set('clubsUsers', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid clubs user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('clubsUser', $this->ClubsUser->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->ClubsUser->create();
			if ($this->ClubsUser->save($this->data)) {
				$this->Session->setFlash(__('The clubs user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The clubs user could not be saved. Please, try again.', true));
			}
		}
		$clubs = $this->ClubsUser->Club->find('list');
		$users = $this->ClubsUser->User->find('list');
		$this->set(compact('clubs', 'users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid clubs user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ClubsUser->save($this->data)) {
				$this->Session->setFlash(__('The clubs user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The clubs user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ClubsUser->read(null, $id);
		}
		$clubs = $this->ClubsUser->Club->find('list');
		$users = $this->ClubsUser->User->find('list');
		$this->set(compact('clubs', 'users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for clubs user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ClubsUser->delete($id)) {
			$this->Session->setFlash(__('Clubs user deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Clubs user was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for clubs user', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->ClubsUser->read(null,$id);
		$oldData["ClubsUser"]["active"]=false;
		if ($this->ClubsUser->save($oldData)) {
			$this->Session->setFlash(__('Clubs user archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Clubs user was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for clubs user', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->ClubsUser->read(null,$id);
		$oldData["ClubsUser"]["active"]=true;
		if ($this->ClubsUser->save($oldData)) {
			$this->Session->setFlash(__('Clubs user archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Clubs user was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->ClubsUser->find($type, $findParams);
	}else{
		return null;
	}
}
}
