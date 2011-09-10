<?php
class ClubsController extends AppController {

	var $name = 'Clubs';

	function index() {
		$this->Club->recursive = 0;
		$this->set('clubs', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid club', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('club', $this->Club->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Club->create();
			if ($this->Club->save($this->data)) {
				$this->Session->setFlash(__('The club has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The club could not be saved. Please, try again.', true));
			}
		}
		$leagues = $this->Club->League->find('list');
		$users = $this->Club->User->find('list');
		$this->set(compact('leagues', 'users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid club', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Club->save($this->data)) {
				$this->Session->setFlash(__('The club has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The club could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Club->read(null, $id);
		}
		$leagues = $this->Club->League->find('list');
		$users = $this->Club->User->find('list');
		$this->set(compact('leagues', 'users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for club', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Club->delete($id)) {
			$this->Session->setFlash(__('Club deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Club was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for club', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Club->read(null,$id);
		$oldData["Club"]["active"]=false;
		if ($this->Club->save($oldData)) {
			$this->Session->setFlash(__('Club archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Club was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for club', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Club->read(null,$id);
		$oldData["Club"]["active"]=true;
		if ($this->Club->save($oldData)) {
			$this->Session->setFlash(__('Club archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Club was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Club->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->Club->recursive = 0;
		$this->set('clubs', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid club', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('club', $this->Club->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Club->create();
			if ($this->Club->save($this->data)) {
				$this->Session->setFlash(__('The club has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The club could not be saved. Please, try again.', true));
			}
		}
		$leagues = $this->Club->League->find('list');
		$users = $this->Club->User->find('list');
		$this->set(compact('leagues', 'users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid club', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Club->save($this->data)) {
				$this->Session->setFlash(__('The club has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The club could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Club->read(null, $id);
		}
		$leagues = $this->Club->League->find('list');
		$users = $this->Club->User->find('list');
		$this->set(compact('leagues', 'users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for club', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Club->delete($id)) {
			$this->Session->setFlash(__('Club deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Club was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for club', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Club->read(null,$id);
		$oldData["Club"]["active"]=false;
		if ($this->Club->save($oldData)) {
			$this->Session->setFlash(__('Club archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Club was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for club', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Club->read(null,$id);
		$oldData["Club"]["active"]=true;
		if ($this->Club->save($oldData)) {
			$this->Session->setFlash(__('Club archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Club was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Club->find($type, $findParams);
	}else{
		return null;
	}
}
}
