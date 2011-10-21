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
		parent::beforeFilter();
		$this->Auth->logoutRedirect='/';
		$this -> Auth -> allow('register', 'keepShopping','ajaxRegister');
	}
	
	function keepShopping() {
		$this->layout="ajax";
		echo $this->webroot;
		exit(0);
		return;
	}
	function profile(){
		$this->layout='callback';
	}
	
	function isLoggedIn() {
		$this->layout="ajax";
		$x = $this->Session->read('Auth.User.id');
		if(!empty($x)) {
			echo 'true';
		} else {
			echo 'false';
		}
		exit(0);
		return;
	}

	function login() {
		$this->layout=("overlay2");
		if (!empty($this -> data) && !empty($this -> Auth -> data['User']['username']) && !empty($this -> Auth -> data['User']['password'])) {
			$user = $this -> User -> find('first', array('conditions' => array('User.email' => $this -> Auth -> data['User']['username'], 'User.password' => $this -> Auth -> data['User']['password']), 'recursive' => -1));
			if (!empty($user) && $this -> Auth -> login($user)) {
				if ($this -> Auth -> autoRedirect) {
					$this -> redirect($this -> Auth -> redirect());
				}
			} else {
				$this -> Session -> setFlash($this -> Auth -> loginError, $this -> Auth -> flashElement, array(), 'auth');
			}
		}
		$this->set('titulo','LOGIN / REGÍSTRATE');
	}

	function admin_login() {
		$this->layout="login";
		if (!empty($this -> data) && !empty($this -> Auth -> data['User']['username']) && !empty($this -> Auth -> data['User']['password'])) {
			$user = $this -> User -> find('first', array('conditions' => array('User.email' => $this -> Auth -> data['User']['username'], 'User.password' => $this -> Auth -> data['User']['password']), 'recursive' => -1));
			if (!empty($user) && $this -> Auth -> login($user)) {
				if ($this -> Auth -> autoRedirect) {
					$this -> redirect($this -> Auth -> redirect());
				}
			} else {
				$this -> Session -> setFlash($this -> Auth -> loginError, $this -> Auth -> flashElement, array(), 'auth');
			}
		}
	}

	function logout() {
		$this -> redirect($this -> Auth -> logout());
	}
	function ajaxLogin(){
		if($this->Auth->login($this->data)){
			$userField=$this->User->read(null,$this->Auth->user('id'));
			$this->Session->write('Auth.User.UserField',$userField['UserField']);
			echo true;
		}else{
			echo json_encode(array("data[User][email]"=>"Verifique sus datos","data[User][password]"=>"Verifique sus datos"));
		}
		$this->autoRender=false;
		Configure::write('debug',0);
		exit(0);
	}
	function register() {
		if (!empty($this -> data)) {
			// Validar el nombre de usuario
			$tempUser = $this -> User -> findByUsername($this -> data['User']['username']);
			$user['User']['role_id'] = 2;
			if($this->User->saveAll($this->data)){
					$this -> Session -> setFlash(__('The user could not be saved. Please, try again.', true));
			}else{
				
			}

		}
		$this -> loadModel('DocumentType');
		$documentTypes = $this -> DocumentType -> find('list');
		$this -> set(compact('documentTypes'));
	}
	function ajaxRegister() {
		if (!empty($this -> data)) {
			// Validar el nombre de usuario
			$user['User']['role_id'] = 2;
			$this -> User -> create();
			$this->User->set( $this->data );
			if($this->User->saveAll($this->data)){
				$this->Auth->login($this->data);
				$userField=$this->User->read(null,$this->Auth->user('id'));
				$this->Session->write('Auth.User.UserField',$userField['UserField']);
				echo true;
			}else{
				$errors=array();
				foreach($this->User->invalidFields() as $name => $value){
					$errors["data[User][".$name."]"]=$value;
				}
				
				echo json_encode($errors); 
			}
		}
		$this->autoRender=false;
		Configure::write('debug',0);
		exit(0);
	}
	function validateEmail(){
		
	}
	function admin_index() {
		$this -> User -> recursive = 0;
		$this -> set('users', $this -> paginate());
	}
	function admin_logout() {
		$this -> redirect($this -> Auth -> logout());
	}
	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid user', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('user', $this -> User -> read(null, $id));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> User -> create();
			if ($this -> User -> save($this -> data)) {
				$this -> Session -> setFlash(__('The user has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		$roles = $this -> User -> Role -> find('list');
		$this -> set(compact('roles'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid user', true));
			$this -> redirect(array('action' => 'index'));
		}
		
		if (!empty($this -> data)) {
			if(!empty($this->data['User']['pass'])) $this->data['User']['password']=$this->Auth->password($this->data['User']['pass']);
			if ($this -> User -> save($this -> data)) {
				$this -> Session -> setFlash(__('The user has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> User -> read(null, $id);
		}
		$roles = $this -> User -> Role -> find('list');
		$this -> set(compact('roles'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for user', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> User -> delete($id)) {
			$this -> Session -> setFlash(__('User deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('User was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

}
