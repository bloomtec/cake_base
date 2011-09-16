<?php
class FeetsController extends AppController {

	var $name = 'Feets';

	function index() {
		$this->Feet->recursive = 0;
		$this->set('feets', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid feet', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('feet', $this->Feet->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Feet->create();
			if ($this->Feet->save($this->data)) {
				$this->Session->setFlash(__('The feet has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feet could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid feet', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Feet->save($this->data)) {
				$this->Session->setFlash(__('The feet has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feet could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Feet->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for feet', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Feet->delete($id)) {
			$this->Session->setFlash(__('Feet deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Feet was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for feet', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Feet->read(null,$id);
		$oldData["Feet"]["active"]=false;
		if ($this->Feet->save($oldData)) {
			$this->Session->setFlash(__('Feet archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Feet was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for feet', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Feet->read(null,$id);
		$oldData["Feet"]["active"]=true;
		if ($this->Feet->save($oldData)) {
			$this->Session->setFlash(__('Feet archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Feet was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Feet->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->Feet->recursive = 0;
		$this->set('feets', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid feet', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('feet', $this->Feet->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Feet->create();
			if ($this->Feet->save($this->data)) {
				$this->Session->setFlash(__('The feet has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feet could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid feet', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Feet->save($this->data)) {
				$this->Session->setFlash(__('The feet has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feet could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Feet->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for feet', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Feet->delete($id)) {
			$this->Session->setFlash(__('Feet deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Feet was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for feet', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Feet->read(null,$id);
		$oldData["Feet"]["active"]=false;
		if ($this->Feet->save($oldData)) {
			$this->Session->setFlash(__('Feet archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Feet was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for feet', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Feet->read(null,$id);
		$oldData["Feet"]["active"]=true;
		if ($this->Feet->save($oldData)) {
			$this->Session->setFlash(__('Feet archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Feet was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Feet->find($type, $findParams);
	}else{
		return null;
	}
}
}
