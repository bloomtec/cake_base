<?php
class CountrySquadsController extends AppController {

	var $name = 'CountrySquads';

	function index() {
		$this->CountrySquad->recursive = 0;
		$this->set('countrySquads', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid country squad', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('countrySquad', $this->CountrySquad->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->CountrySquad->create();
			if ($this->CountrySquad->save($this->data)) {
				$this->Session->setFlash(__('The country squad has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The country squad could not be saved. Please, try again.', true));
			}
		}
		$users = $this->CountrySquad->User->find('list');
		$this->set(compact('users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid country squad', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->CountrySquad->save($this->data)) {
				$this->Session->setFlash(__('The country squad has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The country squad could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CountrySquad->read(null, $id);
		}
		$users = $this->CountrySquad->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for country squad', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->CountrySquad->delete($id)) {
			$this->Session->setFlash(__('Country squad deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Country squad was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for country squad', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->CountrySquad->read(null,$id);
		$oldData["CountrySquad"]["active"]=false;
		if ($this->CountrySquad->save($oldData)) {
			$this->Session->setFlash(__('Country squad archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Country squad was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for country squad', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->CountrySquad->read(null,$id);
		$oldData["CountrySquad"]["active"]=true;
		if ($this->CountrySquad->save($oldData)) {
			$this->Session->setFlash(__('Country squad archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Country squad was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->CountrySquad->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->CountrySquad->recursive = 0;
		$this->set('countrySquads', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid country squad', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('countrySquad', $this->CountrySquad->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->CountrySquad->create();
			if ($this->CountrySquad->save($this->data)) {
				$this->Session->setFlash(__('The country squad has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The country squad could not be saved. Please, try again.', true));
			}
		}
		$users = $this->CountrySquad->User->find('list');
		$this->set(compact('users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid country squad', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->CountrySquad->save($this->data)) {
				$this->Session->setFlash(__('The country squad has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The country squad could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CountrySquad->read(null, $id);
		}
		$users = $this->CountrySquad->User->find('list');
		$this->set(compact('users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for country squad', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->CountrySquad->delete($id)) {
			$this->Session->setFlash(__('Country squad deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Country squad was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for country squad', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->CountrySquad->read(null,$id);
		$oldData["CountrySquad"]["active"]=false;
		if ($this->CountrySquad->save($oldData)) {
			$this->Session->setFlash(__('Country squad archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Country squad was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for country squad', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->CountrySquad->read(null,$id);
		$oldData["CountrySquad"]["active"]=true;
		if ($this->CountrySquad->save($oldData)) {
			$this->Session->setFlash(__('Country squad archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Country squad was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->CountrySquad->find($type, $findParams);
	}else{
		return null;
	}
}
}
