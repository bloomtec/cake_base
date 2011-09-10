<?php
class FriendshipsController extends AppController {

	var $name = 'Friendships';

	function index() {
		$this->Friendship->recursive = 0;
		$this->set('friendships', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid friendship', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('friendship', $this->Friendship->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Friendship->create();
			if ($this->Friendship->save($this->data)) {
				$this->Session->setFlash(__('The friendship has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The friendship could not be saved. Please, try again.', true));
			}
		}
		$userAs = $this->Friendship->UserA->find('list');
		$userBs = $this->Friendship->UserB->find('list');
		$this->set(compact('userAs', 'userBs'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid friendship', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Friendship->save($this->data)) {
				$this->Session->setFlash(__('The friendship has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The friendship could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Friendship->read(null, $id);
		}
		$userAs = $this->Friendship->UserA->find('list');
		$userBs = $this->Friendship->UserB->find('list');
		$this->set(compact('userAs', 'userBs'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for friendship', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Friendship->delete($id)) {
			$this->Session->setFlash(__('Friendship deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Friendship was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for friendship', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Friendship->read(null,$id);
		$oldData["Friendship"]["active"]=false;
		if ($this->Friendship->save($oldData)) {
			$this->Session->setFlash(__('Friendship archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Friendship was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for friendship', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Friendship->read(null,$id);
		$oldData["Friendship"]["active"]=true;
		if ($this->Friendship->save($oldData)) {
			$this->Session->setFlash(__('Friendship archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Friendship was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Friendship->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->Friendship->recursive = 0;
		$this->set('friendships', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid friendship', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('friendship', $this->Friendship->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Friendship->create();
			if ($this->Friendship->save($this->data)) {
				$this->Session->setFlash(__('The friendship has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The friendship could not be saved. Please, try again.', true));
			}
		}
		$userAs = $this->Friendship->UserA->find('list');
		$userBs = $this->Friendship->UserB->find('list');
		$this->set(compact('userAs', 'userBs'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid friendship', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Friendship->save($this->data)) {
				$this->Session->setFlash(__('The friendship has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The friendship could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Friendship->read(null, $id);
		}
		$userAs = $this->Friendship->UserA->find('list');
		$userBs = $this->Friendship->UserB->find('list');
		$this->set(compact('userAs', 'userBs'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for friendship', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Friendship->delete($id)) {
			$this->Session->setFlash(__('Friendship deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Friendship was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for friendship', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Friendship->read(null,$id);
		$oldData["Friendship"]["active"]=false;
		if ($this->Friendship->save($oldData)) {
			$this->Session->setFlash(__('Friendship archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Friendship was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for friendship', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Friendship->read(null,$id);
		$oldData["Friendship"]["active"]=true;
		if ($this->Friendship->save($oldData)) {
			$this->Session->setFlash(__('Friendship archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Friendship was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Friendship->find($type, $findParams);
	}else{
		return null;
	}
}
}
