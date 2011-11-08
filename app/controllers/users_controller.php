<?php
class UsersController extends AppController {

	var $name = 'Users';
	
	function beforeFilter() {
		parent::beforeFilter();
		if (isset($this -> params["prefix"]) && $this -> params["prefix"] == "admin") {
			$this -> Auth -> logoutRedirect = '/admin';
		} else {
			$this -> Auth -> logoutRedirect = '/';
			$this -> Auth -> loginRedirect = '/users/profile';
		}
		$this -> Auth -> allow('register', 'ajaxRegister', 'rememberPassword','enEspera');
	}

	function register() {
		if (!empty($this -> data)) {
			$this -> User -> create();
			$this -> data['User']['role_id']=3;
			if ($this -> User -> save($this -> data)) {
				$this -> Session -> setFlash(__('Registro Exitoso', true));
				$this->Auth->login($this->data);
				$this -> redirect(array('action' => 'profile'));
			} else {
				$this -> Session -> setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		$countries =  $this -> User -> Address -> Contry -> find('list');
		debug(key($countries));
		//$conditions['country_id']=empty($countries) ? null : key($countries);
		
		$cities =  $this -> User -> Address -> State -> find('list',array());
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
	
	function enEspera(){
		
	}

	function login() {
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
	function recordarPassword(){
		
	}
	function rememberPassword() {
		if (!empty($this -> data)) {
			$this -> User -> recursive = 0;
			$user = $this -> User -> find("first", array('conditions' => array('User.email' => trim($this -> data['User']['email']))));
			if ($user) {
				$newPassword = $this -> _generarPassword();
				$user["User"]["password"] = $this -> Auth -> password($newPassword);
				//debug($datos);
				$email = $user['User']['email'];
				$asunto = "Tu password de color tennis";
				$mensaje = "Tu nuevo password: " . $newPassword;
				$cabeceras = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				// Cabeceras adicionales
				$cabeceras .= 'From: Colors Tennis <info@colorstennis.com>' . "\r\n";
				//debug($mensaje);
				if (mail($email, $asunto, $mensaje, $cabeceras) && $this -> User -> save($user)) {
					echo true;
				} else {
					echo false;
				}
			} else {
				echo false;
			}

		}
		Configure::write('debug', 0);
		$this -> autoRender = false;
		exit(0);
	}

	function _generarPassword() {
		$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$cad = "";
		for ($i = 0; $i < 8; $i++) {
			$cad .= substr($str, rand(0, 62), 1);
		}
		return $cad;
	}

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

	function admin_login() {
		$this -> layout = "ez/login";
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
