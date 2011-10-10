<?php
class AdsController extends AppController {

	var $name = 'Ads';

	function index() {
		$this->Ad->recursive = 0;
		$this->set('ads', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ad', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('ad', $this->Ad->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Ad->create();
			if ($this->Ad->save($this->data)) {
				$this->Session->setFlash(__('The ad has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ad could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ad', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Ad->save($this->data)) {
				$this->Session->setFlash(__('The ad has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ad could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Ad->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ad', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Ad->delete($id)) {
			$this->Session->setFlash(__('Ad deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Ad was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ad', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Ad->read(null,$id);
		$oldData["Ad"]["active"]=false;
		if ($this->Ad->save($oldData)) {
			$this->Session->setFlash(__('Ad archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Ad was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ad', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Ad->read(null,$id);
		$oldData["Ad"]["active"]=true;
		if ($this->Ad->save($oldData)) {
			$this->Session->setFlash(__('Ad archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Ad was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Ad->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->Ad->recursive = 0;
		$this->set('ads', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ad', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('ad', $this->Ad->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Ad->create();
			if ($this->Ad->save($this->data)) {
				$this->Session->setFlash(__('The ad has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ad could not be saved. Please, try again.', true));
			}
		}
		$adPositions=$this->Ad->AdPosition->find('list');
		$this->set(compact('adPositions'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ad', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Ad->save($this->data)) {
				$this->Session->setFlash(__('The ad has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ad could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Ad->read(null, $id);
		}
		$this->set(compact('adPositions'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ad', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Ad->delete($id)) {
			$this->Session->setFlash(__('Ad deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Ad was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ad', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Ad->read(null,$id);
		$oldData["Ad"]["active"]=false;
		if ($this->Ad->save($oldData)) {
			$this->Session->setFlash(__('Ad archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Ad was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ad', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Ad->read(null,$id);
		$oldData["Ad"]["active"]=true;
		if ($this->Ad->save($oldData)) {
			$this->Session->setFlash(__('Ad archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Ad was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Ad->find($type, $findParams);
	}else{
		return null;
	}
}
}
