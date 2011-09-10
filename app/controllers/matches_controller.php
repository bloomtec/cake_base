<?php
class MatchesController extends AppController {

	var $name = 'Matches';

	function index() {
		$this->Match->recursive = 0;
		$this->set('matches', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid match', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('match', $this->Match->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Match->create();
			if ($this->Match->save($this->data)) {
				$this->Session->setFlash(__('The match has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The match could not be saved. Please, try again.', true));
			}
		}
		$matchStatuses = $this->Match->MatchStatus->find('list');
		$userCreators = $this->Match->UserCreator->find('list');
		$users = $this->Match->User->find('list');
		$this->set(compact('matchStatuses', 'userCreators', 'users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid match', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Match->save($this->data)) {
				$this->Session->setFlash(__('The match has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The match could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Match->read(null, $id);
		}
		$matchStatuses = $this->Match->MatchStatus->find('list');
		$userCreators = $this->Match->UserCreator->find('list');
		$users = $this->Match->User->find('list');
		$this->set(compact('matchStatuses', 'userCreators', 'users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for match', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Match->delete($id)) {
			$this->Session->setFlash(__('Match deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Match was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for match', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Match->read(null,$id);
		$oldData["Match"]["active"]=false;
		if ($this->Match->save($oldData)) {
			$this->Session->setFlash(__('Match archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Match was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for match', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Match->read(null,$id);
		$oldData["Match"]["active"]=true;
		if ($this->Match->save($oldData)) {
			$this->Session->setFlash(__('Match archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Match was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Match->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->Match->recursive = 0;
		$this->set('matches', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid match', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('match', $this->Match->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Match->create();
			if ($this->Match->save($this->data)) {
				$this->Session->setFlash(__('The match has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The match could not be saved. Please, try again.', true));
			}
		}
		$matchStatuses = $this->Match->MatchStatus->find('list');
		$userCreators = $this->Match->UserCreator->find('list');
		$users = $this->Match->User->find('list');
		$this->set(compact('matchStatuses', 'userCreators', 'users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid match', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Match->save($this->data)) {
				$this->Session->setFlash(__('The match has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The match could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Match->read(null, $id);
		}
		$matchStatuses = $this->Match->MatchStatus->find('list');
		$userCreators = $this->Match->UserCreator->find('list');
		$users = $this->Match->User->find('list');
		$this->set(compact('matchStatuses', 'userCreators', 'users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for match', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Match->delete($id)) {
			$this->Session->setFlash(__('Match deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Match was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for match', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Match->read(null,$id);
		$oldData["Match"]["active"]=false;
		if ($this->Match->save($oldData)) {
			$this->Session->setFlash(__('Match archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Match was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for match', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Match->read(null,$id);
		$oldData["Match"]["active"]=true;
		if ($this->Match->save($oldData)) {
			$this->Session->setFlash(__('Match archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Match was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Match->find($type, $findParams);
	}else{
		return null;
	}
}
}
