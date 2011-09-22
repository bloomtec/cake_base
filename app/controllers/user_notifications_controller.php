<?php
class UserNotificationsController extends AppController {

	var $name = 'UserNotifications';
	
	function getNotifications() {
		$user_id = $this->Session->read('Auth.User.id');
		if($user_id) {
			return $this->UserNotification->find('all', array('conditions' => array('user_id' => $user_id)));
		}
	}
	
	function createNotification($user_id = null, $subject = null, $content = NULL) {
		$this->autoRender=false;
		$this->UserNotification->create();
		$this->UserNotification->set('user_id', $user_id);
		$this->UserNotification->set('subject', $subject);
		$this->UserNotification->set('content', $content);
		if($this->UserNotification->save()) {
			return true;
		} else {
			return false;
		}
	}

	function index() {
		$this->UserNotification->recursive = 0;
		$this->set('userNotifications', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user notification', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('userNotification', $this->UserNotification->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->UserNotification->create();
			if ($this->UserNotification->save($this->data)) {
				$this->Session->setFlash(__('The user notification has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user notification could not be saved. Please, try again.', true));
			}
		}
		$users = $this->UserNotification->User->find('list');
		$this->set(compact('users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user notification', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->UserNotification->save($this->data)) {
				$this->Session->setFlash(__('The user notification has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user notification could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->UserNotification->read(null, $id);
		}
		$users = $this->UserNotification->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user notification', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->UserNotification->delete($id)) {
			$this->Session->setFlash(__('User notification deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User notification was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user notification', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->UserNotification->read(null,$id);
		$oldData["UserNotification"]["active"]=false;
		if ($this->UserNotification->save($oldData)) {
			$this->Session->setFlash(__('User notification archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User notification was not archived', true));
		$this->redirect(array('action' => 'index'));
	}

	function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user notification', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->UserNotification->read(null,$id);
		$oldData["UserNotification"]["active"]=true;
		if ($this->UserNotification->save($oldData)) {
			$this->Session->setFlash(__('User notification archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User notification was not archived', true));
		$this->redirect(array('action' => 'index'));
	}

	function requestFind($type,$findParams,$key) {
		if($key==Configure::read("key")){
			return $this->UserNotification->find($type, $findParams);
		}else{
			return null;
		}
	}

	function admin_index() {
		$this->UserNotification->recursive = 0;
		$this->set('userNotifications', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user notification', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('userNotification', $this->UserNotification->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->UserNotification->create();
			if ($this->UserNotification->save($this->data)) {
				$this->Session->setFlash(__('The user notification has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user notification could not be saved. Please, try again.', true));
			}
		}
		$users = $this->UserNotification->User->find('list');
		$this->set(compact('users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user notification', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->UserNotification->save($this->data)) {
				$this->Session->setFlash(__('The user notification has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user notification could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->UserNotification->read(null, $id);
		}
		$users = $this->UserNotification->User->find('list');
		$this->set(compact('users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user notification', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->UserNotification->delete($id)) {
			$this->Session->setFlash(__('User notification deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User notification was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user notification', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->UserNotification->read(null,$id);
		$oldData["UserNotification"]["active"]=false;
		if ($this->UserNotification->save($oldData)) {
			$this->Session->setFlash(__('User notification archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User notification was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user notification', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->UserNotification->read(null,$id);
		$oldData["UserNotification"]["active"]=true;
		if ($this->UserNotification->save($oldData)) {
			$this->Session->setFlash(__('User notification archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User notification was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->UserNotification->find($type, $findParams);
	}else{
		return null;
	}
}
}
