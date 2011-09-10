<?php
class UserTeamStatusesController extends AppController {

	var $name = 'UserTeamStatuses';

	function index() {
		$this->UserTeamStatus->recursive = 0;
		$this->set('userTeamStatuses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user team status', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('userTeamStatus', $this->UserTeamStatus->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->UserTeamStatus->create();
			if ($this->UserTeamStatus->save($this->data)) {
				$this->Session->setFlash(__('The user team status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user team status could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user team status', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->UserTeamStatus->save($this->data)) {
				$this->Session->setFlash(__('The user team status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user team status could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->UserTeamStatus->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user team status', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->UserTeamStatus->delete($id)) {
			$this->Session->setFlash(__('User team status deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User team status was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user team status', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->UserTeamStatus->read(null,$id);
		$oldData["UserTeamStatus"]["active"]=false;
		if ($this->UserTeamStatus->save($oldData)) {
			$this->Session->setFlash(__('User team status archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User team status was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user team status', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->UserTeamStatus->read(null,$id);
		$oldData["UserTeamStatus"]["active"]=true;
		if ($this->UserTeamStatus->save($oldData)) {
			$this->Session->setFlash(__('User team status archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User team status was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->UserTeamStatus->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->UserTeamStatus->recursive = 0;
		$this->set('userTeamStatuses', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user team status', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('userTeamStatus', $this->UserTeamStatus->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->UserTeamStatus->create();
			if ($this->UserTeamStatus->save($this->data)) {
				$this->Session->setFlash(__('The user team status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user team status could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user team status', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->UserTeamStatus->save($this->data)) {
				$this->Session->setFlash(__('The user team status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user team status could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->UserTeamStatus->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user team status', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->UserTeamStatus->delete($id)) {
			$this->Session->setFlash(__('User team status deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User team status was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user team status', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->UserTeamStatus->read(null,$id);
		$oldData["UserTeamStatus"]["active"]=false;
		if ($this->UserTeamStatus->save($oldData)) {
			$this->Session->setFlash(__('User team status archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User team status was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user team status', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->UserTeamStatus->read(null,$id);
		$oldData["UserTeamStatus"]["active"]=true;
		if ($this->UserTeamStatus->save($oldData)) {
			$this->Session->setFlash(__('User team status archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User team status was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->UserTeamStatus->find($type, $findParams);
	}else{
		return null;
	}
}
}
