<?php
class PublicMessagesController extends AppController {

	var $name = 'PublicMessages';

	function index() {
		$this->PublicMessage->recursive = 0;
		$this->set('publicMessages', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid public message', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('publicMessage', $this->PublicMessage->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->PublicMessage->create();
			if ($this->PublicMessage->save($this->data)) {
				$this->Session->setFlash(__('The public message has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The public message could not be saved. Please, try again.', true));
			}
		}
		$toUsers = $this->PublicMessage->ToUser->find('list');
		$fromUsers = $this->PublicMessage->FromUser->find('list');
		$this->set(compact('toUsers', 'fromUsers'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid public message', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PublicMessage->save($this->data)) {
				$this->Session->setFlash(__('The public message has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The public message could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PublicMessage->read(null, $id);
		}
		$toUsers = $this->PublicMessage->ToUser->find('list');
		$fromUsers = $this->PublicMessage->FromUser->find('list');
		$this->set(compact('toUsers', 'fromUsers'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for public message', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PublicMessage->delete($id)) {
			$this->Session->setFlash(__('Public message deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Public message was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for public message', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->PublicMessage->read(null,$id);
		$oldData["PublicMessage"]["active"]=false;
		if ($this->PublicMessage->save($oldData)) {
			$this->Session->setFlash(__('Public message archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Public message was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for public message', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->PublicMessage->read(null,$id);
		$oldData["PublicMessage"]["active"]=true;
		if ($this->PublicMessage->save($oldData)) {
			$this->Session->setFlash(__('Public message archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Public message was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->PublicMessage->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->PublicMessage->recursive = 0;
		$this->set('publicMessages', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid public message', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('publicMessage', $this->PublicMessage->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->PublicMessage->create();
			if ($this->PublicMessage->save($this->data)) {
				$this->Session->setFlash(__('The public message has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The public message could not be saved. Please, try again.', true));
			}
		}
		$toUsers = $this->PublicMessage->ToUser->find('list');
		$fromUsers = $this->PublicMessage->FromUser->find('list');
		$this->set(compact('toUsers', 'fromUsers'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid public message', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PublicMessage->save($this->data)) {
				$this->Session->setFlash(__('The public message has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The public message could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PublicMessage->read(null, $id);
		}
		$toUsers = $this->PublicMessage->ToUser->find('list');
		$fromUsers = $this->PublicMessage->FromUser->find('list');
		$this->set(compact('toUsers', 'fromUsers'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for public message', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PublicMessage->delete($id)) {
			$this->Session->setFlash(__('Public message deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Public message was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for public message', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->PublicMessage->read(null,$id);
		$oldData["PublicMessage"]["active"]=false;
		if ($this->PublicMessage->save($oldData)) {
			$this->Session->setFlash(__('Public message archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Public message was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for public message', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->PublicMessage->read(null,$id);
		$oldData["PublicMessage"]["active"]=true;
		if ($this->PublicMessage->save($oldData)) {
			$this->Session->setFlash(__('Public message archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Public message was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->PublicMessage->find($type, $findParams);
	}else{
		return null;
	}
}
}
