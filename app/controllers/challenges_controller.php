<?php
class ChallengesController extends AppController {

	var $name = 'Challenges';

	function index() {
		$this->Challenge->recursive = 0;
		$this->set('challenges', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid challenge', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('challenge', $this->Challenge->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Challenge->create();
			if ($this->Challenge->save($this->data)) {
				$this->Session->setFlash(__('The challenge has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The challenge could not be saved. Please, try again.', true));
			}
		}
		$challengeStatuses = $this->Challenge->ChallengeStatus->find('list');
		$teamChallengers = $this->Challenge->TeamChallenger->find('list');
		$teamChallengeds = $this->Challenge->TeamChallenged->find('list');
		$userChallengers = $this->Challenge->UserChallenger->find('list');
		$userDecideds = $this->Challenge->UserDecided->find('list');
		$this->set(compact('challengeStatuses', 'teamChallengers', 'teamChallengeds', 'userChallengers', 'userDecideds'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid challenge', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Challenge->save($this->data)) {
				$this->Session->setFlash(__('The challenge has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The challenge could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Challenge->read(null, $id);
		}
		$challengeStatuses = $this->Challenge->ChallengeStatus->find('list');
		$teamChallengers = $this->Challenge->TeamChallenger->find('list');
		$teamChallengeds = $this->Challenge->TeamChallenged->find('list');
		$userChallengers = $this->Challenge->UserChallenger->find('list');
		$userDecideds = $this->Challenge->UserDecided->find('list');
		$this->set(compact('challengeStatuses', 'teamChallengers', 'teamChallengeds', 'userChallengers', 'userDecideds'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for challenge', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Challenge->delete($id)) {
			$this->Session->setFlash(__('Challenge deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Challenge was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for challenge', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Challenge->read(null,$id);
		$oldData["Challenge"]["active"]=false;
		if ($this->Challenge->save($oldData)) {
			$this->Session->setFlash(__('Challenge archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Challenge was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for challenge', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Challenge->read(null,$id);
		$oldData["Challenge"]["active"]=true;
		if ($this->Challenge->save($oldData)) {
			$this->Session->setFlash(__('Challenge archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Challenge was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Challenge->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->Challenge->recursive = 0;
		$this->set('challenges', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid challenge', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('challenge', $this->Challenge->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Challenge->create();
			if ($this->Challenge->save($this->data)) {
				$this->Session->setFlash(__('The challenge has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The challenge could not be saved. Please, try again.', true));
			}
		}
		$challengeStatuses = $this->Challenge->ChallengeStatus->find('list');
		$teamChallengers = $this->Challenge->TeamChallenger->find('list');
		$teamChallengeds = $this->Challenge->TeamChallenged->find('list');
		$userChallengers = $this->Challenge->UserChallenger->find('list');
		$userDecideds = $this->Challenge->UserDecided->find('list');
		$this->set(compact('challengeStatuses', 'teamChallengers', 'teamChallengeds', 'userChallengers', 'userDecideds'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid challenge', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Challenge->save($this->data)) {
				$this->Session->setFlash(__('The challenge has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The challenge could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Challenge->read(null, $id);
		}
		$challengeStatuses = $this->Challenge->ChallengeStatus->find('list');
		$teamChallengers = $this->Challenge->TeamChallenger->find('list');
		$teamChallengeds = $this->Challenge->TeamChallenged->find('list');
		$userChallengers = $this->Challenge->UserChallenger->find('list');
		$userDecideds = $this->Challenge->UserDecided->find('list');
		$this->set(compact('challengeStatuses', 'teamChallengers', 'teamChallengeds', 'userChallengers', 'userDecideds'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for challenge', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Challenge->delete($id)) {
			$this->Session->setFlash(__('Challenge deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Challenge was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for challenge', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Challenge->read(null,$id);
		$oldData["Challenge"]["active"]=false;
		if ($this->Challenge->save($oldData)) {
			$this->Session->setFlash(__('Challenge archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Challenge was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for challenge', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Challenge->read(null,$id);
		$oldData["Challenge"]["active"]=true;
		if ($this->Challenge->save($oldData)) {
			$this->Session->setFlash(__('Challenge archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Challenge was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Challenge->find($type, $findParams);
	}else{
		return null;
	}
}
}
