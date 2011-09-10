<?php
class DocumentTypesController extends AppController {

	var $name = 'DocumentTypes';

	function index() {
		$this->DocumentType->recursive = 0;
		$this->set('documentTypes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid document type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('documentType', $this->DocumentType->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->DocumentType->create();
			if ($this->DocumentType->save($this->data)) {
				$this->Session->setFlash(__('The document type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The document type could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid document type', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->DocumentType->save($this->data)) {
				$this->Session->setFlash(__('The document type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The document type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DocumentType->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for document type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->DocumentType->delete($id)) {
			$this->Session->setFlash(__('Document type deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Document type was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for document type', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->DocumentType->read(null,$id);
		$oldData["DocumentType"]["active"]=false;
		if ($this->DocumentType->save($oldData)) {
			$this->Session->setFlash(__('Document type archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Document type was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for document type', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->DocumentType->read(null,$id);
		$oldData["DocumentType"]["active"]=true;
		if ($this->DocumentType->save($oldData)) {
			$this->Session->setFlash(__('Document type archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Document type was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->DocumentType->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->DocumentType->recursive = 0;
		$this->set('documentTypes', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid document type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('documentType', $this->DocumentType->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->DocumentType->create();
			if ($this->DocumentType->save($this->data)) {
				$this->Session->setFlash(__('The document type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The document type could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid document type', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->DocumentType->save($this->data)) {
				$this->Session->setFlash(__('The document type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The document type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DocumentType->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for document type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->DocumentType->delete($id)) {
			$this->Session->setFlash(__('Document type deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Document type was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for document type', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->DocumentType->read(null,$id);
		$oldData["DocumentType"]["active"]=false;
		if ($this->DocumentType->save($oldData)) {
			$this->Session->setFlash(__('Document type archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Document type was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for document type', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->DocumentType->read(null,$id);
		$oldData["DocumentType"]["active"]=true;
		if ($this->DocumentType->save($oldData)) {
			$this->Session->setFlash(__('Document type archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Document type was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->DocumentType->find($type, $findParams);
	}else{
		return null;
	}
}
}
