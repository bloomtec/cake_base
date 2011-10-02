<?php
class SizeReferencesController extends AppController {

	var $name = 'SizeReferences';
	
	function listSizes() {
		return $this->SizeReference->find('list');
	}
	
	function listSize($id = null) {
		if($id) {
			return $this->SizeReference->find('list', array('conditions'=>array('SizeReference.id'=>$id)));			
		} else {
			return array();
		}
	}
	
	function getSize($reference = null) {
		if($reference) {
			$size = $this->SizeReference->read(null, $reference);
			return $size['SizeReference']['size'];
		}
	}

	function index() {
		$this->SizeReference->recursive = 0;
		$this->set('sizeReferences', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid size reference', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('sizeReference', $this->SizeReference->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->SizeReference->create();
			if ($this->SizeReference->save($this->data)) {
				$this->Session->setFlash(__('The size reference has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The size reference could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid size reference', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SizeReference->save($this->data)) {
				$this->Session->setFlash(__('The size reference has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The size reference could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SizeReference->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for size reference', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SizeReference->delete($id)) {
			$this->Session->setFlash(__('Size reference deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Size reference was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for size reference', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->SizeReference->read(null,$id);
		$oldData["SizeReference"]["active"]=false;
		if ($this->SizeReference->save($oldData)) {
			$this->Session->setFlash(__('Size reference archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Size reference was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for size reference', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->SizeReference->read(null,$id);
		$oldData["SizeReference"]["active"]=true;
		if ($this->SizeReference->save($oldData)) {
			$this->Session->setFlash(__('Size reference archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Size reference was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->SizeReference->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->SizeReference->recursive = 0;
		$this->set('sizeReferences', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid size reference', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('sizeReference', $this->SizeReference->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->SizeReference->create();
			if ($this->SizeReference->save($this->data)) {
				$this->Session->setFlash(__('The size reference has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The size reference could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid size reference', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SizeReference->save($this->data)) {
				$this->Session->setFlash(__('The size reference has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The size reference could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SizeReference->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for size reference', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SizeReference->delete($id)) {
			$this->Session->setFlash(__('Size reference deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Size reference was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for size reference', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->SizeReference->read(null,$id);
		$oldData["SizeReference"]["active"]=false;
		if ($this->SizeReference->save($oldData)) {
			$this->Session->setFlash(__('Size reference archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Size reference was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for size reference', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->SizeReference->read(null,$id);
		$oldData["SizeReference"]["active"]=true;
		if ($this->SizeReference->save($oldData)) {
			$this->Session->setFlash(__('Size reference archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Size reference was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->SizeReference->find($type, $findParams);
	}else{
		return null;
	}
}
}
