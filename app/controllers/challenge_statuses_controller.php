<?php
class ChallengeStatusesController extends AppController {

	var $name = 'ChallengeStatuses';

	function index() {
		$this->ChallengeStatus->recursive = 0;
		$this->set('challengeStatuses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid challenge status', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('challengeStatus', $this->ChallengeStatus->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ChallengeStatus->create();
			if ($this->ChallengeStatus->save($this->data)) {
				$this->Session->setFlash(__('The challenge status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The challenge status could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid challenge status', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ChallengeStatus->save($this->data)) {
				$this->Session->setFlash(__('The challenge status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The challenge status could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ChallengeStatus->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for challenge status', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ChallengeStatus->delete($id)) {
			$this->Session->setFlash(__('Challenge status deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Challenge status was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for challenge status', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->ChallengeStatus->read(null,$id);
		$oldData["ChallengeStatus"]["active"]=false;
		if ($this->ChallengeStatus->save($oldData)) {
			$this->Session->setFlash(__('Challenge status archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Challenge status was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for challenge status', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->ChallengeStatus->read(null,$id);
		$oldData["ChallengeStatus"]["active"]=true;
		if ($this->ChallengeStatus->save($oldData)) {
			$this->Session->setFlash(__('Challenge status archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Challenge status was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->ChallengeStatus->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->ChallengeStatus->recursive = 0;
		$this->set('challengeStatuses', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid challenge status', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('challengeStatus', $this->ChallengeStatus->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->ChallengeStatus->create();
			if ($this->ChallengeStatus->save($this->data)) {
				$this->Session->setFlash(__('The challenge status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The challenge status could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid challenge status', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ChallengeStatus->save($this->data)) {
				$this->Session->setFlash(__('The challenge status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The challenge status could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ChallengeStatus->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for challenge status', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ChallengeStatus->delete($id)) {
			$this->Session->setFlash(__('Challenge status deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Challenge status was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for challenge status', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->ChallengeStatus->read(null,$id);
		$oldData["ChallengeStatus"]["active"]=false;
		if ($this->ChallengeStatus->save($oldData)) {
			$this->Session->setFlash(__('Challenge status archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Challenge status was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for challenge status', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->ChallengeStatus->read(null,$id);
		$oldData["ChallengeStatus"]["active"]=true;
		if ($this->ChallengeStatus->save($oldData)) {
			$this->Session->setFlash(__('Challenge status archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Challenge status was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->ChallengeStatus->find($type, $findParams);
	}else{
		return null;
	}
}
}
