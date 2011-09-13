<?php
class CountrySquadsUsersController extends AppController {

	var $name = 'CountrySquadsUsers';

	function index() {
		$this->CountrySquadsUser->recursive = 0;
		$this->set('countrySquadsUsers', $this->paginate());
	}
	

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid country squads user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('countrySquadsUser', $this->CountrySquadsUser->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->CountrySquadsUser->create();
			if ($this->CountrySquadsUser->save($this->data)) {
				$this->Session->setFlash(__('The country squads user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The country squads user could not be saved. Please, try again.', true));
			}
		}
		$countrySquads = $this->CountrySquadsUser->CountrySquad->find('list');
		$users = $this->CountrySquadsUser->User->find('list');
		$this->set(compact('countrySquads', 'users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid country squads user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->CountrySquadsUser->save($this->data)) {
				$this->Session->setFlash(__('The country squads user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The country squads user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CountrySquadsUser->read(null, $id);
		}
		$countrySquads = $this->CountrySquadsUser->CountrySquad->find('list');
		$users = $this->CountrySquadsUser->User->find('list');
		$this->set(compact('countrySquads', 'users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for country squads user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->CountrySquadsUser->delete($id)) {
			$this->Session->setFlash(__('Country squads user deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Country squads user was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for country squads user', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->CountrySquadsUser->read(null,$id);
		$oldData["CountrySquadsUser"]["active"]=false;
		if ($this->CountrySquadsUser->save($oldData)) {
			$this->Session->setFlash(__('Country squads user archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Country squads user was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for country squads user', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->CountrySquadsUser->read(null,$id);
		$oldData["CountrySquadsUser"]["active"]=true;
		if ($this->CountrySquadsUser->save($oldData)) {
			$this->Session->setFlash(__('Country squads user archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Country squads user was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->CountrySquadsUser->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->CountrySquadsUser->recursive = 0;
		$this->set('countrySquadsUsers', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid country squads user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('countrySquadsUser', $this->CountrySquadsUser->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->CountrySquadsUser->create();
			if ($this->CountrySquadsUser->save($this->data)) {
				$this->Session->setFlash(__('The country squads user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The country squads user could not be saved. Please, try again.', true));
			}
		}
		$countrySquads = $this->CountrySquadsUser->CountrySquad->find('list');
		$users = $this->CountrySquadsUser->User->find('list');
		$this->set(compact('countrySquads', 'users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid country squads user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->CountrySquadsUser->save($this->data)) {
				$this->Session->setFlash(__('The country squads user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The country squads user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CountrySquadsUser->read(null, $id);
		}
		$countrySquads = $this->CountrySquadsUser->CountrySquad->find('list');
		$users = $this->CountrySquadsUser->User->find('list');
		$this->set(compact('countrySquads', 'users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for country squads user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->CountrySquadsUser->delete($id)) {
			$this->Session->setFlash(__('Country squads user deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Country squads user was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for country squads user', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->CountrySquadsUser->read(null,$id);
		$oldData["CountrySquadsUser"]["active"]=false;
		if ($this->CountrySquadsUser->save($oldData)) {
			$this->Session->setFlash(__('Country squads user archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Country squads user was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for country squads user', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->CountrySquadsUser->read(null,$id);
		$oldData["CountrySquadsUser"]["active"]=true;
		if ($this->CountrySquadsUser->save($oldData)) {
			$this->Session->setFlash(__('Country squads user archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Country squads user was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->CountrySquadsUser->find($type, $findParams);
	}else{
		return null;
	}
}
}
