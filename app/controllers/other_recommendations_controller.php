<?php
class OtherRecommendationsController extends AppController {

	var $name = 'OtherRecommendations';

	function index() {
		$this->OtherRecommendation->recursive = 0;
		$this->set('otherRecommendations', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid other recommendation', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('otherRecommendation', $this->OtherRecommendation->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->OtherRecommendation->create();
			if ($this->OtherRecommendation->save($this->data)) {
				$this->Session->setFlash(__('The other recommendation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The other recommendation could not be saved. Please, try again.', true));
			}
		}
		$products = $this->OtherRecommendation->Product->find('list');
		$this->set(compact('products'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid other recommendation', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->OtherRecommendation->save($this->data)) {
				$this->Session->setFlash(__('The other recommendation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The other recommendation could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->OtherRecommendation->read(null, $id);
		}
		$products = $this->OtherRecommendation->Product->find('list');
		$this->set(compact('products'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for other recommendation', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->OtherRecommendation->delete($id)) {
			$this->Session->setFlash(__('Other recommendation deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Other recommendation was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for other recommendation', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->OtherRecommendation->read(null,$id);
		$oldData["OtherRecommendation"]["active"]=false;
		if ($this->OtherRecommendation->save($oldData)) {
			$this->Session->setFlash(__('Other recommendation archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Other recommendation was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for other recommendation', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->OtherRecommendation->read(null,$id);
		$oldData["OtherRecommendation"]["active"]=true;
		if ($this->OtherRecommendation->save($oldData)) {
			$this->Session->setFlash(__('Other recommendation archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Other recommendation was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->OtherRecommendation->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->OtherRecommendation->recursive = 0;
		$this->set('otherRecommendations', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid other recommendation', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('otherRecommendation', $this->OtherRecommendation->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->OtherRecommendation->create();
			if ($this->OtherRecommendation->save($this->data)) {
				$this->Session->setFlash(__('The other recommendation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The other recommendation could not be saved. Please, try again.', true));
			}
		}
		$products = $this->OtherRecommendation->Product->find('list');
		$this->set(compact('products'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid other recommendation', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->OtherRecommendation->save($this->data)) {
				$this->Session->setFlash(__('The other recommendation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The other recommendation could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->OtherRecommendation->read(null, $id);
		}
		$products = $this->OtherRecommendation->Product->find('list');
		$this->set(compact('products'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for other recommendation', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->OtherRecommendation->delete($id)) {
			$this->Session->setFlash(__('Other recommendation deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Other recommendation was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for other recommendation', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->OtherRecommendation->read(null,$id);
		$oldData["OtherRecommendation"]["active"]=false;
		if ($this->OtherRecommendation->save($oldData)) {
			$this->Session->setFlash(__('Other recommendation archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Other recommendation was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for other recommendation', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->OtherRecommendation->read(null,$id);
		$oldData["OtherRecommendation"]["active"]=true;
		if ($this->OtherRecommendation->save($oldData)) {
			$this->Session->setFlash(__('Other recommendation archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Other recommendation was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->OtherRecommendation->find($type, $findParams);
	}else{
		return null;
	}
}
}
