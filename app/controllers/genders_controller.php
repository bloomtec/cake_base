<?php
class GendersController extends AppController {

	var $name = 'Genders';

	function index() {
		$this->Gender->recursive = 0;
		$this->set('genders', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid gender', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('gender', $this->Gender->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Gender->create();
			if ($this->Gender->save($this->data)) {
				$this->Session->setFlash(__('The gender has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The gender could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid gender', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Gender->save($this->data)) {
				$this->Session->setFlash(__('The gender has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The gender could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Gender->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for gender', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Gender->delete($id)) {
			$this->Session->setFlash(__('Gender deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Gender was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for gender', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Gender->read(null,$id);
		$oldData["Gender"]["active"]=false;
		if ($this->Gender->save($oldData)) {
			$this->Session->setFlash(__('Gender archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Gender was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for gender', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Gender->read(null,$id);
		$oldData["Gender"]["active"]=true;
		if ($this->Gender->save($oldData)) {
			$this->Session->setFlash(__('Gender archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Gender was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Gender->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->Gender->recursive = 0;
		$this->set('genders', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid gender', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('gender', $this->Gender->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Gender->create();
			if ($this->Gender->save($this->data)) {
				$this->Session->setFlash(__('The gender has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The gender could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid gender', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Gender->save($this->data)) {
				$this->Session->setFlash(__('The gender has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The gender could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Gender->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for gender', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Gender->delete($id)) {
			$this->Session->setFlash(__('Gender deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Gender was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for gender', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Gender->read(null,$id);
		$oldData["Gender"]["active"]=false;
		if ($this->Gender->save($oldData)) {
			$this->Session->setFlash(__('Gender archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Gender was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for gender', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Gender->read(null,$id);
		$oldData["Gender"]["active"]=true;
		if ($this->Gender->save($oldData)) {
			$this->Session->setFlash(__('Gender archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Gender was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Gender->find($type, $findParams);
	}else{
		return null;
	}
}
}
