<?php
class LeaguesController extends AppController {

	var $name = 'Leagues';

	function index() {
		$this->League->recursive = 0;
		$this->set('leagues', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid league', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('league', $this->League->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->League->create();
			if ($this->League->save($this->data)) {
				$this->Session->setFlash(__('The league has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The league could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid league', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->League->save($this->data)) {
				$this->Session->setFlash(__('The league has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The league could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->League->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for league', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->League->delete($id)) {
			$this->Session->setFlash(__('League deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('League was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for league', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->League->read(null,$id);
		$oldData["League"]["active"]=false;
		if ($this->League->save($oldData)) {
			$this->Session->setFlash(__('League archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('League was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for league', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->League->read(null,$id);
		$oldData["League"]["active"]=true;
		if ($this->League->save($oldData)) {
			$this->Session->setFlash(__('League archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('League was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->League->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->League->recursive = 0;
		$this->set('leagues', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid league', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('league', $this->League->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->League->create();
			if ($this->League->save($this->data)) {
				$this->Session->setFlash(__('The league has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The league could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid league', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->League->save($this->data)) {
				$this->Session->setFlash(__('The league has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The league could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->League->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for league', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->League->delete($id)) {
			$this->Session->setFlash(__('League deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('League was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for league', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->League->read(null,$id);
		$oldData["League"]["active"]=false;
		if ($this->League->save($oldData)) {
			$this->Session->setFlash(__('League archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('League was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for league', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->League->read(null,$id);
		$oldData["League"]["active"]=true;
		if ($this->League->save($oldData)) {
			$this->Session->setFlash(__('League archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('League was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->League->find($type, $findParams);
	}else{
		return null;
	}
}
}
