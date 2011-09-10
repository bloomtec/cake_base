<?php
class PrivateMessagesController extends AppController {

	var $name = 'PrivateMessages';

	function index() {
		$this->PrivateMessage->recursive = 0;
		$this->set('privateMessages', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid private message', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('privateMessage', $this->PrivateMessage->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->PrivateMessage->create();
			if ($this->PrivateMessage->save($this->data)) {
				$this->Session->setFlash(__('The private message has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The private message could not be saved. Please, try again.', true));
			}
		}
		$toUsers = $this->PrivateMessage->ToUser->find('list');
		$fromUsers = $this->PrivateMessage->FromUser->find('list');
		$this->set(compact('toUsers', 'fromUsers'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid private message', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PrivateMessage->save($this->data)) {
				$this->Session->setFlash(__('The private message has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The private message could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PrivateMessage->read(null, $id);
		}
		$toUsers = $this->PrivateMessage->ToUser->find('list');
		$fromUsers = $this->PrivateMessage->FromUser->find('list');
		$this->set(compact('toUsers', 'fromUsers'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for private message', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PrivateMessage->delete($id)) {
			$this->Session->setFlash(__('Private message deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Private message was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for private message', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->PrivateMessage->read(null,$id);
		$oldData["PrivateMessage"]["active"]=false;
		if ($this->PrivateMessage->save($oldData)) {
			$this->Session->setFlash(__('Private message archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Private message was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for private message', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->PrivateMessage->read(null,$id);
		$oldData["PrivateMessage"]["active"]=true;
		if ($this->PrivateMessage->save($oldData)) {
			$this->Session->setFlash(__('Private message archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Private message was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->PrivateMessage->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->PrivateMessage->recursive = 0;
		$this->set('privateMessages', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid private message', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('privateMessage', $this->PrivateMessage->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->PrivateMessage->create();
			if ($this->PrivateMessage->save($this->data)) {
				$this->Session->setFlash(__('The private message has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The private message could not be saved. Please, try again.', true));
			}
		}
		$toUsers = $this->PrivateMessage->ToUser->find('list');
		$fromUsers = $this->PrivateMessage->FromUser->find('list');
		$this->set(compact('toUsers', 'fromUsers'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid private message', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PrivateMessage->save($this->data)) {
				$this->Session->setFlash(__('The private message has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The private message could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PrivateMessage->read(null, $id);
		}
		$toUsers = $this->PrivateMessage->ToUser->find('list');
		$fromUsers = $this->PrivateMessage->FromUser->find('list');
		$this->set(compact('toUsers', 'fromUsers'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for private message', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PrivateMessage->delete($id)) {
			$this->Session->setFlash(__('Private message deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Private message was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for private message', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->PrivateMessage->read(null,$id);
		$oldData["PrivateMessage"]["active"]=false;
		if ($this->PrivateMessage->save($oldData)) {
			$this->Session->setFlash(__('Private message archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Private message was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for private message', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->PrivateMessage->read(null,$id);
		$oldData["PrivateMessage"]["active"]=true;
		if ($this->PrivateMessage->save($oldData)) {
			$this->Session->setFlash(__('Private message archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Private message was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->PrivateMessage->find($type, $findParams);
	}else{
		return null;
	}
}
}
