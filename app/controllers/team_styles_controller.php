<?php
class TeamStylesController extends AppController {

	var $name = 'TeamStyles';

	function index() {
		$this->TeamStyle->recursive = 0;
		$this->set('teamStyles', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid team style', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('teamStyle', $this->TeamStyle->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->TeamStyle->create();
			if ($this->TeamStyle->save($this->data)) {
				$this->Session->setFlash(__('The team style has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team style could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid team style', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->TeamStyle->save($this->data)) {
				$this->Session->setFlash(__('The team style has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team style could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->TeamStyle->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for team style', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->TeamStyle->delete($id)) {
			$this->Session->setFlash(__('Team style deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Team style was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for team style', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->TeamStyle->read(null,$id);
		$oldData["TeamStyle"]["active"]=false;
		if ($this->TeamStyle->save($oldData)) {
			$this->Session->setFlash(__('Team style archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Team style was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for team style', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->TeamStyle->read(null,$id);
		$oldData["TeamStyle"]["active"]=true;
		if ($this->TeamStyle->save($oldData)) {
			$this->Session->setFlash(__('Team style archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Team style was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->TeamStyle->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->TeamStyle->recursive = 0;
		$this->set('teamStyles', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid team style', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('teamStyle', $this->TeamStyle->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->TeamStyle->create();
			if ($this->TeamStyle->save($this->data)) {
				$this->Session->setFlash(__('The team style has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team style could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid team style', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->TeamStyle->save($this->data)) {
				$this->Session->setFlash(__('The team style has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team style could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->TeamStyle->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for team style', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->TeamStyle->delete($id)) {
			$this->Session->setFlash(__('Team style deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Team style was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for team style', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->TeamStyle->read(null,$id);
		$oldData["TeamStyle"]["active"]=false;
		if ($this->TeamStyle->save($oldData)) {
			$this->Session->setFlash(__('Team style archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Team style was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for team style', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->TeamStyle->read(null,$id);
		$oldData["TeamStyle"]["active"]=true;
		if ($this->TeamStyle->save($oldData)) {
			$this->Session->setFlash(__('Team style archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Team style was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->TeamStyle->find($type, $findParams);
	}else{
		return null;
	}
}
}
