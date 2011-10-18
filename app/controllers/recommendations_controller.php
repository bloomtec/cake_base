<?php
class RecommendationsController extends AppController {

	var $name = 'Recommendations';

	function index() {
		$this->Recommendation->recursive = 0;
		$this->set('recommendations', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid recommendation', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('recommendation', $this->Recommendation->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Recommendation->create();
			if ($this->Recommendation->save($this->data)) {
				$this->Session->setFlash(__('The recommendation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The recommendation could not be saved. Please, try again.', true));
			}
		}
		$products = $this->Recommendation->Product->find('list');
		$this->set(compact('products'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid recommendation', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Recommendation->save($this->data)) {
				$this->Session->setFlash(__('The recommendation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The recommendation could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Recommendation->read(null, $id);
		}
		$products = $this->Recommendation->Product->find('list');
		$this->set(compact('products'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for recommendation', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Recommendation->delete($id)) {
			$this->Session->setFlash(__('Recommendation deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Recommendation was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for recommendation', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Recommendation->read(null,$id);
		$oldData["Recommendation"]["active"]=false;
		if ($this->Recommendation->save($oldData)) {
			$this->Session->setFlash(__('Recommendation archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Recommendation was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for recommendation', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Recommendation->read(null,$id);
		$oldData["Recommendation"]["active"]=true;
		if ($this->Recommendation->save($oldData)) {
			$this->Session->setFlash(__('Recommendation archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Recommendation was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Recommendation->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->Recommendation->recursive = 0;
		$this->set('recommendations', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid recommendation', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('recommendation', $this->Recommendation->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Recommendation->create();
			if ($this->Recommendation->save($this->data)) {
				$this->Session->setFlash(__('The recommendation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The recommendation could not be saved. Please, try again.', true));
			}
		}
		$products = $this->Recommendation->Product->find('list');
		$this->set(compact('products'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid recommendation', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Recommendation->save($this->data)) {
				$this->Session->setFlash(__('The recommendation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The recommendation could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Recommendation->read(null, $id);
		}
		$products = $this->Recommendation->Product->find('list');
		$this->set(compact('products'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for recommendation', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Recommendation->delete($id)) {
			$this->Session->setFlash(__('Recommendation deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Recommendation was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for recommendation', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Recommendation->read(null,$id);
		$oldData["Recommendation"]["active"]=false;
		if ($this->Recommendation->save($oldData)) {
			$this->Session->setFlash(__('Recommendation archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Recommendation was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for recommendation', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Recommendation->read(null,$id);
		$oldData["Recommendation"]["active"]=true;
		if ($this->Recommendation->save($oldData)) {
			$this->Session->setFlash(__('Recommendation archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Recommendation was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Recommendation->find($type, $findParams);
	}else{
		return null;
	}
}
}
