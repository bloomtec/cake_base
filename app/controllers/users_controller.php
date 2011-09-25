<?php
class UsersController extends AppController {

	var $name = 'Users';
	
	function getUserName($user_id = null) {
		if($user_id) {
			$user_fields = $this -> User -> UserField -> find(
				'first',
				array(
					'recursive' => -1,
					'conditions' => array(
						'UserField.user_id' => $user_id 
					)
				)
			);
			return $user_fields['UserField']['name'] . ' ' . $user_fields['UserField']['surname'];
		}
	}
	
	function search() {
		$this -> layout = "ajax";
		$user_id = $this -> Auth->user("id");
		$nombre = $this -> params["named"]["nombre"];
		$email = $this -> params["named"]["email"];
		$include_friends = $this -> params["named"]["include-friends"];
		$limit = 0;
		if(isset($this->params['named']['limit'])){
			$limit = $this->params['named']['limit'];
		} else {
			$limit = 14;
		}
		//$this->params["named"]["limit"];
		//DEBE LISTAR TODOS LOS QUE CUMPLAN EL CRITERIO
		if($user_id) {
			/**
			 * Realizar busqueda tipo OR porque se incluyen nombe y correo
			 */
			if(!empty($nombre) && !empty($email)){
				$users_ids = $this->requestAction('/user_fields/searchUsersByNameSurname/' . $nombre);
				if($include_friends) {
					$this->paginate = array(
						'conditions' => array(
							'User.email LIKE' => "%$email%",
							'User.id' => $users_ids,
							'NOT' => array(
								'User.id' => $user_id
							)
						),
						'limit' => $limit
					);
				} else {
					$friends_ids = $this->requestAction('friendships/getFriendsIDs/' . $user_id);
					$this->paginate = array(
						'conditions' => array(
							'OR' => array(
								'User.email LIKE' => "%$email%",
								'User.id' => $users_ids
							),
							'NOT' => array(
								'User.id' => $user_id,
								'User.id' => $friends_ids
							)
						),
						'limit' => $limit
					);
					$this->set('friends', $this->paginate('User'));
				}
			} else {
				/**
				 * Aqui solo se incluye el nombre o el correo
				 * Verificar cual esta para proceder acorde
				 */
				if(!empty($nombre)) {
					/**
					 * Se incluye el nombre
					 */
					$users_ids = $this->requestAction('/user_fields/searchUsersByNameSurname/' . $nombre);
					if($include_friends) {
						$this->paginate = array(
							'conditions' => array(
								'User.id' => $users_ids,
								'NOT' => array(
									'User.id' => $user_id
								)
							),
							'limit' => $limit
						);
					} else {
						$friends_ids = $this->requestAction('friendships/getFriendsIDs/' . $user_id);
						$this->paginate = array(
							'conditions' => array(
								'User.id' => $users_ids,
								'NOT' => array(
									'User.id' => $user_id,
									'User.id' => $friends_ids
								)
							),
							'limit' => $limit
						);
						$this->set('friends', $this->paginate('User'));
					}
				} else {
					/**
					 * Se incluye el email
					 */
					if(!empty($email)) {
						if($include_friends) {
							$ids_emails = $this->User->find(
								'list',
								array(
									'conditions' => array(
										'User.email LIKE' => "%$email%",
										'NOT' => array(
											'User.id' => $user_id
										)
									),
									'fields' => 'User.id'
								)
							);
							$friends_ids = $this->requestAction('friendships/getFriendsIDs/' . $user_id);
							$this->paginate = array(
								'conditions' => array(
									'User.id' => $ids_emails,
									'NOT' => array(
										'User.id' => $user_id
									)
								),
								'limit' => $limit
							);
							$this->set('friends', $this->paginate('User'));
						} else {
							$ids_emails = $this->User->find(
								'list',
								array(
									'conditions' => array(
										'User.email LIKE' => "%$email%",
										'NOT' => array(
											'User.id' => $user_id
										)
									),
									'fields' => 'User.id'
								)
							);
							$friends_ids = $this->requestAction('friendships/getFriendsIDs/' . $user_id);
							$this->paginate = array(
								'conditions' => array(
									'User.id' => $ids_emails,
									'NOT' => array(
										'User.id' => $user_id,
										'User.id' => $friends_ids
									)
								),
								'limit' => $limit
							);
							$this->set('friends', $this->paginate('User'));
						}						
					} else {
						/**
						 * Llega eso vacio
						 */
						$friends_ids = $this->requestAction('friendships/getFriendsIDs/' . $user_id);
						$this->paginate = array(
							'conditions' => array(
								'NOT' => array(
									'User.id' => $user_id
								)
							),
							'limit' => $limit
						);
						$this->set('friends', $this->paginate('User'));
					}
				}
			}
		}
	}
	
	function ajax_addToFriends() {
	
	}
	
	function listFriends() {
		$this->layout="ajax";
		$user_id=$this->Auth->user("id");
		if($user_id) {
			$friends_ids = $this->requestAction('friendships/getFriendsIDs/' . $user_id);
			$this->paginate=array("limit"=>1);
			$this->set("friends", $this->paginate("User", array('User.id' => $friends_ids)));
		}
	}
	
	function listNoFriends() {
		$this->layout="ajax";
		$user_id=$this->Auth->user("id");
		$nombre=$this->params["named"]["nombre"];
		$email=$this->params["named"]["email"];
		//DEBE LISTAR LOS QUE NO SON AMIGOS
		if($user_id) {
			$friends_ids = $this->requestAction('friendships/getFriendsIDs/' . $user_id);
			$this->paginate=array("limit"=>1);
			$this->set("friends", $this->paginate("User", array('User.id' => $friends_ids)));
		}
	}

	function listNotTeamUsers() {
		$this->layout="ajax";
		$user_id = $this->Session->read('Auth.User.id');
		$team_id = $this->params['named']['team_id'];
		// ID's de los amigos
		$friends_ids = $this->requestAction('friendships/getFriendsIDs/' . $user_id);
		// ID's de los jugadores del equipo
		$team_users_ids = $this->User->UsersTeam->find(
			'list',
			array(
				'recursive' => -1,
				'conditions' => array(
					'UsersTeam.team_id' => $team_id
				),
				'fields' => array(
					'UsersTeam.user_id'
				)
			)
		);
		
		$this->set('friends', $this->paginate('User', array('User.id' => $friends_ids, 'NOT User.id' => $team_users_ids)));
	}

	function login() {}

	function admin_login() {}

	function logout() {
		$this -> redirect($this -> Auth -> logout());
	}
	
	function changePassword() {
		if(!empty($this->data)) {
			// Validar el id del usuario
			if($this -> data['User']['id'] == $this -> Session -> read('Auth.User.id')) {
				$user = $this -> User -> read(null, $this -> data['User']['id']);
				// Validar la contraseña actual
				if($this -> Auth -> password($this -> data['User']['enter_old_password']) == $user['User']['password']) {
					// Validar la nueva contraseña
					if($this -> data['User']['enter_new_password'] == $this -> data['User']['repeat_new_password']) {
						// Todo coincide, cambiar la contraseña
						$user['User']['password'] = $this -> Auth -> password($this -> data['User']['enter_new_password']);
						$this -> User -> save($user);
						$this -> Session -> setFlash('La contraseña ha sido cambiada con exito');
					} else {
						$this -> Session -> setFlash('No coincide la nueva contraseña con su verificación');
					}
				} else {
					$this -> Session -> setFlash('La contraseña actual no coincide con la registrada');
				}
			} else {
				$this -> Session -> setFlash('Error en el envío de datos de cambio de contraseña');
			}			
		}
	}

	function register() {
		if (!empty($this -> data)) {
			// Validar la contraseña
			$isPasswordValid = false;
			if (
				!empty($this -> data['User']['password'])
				&& ($this -> data['User']['password'] == $this->Auth->password($this -> data['User']['password2']))
			) {
				$isPasswordValid = true;
			}
			// Validar el correo
			$isMailValid = false;
			$tempUser = $this -> User -> findByEmail($this -> data['User']['email']);
			if (
				empty($tempUser)
				&& !empty($this -> data['User']['email'])
			) {
				$isMailValid = true;
			}
			if ($isPasswordValid && $isMailValid) {
				$user = $this->User->create();
				$user['User']['password'] = $this -> data['User']['password'];
				$user['User']['email'] = $this -> data['User']['email'];
				$user['User']['role_id'] = 2; // 1 - Admin; 2 - Usuario
				$user['User']['active'] = 1;
				// Guardar el usuario
				if ($this -> User -> save($user)) {
					$this -> loadModel('UserField');
					$userFields = $this -> UserField -> create();
					$userFields['UserField']['user_id'] = $this -> User -> id;
					$userFields['UserField']['name'] = $this -> data['UserField']['nombres'];
					$userFields['UserField']['surname'] = $this -> data['UserField']['apellidos'];
					$userFields['UserField']['birthday'] = $this -> data['UserField']['birthday'];
					$userFields['UserField']['gender'] = $this -> data['UserField']['gender'];
					$userFields['UserField']['image'] = $this -> data['UserField']['image'];
					$userFields['UserField']['foot_id'] = $this -> data['UserField']['foot_id'];
					$userFields['Position']=$this->data["Position"];
					// Guardar los campos de usuario
					if($this -> UserField -> save($userFields)) {
						// Registrar las posiciones
						/*foreach($this->data['Position']['Position'] as $key=>$value) {
							$this->UserField->UserFieldsPosition->create();
							$this->UserField->UserFieldsPosition->set('user_field_id', $this->UserField->id);
							$this->UserField->UserFieldsPosition->set('position_id', $value);
							$this->UserField->UserFieldsPosition->save();
						}*/
						
						// Guardar los clubes del usuario
						if(isset($this -> data['Club']) && !empty($this -> data['Club'])) {
							foreach($this -> data['Club'] as $club_id) {
								$this -> requestAction('/clubs_users/addUserToClub/' . $this -> User -> id . '/' . $club_id);
							}
						} else {
							// No hay clubes a registrar con el usuario
						}
						// Guardar los equipos de país del usuario
						if(isset($this -> data['CountrySquad']) && !empty($this -> data['CountrySquad'])) {
							foreach($this -> data['CountrySquad'] as $country_squad_id) {
								$this -> requestAction('/country_squads_users/addUserToCountrySquad/' . $this -> User -> id . '/' . $country_squad_id);
							}
						} else {
							// No hay clubes a registrar con el usuario
						}
					} else {
						$this -> Session -> setFlash(__('Error al registrar los campos de usuario, intente de nuevo', true));
					}
					$this -> Session -> setFlash(__('Registro exitoso', true));
					$this -> redirect(array('/'));
				} else {
					$this -> Session -> setFlash(__('Error al registrar el usuario, intente de nuevo', true));
				}
			} else {
				$this -> Session -> setFlash(__('El correo ya esta registrado o las contraseñas no coinciden, intente de nuevo', true));
			}
		}
	}

	function index() {
		$this->layout="ajax";
		$this->User->recursive = 0;
		$this->paginate=array("limit"=>2);
		$this->set('users', $this->paginate());
	}

	function profile($id = null) {
		$this->layout="ajax";
		if (!$id) {
			
		}
		$this->set('userField',$this->User->UserField->find("first",array("conditions"=>array("user_id"=>$id))));
	
	}
	function myProfile($id = null) {
		$this->layout="ajax";
		$notifications = $this->requestAction('/user_notifications/getNotifications');
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
		$this->set('notifications', $notifications);
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
	function editPreferencias($id = null) {
		$this->layout="ajax";
		if (!$id && empty($this->data)) {
			
			
		}
		if (!empty($this->data)) {
			if ($this->User->saveAll($this->data)) {
				echo "Se han modificado tus datos";
			} else {
				echo "Se han modificato tus datos";
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
	function edit($id = null) {
		$this->layout="ajax";
		if (!$id && empty($this->data)) {
			
			
		}
		if (!empty($this->data)) {
			if ($this->User->saveAll($this->data)) {
				echo "Se han modificado tus datos";
			} else {
				echo "Se han modificato tus datos";
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
