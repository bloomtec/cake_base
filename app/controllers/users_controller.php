<?php
class UsersController extends AppController {

	var $name = 'Users';
	
	function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> allow('register','login');
	}
	
	function search($info = null) {
		if($info) {
			$this->loadModel('UserField');
			$user_ids = $this->UserField->find('list', array('fields' => array('user_id'), 'conditions' => array('OR' => array('UserField.name LIKE' => "%$info%", 'UserField.surname LIKE' => "%$info%"))));
			//debug($user_ids);
			$this->set("result", $this->paginate("User", array("User.id" => $user_ids)));
		} else {
			$this->set("result", null);
		}
	}

	function login() {}

	function admin_login() {}

	function logout() {
		$this -> redirect($this -> Auth -> logout());
	}

	function register() {
		if (!empty($this -> data)) {
			// Validar la contraseña
			$isPasswordValid = false;
			if (!empty($this -> data['User']['enter_password']) && ($this -> data['User']['enter_password'] == $this -> data['User']['confirm_password'])) {
				$isPasswordValid = true;
			}
			// Validar el correo
			$isMailValid = false;
			$tempUser = $this -> User -> findByEmail($this -> data['User']['email']);
			if (empty($tempUser) && !empty($this -> data['User']['email']) && ($this -> data['User']['email'] == $this -> data['User']['confirm_email'])) {
				$isMailValid = true;
			}
			if ($isPasswordValid && $isMailValid) {
				$user = $this->User->create();
				$user['User']['password'] = $this -> Auth -> password($this -> data['User']['enter_password']);
				$user['User']['email'] = $this -> data['User']['email'];
				$user['User']['role_id'] = 2; // 1 - Admin; 2 - Usuario
				$user['User']['active'] = 1;
				if ($this -> User -> save($user)) {
					$user = $this -> User -> read(null, $this -> User -> id);
					$userFields = array();
					$userFields['UserField']['user_id'] = $user['User']['id'];
					$userFields['UserField']['name'] = $this -> data['User']['name'];
					$userFields['UserField']['surname'] = $this -> data['User']['surname'];
					$userFields['UserField']['phone'] = $this -> data['User']['phone'];
					$userFields['UserField']['address'] = $this -> data['User']['address'];
					$userFields['UserField']['birthday'] = $this -> data['User']['birthday'];
					$this -> User -> UserField -> save($userFields);
					$this -> Session -> setFlash(__('The user has been saved', true));
					$this -> redirect(array('/'));
				} else {
					$this -> Session -> setFlash(__('The user could not be saved. Please, try again.', true));
				}
			} else {
				$this -> Session -> setFlash(__('Password or email mismatch, email already registered or one of these fields was left empty. Please, try again.', true));
			}
		}
		$this -> loadModel('DocumentType');
		$documentTypes = $this -> DocumentType -> find('list');
		$this -> set(compact('documentTypes'));
	}

	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		$roles = $this->User->Role->find('list');
		$clubs = $this->User->Club->find('list');
		$countrySquads = $this->User->CountrySquad->find('list');
		$matches = $this->User->Match->find('list');
		$teams = $this->User->Team->find('list');
		$this->set(compact('roles', 'clubs', 'countrySquads', 'matches', 'teams'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$roles = $this->User->Role->find('list');
		$clubs = $this->User->Club->find('list');
		$countrySquads = $this->User->CountrySquad->find('list');
		$matches = $this->User->Match->find('list');
		$teams = $this->User->Team->find('list');
		$this->set(compact('roles', 'clubs', 'countrySquads', 'matches', 'teams'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->User->read(null,$id);
		$oldData["User"]["active"]=false;
		if ($this->User->save($oldData)) {
			$this->Session->setFlash(__('User archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->User->read(null,$id);
		$oldData["User"]["active"]=true;
		if ($this->User->save($oldData)) {
			$this->Session->setFlash(__('User archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function requestFind($type,$findParams,$key) {
		if($key==Configure::read("key")){
			return $this->User->find($type, $findParams);
		}else{
			return null;
		}
	}
	
	function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		$roles = $this->User->Role->find('list');
		$clubs = $this->User->Club->find('list');
		$countrySquads = $this->User->CountrySquad->find('list');
		$matches = $this->User->Match->find('list');
		$teams = $this->User->Team->find('list');
		$this->set(compact('roles', 'clubs', 'countrySquads', 'matches', 'teams'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$roles = $this->User->Role->find('list');
		$clubs = $this->User->Club->find('list');
		$countrySquads = $this->User->CountrySquad->find('list');
		$matches = $this->User->Match->find('list');
		$teams = $this->User->Team->find('list');
		$this->set(compact('roles', 'clubs', 'countrySquads', 'matches', 'teams'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->User->read(null,$id);
		$oldData["User"]["active"]=false;
		if ($this->User->save($oldData)) {
			$this->Session->setFlash(__('User archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->User->read(null,$id);
		$oldData["User"]["active"]=true;
		if ($this->User->save($oldData)) {
			$this->Session->setFlash(__('User archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_requestFind($type,$findParams,$key) {
		if($key==Configure::read("key")){
			return $this->User->find($type, $findParams);
		}else{
			return null;
		}
	}
	
}
