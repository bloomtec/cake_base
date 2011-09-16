<?php
class UserMatchStatusesController extends AppController {

	var $name = 'UserMatchStatuses';

	function index() {
		$this->UserMatchStatus->recursive = 0;
		$this->set('userMatchStatuses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user match status', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('userMatchStatus', $this->UserMatchStatus->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->UserMatchStatus->create();
			if ($this->UserMatchStatus->save($this->data)) {
				$this->Session->setFlash(__('The user match status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user match status could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user match status', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->UserMatchStatus->save($this->data)) {
				$this->Session->setFlash(__('The user match status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user match status could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->UserMatchStatus->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user match status', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->UserMatchStatus->delete($id)) {
			$this->Session->setFlash(__('User match status deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User match status was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user match status', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->UserMatchStatus->read(null,$id);
		$oldData["UserMatchStatus"]["active"]=false;
		if ($this->UserMatchStatus->save($oldData)) {
			$this->Session->setFlash(__('User match status archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User match status was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user match status', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->UserMatchStatus->read(null,$id);
		$oldData["UserMatchStatus"]["active"]=true;
		if ($this->UserMatchStatus->save($oldData)) {
			$this->Session->setFlash(__('User match status archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User match status was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->UserMatchStatus->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->UserMatchStatus->recursive = 0;
		$this->set('userMatchStatuses', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user match status', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('userMatchStatus', $this->UserMatchStatus->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->UserMatchStatus->create();
			if ($this->UserMatchStatus->save($this->data)) {
				$this->Session->setFlash(__('The user match status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user match status could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user match status', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->UserMatchStatus->save($this->data)) {
				$this->Session->setFlash(__('The user match status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user match status could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->UserMatchStatus->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user match status', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->UserMatchStatus->delete($id)) {
			$this->Session->setFlash(__('User match status deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User match status was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user match status', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->UserMatchStatus->read(null,$id);
		$oldData["UserMatchStatus"]["active"]=false;
		if ($this->UserMatchStatus->save($oldData)) {
			$this->Session->setFlash(__('User match status archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User match status was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user match status', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->UserMatchStatus->read(null,$id);
		$oldData["UserMatchStatus"]["active"]=true;
		if ($this->UserMatchStatus->save($oldData)) {
			$this->Session->setFlash(__('User match status archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User match status was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->UserMatchStatus->find($type, $findParams);
	}else{
		return null;
	}
}
}
