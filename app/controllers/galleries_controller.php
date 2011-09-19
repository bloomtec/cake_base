<?php
class GalleriesController extends AppController {

	var $name = 'Galleries';

	function index() {
		$this->Gallery->recursive = 0;
		$this->set('galleries', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid gallery', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('gallery', $this->Gallery->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Gallery->create();
			if ($this->Gallery->save($this->data)) {
				$this->Session->setFlash(__('The gallery has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The gallery could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid gallery', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Gallery->save($this->data)) {
				$this->Session->setFlash(__('The gallery has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The gallery could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Gallery->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for gallery', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Gallery->delete($id)) {
			$this->Session->setFlash(__('Gallery deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Gallery was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for gallery', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Gallery->read(null,$id);
		$oldData["Gallery"]["active"]=false;
		if ($this->Gallery->save($oldData)) {
			$this->Session->setFlash(__('Gallery archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Gallery was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for gallery', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Gallery->read(null,$id);
		$oldData["Gallery"]["active"]=true;
		if ($this->Gallery->save($oldData)) {
			$this->Session->setFlash(__('Gallery archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Gallery was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Gallery->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->Gallery->recursive = 0;
		$this->set('galleries', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid gallery', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('gallery', $this->Gallery->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Gallery->create();
			if ($this->Gallery->save($this->data)) {
				$this->Session->setFlash(__('The gallery has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The gallery could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid gallery', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Gallery->save($this->data)) {
				$this->Session->setFlash(__('The gallery has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The gallery could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Gallery->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for gallery', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Gallery->delete($id)) {
			$this->Session->setFlash(__('Gallery deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Gallery was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for gallery', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Gallery->read(null,$id);
		$oldData["Gallery"]["active"]=false;
		if ($this->Gallery->save($oldData)) {
			$this->Session->setFlash(__('Gallery archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Gallery was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for gallery', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Gallery->read(null,$id);
		$oldData["Gallery"]["active"]=true;
		if ($this->Gallery->save($oldData)) {
			$this->Session->setFlash(__('Gallery archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Gallery was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Gallery->find($type, $findParams);
	}else{
		return null;
	}
}
}
