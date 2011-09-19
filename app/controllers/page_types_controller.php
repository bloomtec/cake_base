<?php
class PageTypesController extends AppController {

	var $name = 'PageTypes';

	function index() {
		$this->PageType->recursive = 0;
		$this->set('pageTypes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid page type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('pageType', $this->PageType->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->PageType->create();
			if ($this->PageType->save($this->data)) {
				$this->Session->setFlash(__('The page type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page type could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid page type', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PageType->save($this->data)) {
				$this->Session->setFlash(__('The page type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PageType->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for page type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PageType->delete($id)) {
			$this->Session->setFlash(__('Page type deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Page type was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for page type', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->PageType->read(null,$id);
		$oldData["PageType"]["active"]=false;
		if ($this->PageType->save($oldData)) {
			$this->Session->setFlash(__('Page type archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Page type was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for page type', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->PageType->read(null,$id);
		$oldData["PageType"]["active"]=true;
		if ($this->PageType->save($oldData)) {
			$this->Session->setFlash(__('Page type archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Page type was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->PageType->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->PageType->recursive = 0;
		$this->set('pageTypes', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid page type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('pageType', $this->PageType->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->PageType->create();
			if ($this->PageType->save($this->data)) {
				$this->Session->setFlash(__('The page type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page type could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid page type', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PageType->save($this->data)) {
				$this->Session->setFlash(__('The page type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PageType->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for page type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PageType->delete($id)) {
			$this->Session->setFlash(__('Page type deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Page type was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for page type', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->PageType->read(null,$id);
		$oldData["PageType"]["active"]=false;
		if ($this->PageType->save($oldData)) {
			$this->Session->setFlash(__('Page type archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Page type was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for page type', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->PageType->read(null,$id);
		$oldData["PageType"]["active"]=true;
		if ($this->PageType->save($oldData)) {
			$this->Session->setFlash(__('Page type archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Page type was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->PageType->find($type, $findParams);
	}else{
		return null;
	}
}
}
