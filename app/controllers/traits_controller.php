<?php
class TraitsController extends AppController {

	var $name = 'Traits';

	function index() {
		$this->Trait->recursive = 0;
		$this->set('traits', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid trait', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('trait', $this->Trait->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Trait->create();
			if ($this->Trait->save($this->data)) {
				$this->Session->setFlash(__('The trait has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The trait could not be saved. Please, try again.', true));
			}
		}
		$products = $this->Trait->Product->find('list');
		$this->set(compact('products'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid trait', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Trait->save($this->data)) {
				$this->Session->setFlash(__('The trait has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The trait could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Trait->read(null, $id);
		}
		$products = $this->Trait->Product->find('list');
		$this->set(compact('products'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for trait', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Trait->delete($id)) {
			$this->Session->setFlash(__('Trait deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Trait was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for trait', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Trait->read(null,$id);
		$oldData["Trait"]["active"]=false;
		if ($this->Trait->save($oldData)) {
			$this->Session->setFlash(__('Trait archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Trait was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for trait', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Trait->read(null,$id);
		$oldData["Trait"]["active"]=true;
		if ($this->Trait->save($oldData)) {
			$this->Session->setFlash(__('Trait archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Trait was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Trait->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->Trait->recursive = 0;
		$this->set('traits', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid trait', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('trait', $this->Trait->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Trait->create();
			if ($this->Trait->save($this->data)) {
				$this->Session->setFlash(__('The trait has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The trait could not be saved. Please, try again.', true));
			}
		}
		$products = $this->Trait->Product->find('list');
		$this->set(compact('products'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid trait', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Trait->save($this->data)) {
				$this->Session->setFlash(__('The trait has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The trait could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Trait->read(null, $id);
		}
		$products = $this->Trait->Product->find('list');
		$this->set(compact('products'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for trait', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Trait->delete($id)) {
			$this->Session->setFlash(__('Trait deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Trait was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for trait', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Trait->read(null,$id);
		$oldData["Trait"]["active"]=false;
		if ($this->Trait->save($oldData)) {
			$this->Session->setFlash(__('Trait archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Trait was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for trait', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Trait->read(null,$id);
		$oldData["Trait"]["active"]=true;
		if ($this->Trait->save($oldData)) {
			$this->Session->setFlash(__('Trait archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Trait was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Trait->find($type, $findParams);
	}else{
		return null;
	}
}
}
