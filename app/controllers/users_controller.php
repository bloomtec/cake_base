<?php
class UsersController extends AppController {

	var $name = 'Users';
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->autoRedirect=false;
		if (isset($this -> params["prefix"]) && $this -> params["prefix"] == "admin") {
			$this -> Auth -> logoutRedirect = '/admin';
		} else {
			$this -> Auth -> logoutRedirect = '/';
			$this -> Auth -> loginRedirect = '/users/profile';
		}
		$this -> Auth -> allow('register', 'ajaxRegister', 'resetPassword','enEspera', 'validateEmail');
	}
	
	/*
	 * 
	function register() {
		if (!empty($this -> data)) {
			$this -> User -> create();
			$this -> data['User']['role_id']=2;
			if ($this -> User -> save($this -> data)) {
				$this -> Session -> setFlash(__('Registro Exitoso', true));
				$this->Auth->login($this->data);
				$this -> redirect(array('action' => 'profile'));
			} else {
				$this -> Session -> setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
	}
	 *
	 */
	
	function register() {
		if (!empty($this -> data)) {
			$this -> data['User']['role_id'] = 2;
			$this -> data['User']['is_active'] = 1;
			$this -> User -> create();
			if ($this -> User -> save($this -> data)) {
				// Generar el codigo para el correo de registro
				$code = crypt($this->User->id, '23()23*$%g4F^aN!^^%');
				$code = urlencode($code);
				// Enviar el correo con el codigo
				$this->registrationEmail($this->data['User']['email'], $code);
				$this -> Session -> setFlash(__('Registration successful, please check your inbox to verify your email.', true));
				//$this->Auth->login($this->data);
				$this -> redirect(array('action' => 'validateEmail'));
			} else {
				$this -> Session -> setFlash(__('Registration failed, please try again.', true));
			}
		}
	}
	 
	function registerProvider() {
		if (!empty($this -> data)) {
			$this -> User -> create();
			$this -> data['User']['role_id']=3;
			$this -> data['User']['is_active']=false;
			if ($this -> User -> save($this -> data)) {
				$this -> Session -> setFlash(__('Registro Exitoso', true));
				$this->Auth->login($this->data);
				$this -> redirect(array('action' => 'profile'));
			} else {
				$this -> Session -> setFlash(__('No se pudo completar el registro. Por favor, intenta de nuevo.', true));
			}
		}
	}
	
	/*
	 * 
	function ajaxRegister() {
		if (!empty($this -> data)) {
			// Validar el nombre de usuario
			$user['User']['role_id'] = 2;
			$this -> User -> create();
			$this -> User -> set($this -> data);
			if ($this -> User -> save($this -> data)) {
				$this -> Auth -> login($this -> data);
				$userField = $this -> User -> read(null, $this -> Auth -> user('id'));
				echo true;
			} else {
				$errors = array();
				foreach ($this->User->invalidFields() as $name => $value) {
					$errors["data[User][" . $name . "]"] = $value;
				}

				echo json_encode($errors);
			}
		}
		$this -> autoRender = false;
		Configure::write('debug', 0);
		exit(0);
	}
	 * 
	 */

	function ajaxRegister() {
		if (!empty($this -> data)) {
			// Validar el nombre de usuario
			$this -> data['User']['role_id'] = 2;
			$this -> data['User']['is_active'] = 1;
			$this -> User -> create();
			if ($this -> User -> save($this -> data)) {
				$this -> data['Address']['user_id'] = $this -> User -> id;
				$code = crypt($this->User->id, '23()23*$%g4F^aN!^^%');
				// Enviar el correo con el codigo
				$this->registrationEmail($this->data['User']['email'], $code);
				//$address['Address'] = $this -> data['Address'];
				//$this -> User -> Address -> save($address);
				//$this -> Auth -> login($this -> data);
				//$userField = $this -> User -> read(null, $this -> Auth -> user('id'));
				echo true;
			} else {
				$errors = array();
				foreach ($this->User->invalidFields() as $name => $value) {
					$errors["data[User][" . $name . "]"] = $value;
				}
				echo json_encode($errors);
			}
		}
		$this -> autoRender = false;
		Configure::write('debug', 0);
		exit(0);
	}

	function ajaxRegisterProvider() {
		if (!empty($this -> data)) {
			// Validar el nombre de usuario
			$this -> data['User']['role_id'] = 3;
			$this -> data['User']['is_active']=false;
			$this -> User -> create();
			$this -> User -> set($this -> data);
			if ($this -> User -> save($this -> data)) {
				
				$userField = $this -> User -> read(null, $this -> Auth -> user('id'));
				echo true;
			} else {
				$errors = array();
				foreach ($this->User->invalidFields() as $name => $value) {
					$errors["data[User][" . $name . "]"] = $value;
				}

				echo json_encode($errors);
			}
		}
		$this -> autoRender = false;
		Configure::write('debug', 0);
		exit(0);
	}
	
	private function registrationEmail($email = null, $code = null) {	
		/**
		 * Asignar las variables del componente Email
		 */
		if($email && $code) {
			$reply_email = Configure::read('reply_register_mail');
			$from_email = Configure::read('register_mail');
			$site_name = Configure::read('site_name');
			
			/**
			 * Configurar el componente de correo
			 */
			$this -> Email -> to = $email;
			$this -> Email -> replyTo = $reply_email;
			$this -> Email -> return = $reply_email;
			$this -> Email -> from = $from_email;
			$this -> Email -> subject = "Registro al sitio $site_name";
			$this -> Email -> template = 'registration_email';
			$this -> Email -> sendAs = 'html';
			$this -> Email -> delivery = 'smtp';
			$this -> Email -> smtpOptions = array(
				'port' => '465',
				'timeout' => '30',
				'host' => 'ssl://smtp.gmail.com',
				'username' => $from_email,
				'password' => Configure::read('password_register_mail'),
				'client' => 'smtp_helo_clickandeat.co'
			);
			
			/**
			 * Asignar cosas al template
			 */
			$this -> set('code', $code);
			
			/**
			 * Enviar el correo
			 */
			Configure::write('debug', 0);
			$this -> Email -> send();
			$this -> set('smtp_errors', $this->Email->smtpError);
			$this -> Email -> reset();
		}
		
	}

	function validateEmail($code = null) {
		if(!$code) {
			if(!empty($this->data)) {
				if(isset($this->data['User']['validation_code']) && !empty($this->data['User']['validation_code'])) {
					$code = $this->data['User']['validation_code'];
				}
			}
		}
		
		$max_id = $this -> User -> find('first', array('fields' => array('MAX(User.id) as max_id')));
		$max_id = $max_id[0]['max_id'];
		$user = null;
		if($code) {
			$code = urldecode($code);
			for ($id_tested = 1; $id_tested <= $max_id; $id_tested+=1) {
				if ($code == crypt($id_tested, '23()23*$%g4F^aN!^^%')) {
					$user = $this -> User -> read(null, $id_tested);	
					break;
				} else {
					$user = null;
				}
			}
			
			if($user) {
				$user['User']['email_verified'] = true;
				if ($this -> User -> save($user)) {
					$this->Session->setFlash(__('Thank you for validating your email', true));
					$this -> redirect(array('controller'=>'users', 'action'=>'login'));
				} else {
					$this->Session->setFlash(__('An error ocurred while validating your email, please try again', true));
					$this -> redirect(array('controller'=>'users', 'action'=>'validateEmail'));
				}
			} else {
				$this -> Session -> setFlash(__('Enter a valid code and try again', true));
			}
		} else {
			$this -> Session -> setFlash(__('Enter the given code to verify', true));
		}
	}
	
	function enEspera(){
		$this -> layout = "personaliza";
	}

	function logout() {
		$this -> redirect($this -> Auth -> logout());
	}

	function profile() {
		$this->layout="profile";
		$this->set('user',$this->User->read(null, $this -> Auth -> user('id')));
	}
	function orders(){
		$this->layout="profile";
	}
	function edit($id) {
		$this->layout="profile";
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Usuario no valid', true));
			$this -> redirect(array('action' => 'index'));
		}

		if (!empty($this -> data)) {
			if (!empty($this -> data['User']['pass']))
				$this -> data['User']['password'] = $this -> Auth -> password($this -> data['User']['pass']);
			if ($this -> User -> saveAll($this -> data)) {
				$this -> Session -> setFlash(__('Tus datos se han actualizado', true));
				$this -> redirect(array('action' => 'profile'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar el usuario. Por favor, intenta de nuevo.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> User -> read(null, $id);
		}
		$roles = $this -> User -> Role -> find('list');
		$this -> set(compact('roles'));
	}

	function changePassword($id = null) {
		$this->layout="profile";
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid user', true));
			$this -> redirect(array('action' => 'profile'));
		}
		if (!empty($this -> data)) {
			$user = $this -> User -> findById($id);
			if ($user['User']['password'] == $this -> Auth -> password($this -> data['User']['old_password'])) {
				$user['User']['password'] = $this -> Auth -> password($this -> data['User']['new_password']);
				if ($this -> data['User']['new_password'] == $this -> data['User']['confirm_password'] && $this -> User -> save($user)) {
					$this -> Session -> setFlash(__('Se ha actualizado tu password', true));
					$this -> redirect($this -> referer());
				} else {
					$this -> Session -> setFlash(__('No coincide la confirmacion del password', true));
					$this -> redirect($this -> referer());
				}

			} else {
				$this -> Session -> setFlash(__('Su password anterior no es valido', true));
				$this -> redirect($this -> referer());
			}
		}
	}

	function resetPassword() {
		if (isset($this->data['User']['email']) && !empty($this->data['User']['email'])) {
			$this -> User -> recursive = 0;
			$user = $this -> User -> findByEmail(trim($this->data['User']['email']));
			if (!empty($user)) {
				$email = $user['User']['email'];
				$password = $this -> createPassword();
				$user['User']['password'] = $this -> Auth -> password($password);
				if($this -> User -> save($user)) {
					$this -> passwordEmail($email, $email, $password);
					//echo json_encode(array('success'=>true, 'message'=>__("An email has been sent to $email with the new password.", true)));
					$this -> Session -> setFlash(__("Se ha enviado un correo a <b>$email</b> con la nueva contraseña.", true));
				} else {
					//echo json_encode(array('success'=>false, 'message'=>__('An error occurred in the process. Please try again.', true)));
					$this -> Session -> setFlash(__('Ha ocurrido un error en el proceso. Por favor intenta de nuevo.', true));
				}
			} else {
				//echo json_encode(array('success'=>false, 'message'=>__('No user with that email registered', true)));
				$this -> Session -> setFlash(__('No hay un usuario registrado con ese correo.', true));
			}
		}
	}

	private function createPassword() {
		$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$cad = "";
		for ($i = 0; $i < 8; $i++) {
			$cad .= substr($str, rand(0, 62), 1);
		}
		return $cad;
	}
	
	private function passwordEmail($email = null, $username = null, $password = null) {	
		/**
		 * Asignar las variables del componente Email
		 */
		if($email && $username && $password) {
			// Address the message is going to (string). Separate the addresses with a comma if you want to send the email to more than one recipient.
			$this -> Email -> to = $email;
			// array of addresses to cc the message to
			$this -> Email -> cc = '';
			// array of addresses to bcc (blind carbon copy) the message to
			$this -> Email -> bcc = '';
			// reply to address (string)
			$this -> Email -> replyTo = Configure::read('reply_password_mail');
			// Return mail address that will be used in case of any errors(string) (for mail-daemon/errors)
			$this -> Email -> return = Configure::read('reply_password_mail');
			// from address (string)
			$this -> Email -> from = Configure::read('password_mail');
			// subject for the message (string)		
			$this -> Email -> subject = __('Password change request from ', true) . Configure::read('site_name');
			// The email element to use for the message (located in app/views/elements/email/html/ and app/views/elements/email/text/)
			$this -> Email -> template = 'password_email';
			// The layout used for the email (located in app/views/layouts/email/html/ and app/views/layouts/email/text/)
			//$this -> Email -> layout = '';
			// Length at which lines should be wrapped. Defaults to 70. (integer)
			//$this -> Email -> lineLength = '';
			// how do you want message sent string values of text, html or both
			$this -> Email -> sendAs = 'html';
			// array of files to send (absolute and relative paths)
			//$this -> Email -> attachments = '';
			// how to send the message (mail, smtp [would require smtpOptions set below] and debug)
			$this -> Email -> delivery = 'smtp';
			// associative array of options for smtp mailer (port, host, timeout, username, password, client)
			$this -> Email -> smtpOptions = array(
				'port' => '465',
				'timeout' => '30',
				'host' => 'ssl://smtp.gmail.com',
				'username' => Configure::read('password_mail'),
				'password' => Configure::read('password_password_mail'),
				'client' => 'smtp_helo_clickandeat.co'
			);
			
			/**
			 * Asignar cosas al template
			 */
			$this -> set('username', $username);
			$this -> set('password', $password);
			
			/**
			 * Enviar el correo
			 */
			Configure::write('debug', 0);
			$this -> Email -> send();
			$this -> set('smtp_errors', $this->Email->smtpError);
			$this -> Email -> reset();
		}
		
	}

	/*
	 * 
	function ajaxLogin() {
		if ($this -> Auth -> login($this -> data)) {
			$userField = $this -> User -> read(null, $this -> Auth -> user('id'));
			$this -> Session -> write('Auth.User.UserField', $userField['UserField']);
			echo true;
		} else {
			echo json_encode(array("data[User][email]" => "Verifique sus datos", "data[User][password]" => "Verifique sus datos"));
		}
		$this -> autoRender = false;
		Configure::write('debug', 0);
		exit(0);
	}
	 * 
	 */
	
	function ajaxLogin() {
		$this -> User -> recursive = -1;
		$user = $this -> User -> findByEmail($this->data['User']['email']);
		if(!empty($user)) {
			if($user['User']['email_verified']) {
				if ($this -> Auth -> login($this -> data)) {
					//$user = $this -> User -> read(null, $this -> Auth -> user('id'));
					$user['success']=true;
					$user['message']=__('Login successful',true);
				} else {
					$user['success']=false;
					$user['message']=__('Invalid data',true);
				}
			} else {
				$user['success']=false;
				$user['message']=__('Email has not been verified :: <a href="/users/validateEmail">Verify email</a>',true);
			}
		} else {
			$user['success']=false;
			$user['message']=__('No user with that email is registered', true);
		}
		echo json_encode($user);
		$this -> autoRender = false;
		Configure::write('debug', 0);
		exit(0);
	}
	
	function login() {
		if (isset($this->data['User']['email']) && !empty($this->data['User']['email']) && isset($this->data['User']['password']) && !empty($this->data['User']['password'])) {
			$this -> User -> recursive = -1;
			$user = $this -> User -> findByEmail($this->data['User']['email']);
			if (!empty($user)) {
				if($user['User']['email_verified']) {
					$this -> Auth -> login($user);
					$this -> redirect($this -> Auth -> redirect());
				} else {
					$this -> Auth -> logout($user);
					$this->redirect(array('controller'=>'users', 'action'=>'validateEmail'));
				}
			} else {
				//$this -> Session -> setFlash($this -> Auth -> loginError, $this -> Auth -> flashElement, array(), 'auth');
			}
		}
	}

	function admin_login() {
		$this -> layout = "ez/login";
		if (isset($this->data['User']['email']) && !empty($this->data['User']['email']) && isset($this->data['User']['password']) && !empty($this->data['User']['password'])) {
			$this -> User -> recursive = -1;
			$user = $this -> User -> findByEmail($this->data['User']['email']);
			if (!empty($user)) {
				if($user['User']['email_verified']) {
					$this -> Auth -> login($user);
					$this -> redirect($this -> Auth -> redirect());
				} else {
					$this -> Auth -> logout($user);
					$this->redirect(array('controller'=>'users', 'action'=>'validateEmail'));
				}
			} else {
				$this -> Session -> setFlash($this -> Auth -> loginError, $this -> Auth -> flashElement, array(), 'auth');
			}
		}
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
			if (!empty($this -> data['User']['pass']))
				$this -> data['User']['password'] = $this -> Auth -> password($this -> data['User']['pass']);
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
