<?php
class UsersController extends AppController {

	var $name = 'Users';
	
	/**
	 * Método de Auth component.
	 * Se declara para permitir el acceso a métodos necesarios
	 * para la correcta funcionalidad del plugin cuando se
	 * utiliza Auth component.
	 */
	function beforeFilter() {
		$this->Auth->allow('register');
	}
	
	function login() {
	}
	
	function logout() {
		$this->redirect($this->Auth->logout());
	}
	
	function register() {
		if (!empty($this->data)) {
			$isUserNameValid = false;
			$isDocumentValid = false;
			$isPasswordValid = false;
			$isMailValid = false;
			// Validar el nombre de usuario
			$tempUser = $this->User->findByUsername($this->data['User']['username']);
			if(empty($tempUser)) {
				$isUserNameValid = true;
			}
			// Validar el documento
			$tempUserFields = $this->User->UserField->findByDocument($this->data['User']['document']);
			if(empty($tempUserFields)) {
				$isDocumentValid = true;
			}
			$user = array();
			$user['User']['username'] = $this->data['User']['username'];
			if(!empty($this->data['User']['enter_password']) && ($this->data['User']['enter_password'] == $this->data['User']['confirm_password'])) {
				$user['User']['password'] = $this->Auth->password($this->data['User']['enter_password']);
				$isPasswordValid = true;
			}
			$user['User']['role_id'] = 3; // 1 - Admin; 2 - Gerente; 3 - Usuario
			$user['User']['active'] = 1;
			// Validar el correo
			$tempUser = $this->User->findByEmail($this->data['User']['email']);
			if(empty($tempUser) && !empty($this->data['User']['email']) && ($this->data['User']['email'] == $this->data['User']['confirm_email'])) {
				$isMailValid = true;
				$user['User']['email'] = $this->data['User']['email'];
			}
			if($isUserNameValid) {
				if($isDocumentValid) {
					if($isPasswordValid && $isMailValid) {
						if ($this->User->save($user)) {
							$user = $this->User->read(null, $this->User->id);
							$userFields = array();
							$userFields['UserField']['user_id'] = $user['User']['id'];
							$userFields['UserField']['document_type_id'] = $this->data['User']['document_type_id'];
							$userFields['UserField']['document'] = $this->data['User']['document'];
							$userFields['UserField']['name'] = $this->data['User']['name'];
							$userFields['UserField']['surname'] = $this->data['User']['surname'];
							$userFields['UserField']['phone'] = $this->data['User']['phone'];
							$userFields['UserField']['address'] = $this->data['User']['address'];
							$userFields['UserField']['birthday'] = $this->data['User']['birthday'];
							$this->User->UserField->save($userFields);
							$this->Session->setFlash(__('The user has been saved', true));
							$this->redirect(array('/'));
						} else {
							$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
						}	
					} else {
						$this->Session->setFlash(__('Password or email mismatch, email already registered or one of these fields was left empty. Please, try again.', true));
					}
				} else {
					$this->Session->setFlash(__('Document already registered. Please, try again.', true));
				}
			} else {
				$this->Session->setFlash(__('Username already registered. Please, try again.', true));
			}
		}
		$this->loadModel('DocumentType');
		$documentTypes = $this->DocumentType->find('list');
		$this->set(compact('documentTypes'));
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
		$this->set(compact('roles'));
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
		$this->set(compact('roles'));
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
}
