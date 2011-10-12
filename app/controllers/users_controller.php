<?php
class UsersController extends AppController {

	var $name = 'Users';
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('register');
	}

	function login() {
		
	}
	
	function admin_login() {
		
	}
	
	function logout() {
		$this -> redirect($this -> Auth -> logout());
	}
	
	function register() {
		if(!empty($this->data)) {
			/**
			 * Comprobar si los campos de correo son iguales
			 */
			if($this->data['User']['email'] != $this->data['User']['confirm_email']) {
				$this->Session->setFlash(__("The emails you entered are not equal.", true));
			} else {
				/**
				 * Comprobar si alguien ya esta registrado con el correo ingresado
				 */
				if($this->User->find('first', array('conditions'=>array('User.email' => $this->data['User']['email'])))) {
					$this->Session->setFlash(__("The email you entered is already registered.", true));
				} else {
					/**
					 * Comprobar que las contraseñas ingresadas son iguales
					 */
					if($this->data['User']['enter_password'] != $this->data['User']['confirm_password']) {
						$this->Session->setFlash(__("The passwords you entered are not equal.", true));
					} else {
						/**
						 * Registrar el usuario
						 */
						$this->User->create();
						$this->data['password'] = $this->Auth->password($this->data['User']['enter_password']);
						if($this->User->save($this->data)) {
							$this->Session->setFlash(__("Registration succesfull.", true));
						} else {
							$this->Session->setFlash(__("Registration failed, please try again.", true));
						}
					}
				}
			}
		}
	}

}
