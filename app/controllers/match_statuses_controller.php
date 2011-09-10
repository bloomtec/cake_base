<?php
class MatchStatusesController extends AppController {

	var $name = 'MatchStatuses';

	function index() {
		$this->MatchStatus->recursive = 0;
		$this->set('matchStatuses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid match status', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('matchStatus', $this->MatchStatus->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->MatchStatus->create();
			if ($this->MatchStatus->save($this->data)) {
				$this->Session->setFlash(__('The match status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The match status could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid match status', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->MatchStatus->save($this->data)) {
				$this->Session->setFlash(__('The match status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The match status could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->MatchStatus->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for match status', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->MatchStatus->delete($id)) {
			$this->Session->setFlash(__('Match status deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Match status was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for match status', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->MatchStatus->read(null,$id);
		$oldData["MatchStatus"]["active"]=false;
		if ($this->MatchStatus->save($oldData)) {
			$this->Session->setFlash(__('Match status archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Match status was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for match status', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->MatchStatus->read(null,$id);
		$oldData["MatchStatus"]["active"]=true;
		if ($this->MatchStatus->save($oldData)) {
			$this->Session->setFlash(__('Match status archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Match status was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->MatchStatus->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->MatchStatus->recursive = 0;
		$this->set('matchStatuses', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid match status', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('matchStatus', $this->MatchStatus->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->MatchStatus->create();
			if ($this->MatchStatus->save($this->data)) {
				$this->Session->setFlash(__('The match status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The match status could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid match status', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->MatchStatus->save($this->data)) {
				$this->Session->setFlash(__('The match status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The match status could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->MatchStatus->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for match status', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->MatchStatus->delete($id)) {
			$this->Session->setFlash(__('Match status deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Match status was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for match status', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->MatchStatus->read(null,$id);
		$oldData["MatchStatus"]["active"]=false;
		if ($this->MatchStatus->save($oldData)) {
			$this->Session->setFlash(__('Match status archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Match status was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for match status', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->MatchStatus->read(null,$id);
		$oldData["MatchStatus"]["active"]=true;
		if ($this->MatchStatus->save($oldData)) {
			$this->Session->setFlash(__('Match status archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Match status was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->MatchStatus->find($type, $findParams);
	}else{
		return null;
	}
}
}
