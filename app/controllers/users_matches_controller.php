<?php
class UsersMatchesController extends AppController {

	var $name = 'UsersMatches';

	function getUsers($match_id = null) {
		if ($match_id) {
			$users_ids = $this -> UsersMatch -> find('list', array('fields' => 'UsersMatch.user_id', 'conditions' => array('UsersMatch.match_id' => $match_id)));
			return $this -> UsersMatch -> User -> find('all', array('recursive' => -1, 'conditions' => array('User.id' => $users_ids)));
		} else {
			return null;
		}
	}
	
	/**
	 * No sé que más va para ver una invitación a partido
	 * Revisar la vista para verificar que este bien!
	 */
	function viewUserMatchInvite($match_id) {
		$this -> layout = "ajax";
		$match = $this->UsersMatch->Match->read(null, $match_id);
		$this->set('match', $match);
	}
	
	function acceptInvite($match_id) {
		$this->autoRender=false;
		$data = $this->UsersMatch->find(
			'first', 
			array(
				'recursive' => -1,
				'conditions' => array(
					'UsersMatch.user_id' => $this->Session->read('Auth.User.id'),
					'UsersMatch.match_id' => $match_id
				)
			)
		);
		$data['UsersMatch']['user_match_status_id'] = 2;
		if($this->Friendship->save($data)){
			echo "Has aceptado la invitación al partido";
		}else{
			echo "Error al aceptar la invitación al partido";
		}
		exit(0);
	}
	
	function rejectInvite() {
		$this->autoRender=false;
		$data = $this->UsersMatch->find(
			'first', 
			array(
				'recursive' => -1,
				'conditions' => array(
					'UsersMatch.user_id' => $this->Session->read('Auth.User.id'),
					'UsersMatch.match_id' => $match_id
				)
			)
		);
		$data['UsersMatch']['user_match_status_id'] = 3;
		if($this->Friendship->save($data)){
			echo "Has rechazado la invitación al partido";
		}else{
			echo "Error al rechazar la invitación al partido";
		}
		exit(0);
	}

	function createMatch() {
		/**
		 * Campos matches
		 * @match_status_id :: (No hay estados definidos)
		 * @name
		 * @date
		 * @place
		 * @bet
		 * @message
		 * @user_creator_id
		 *
		 * Campos users_matches:
		 * @user_id
		 * @match_id
		 * @user_match_status_id (1 En espera, 2 Aceptado, 3 Rechazado)
		 *
		 * La idea que tengo para este proceso es:
		 * 1. Crear el match
		 * 2. a) Crear los respectivos users_matches
		 *    b) Enviar las notificaciones luego de crear el correspondiente user_match
		 */
		
		/**
		 * Código a revisar para la invitación a un partido
		 * Crear aquí el partido aquí o mover este código a matches::add() y modificar acorde
		 */
		$match = $this->UsersMatch->Match->create();
		if($this->UsersMatch->Match->save($this->data)) {
			$match_id = $this->UsersMatch->Match->id;
			$match_name = $this->requestAction('/matches/getMatchName/' . $match_id);
			$subject = "Invitación para jugar en el partido :: $match_name";
			$content = "<div class=\"notificacion-usuario\"><a class=\"overlay\" href=\"/users_matches/viewUserMatchInvite/$match_id'\">Ver más</a></div>";
			/**
			 * Recorrer los usuarios invitados al partido
			 */
			foreach($users as $user) {
				$this->loadModel("UserNotification");
				$this->UserNotification->create();
				$this->UserNotification->set('user_id', $user['User']['id']);
				$this->UserNotification->set('subject', $subject);
				$this->UserNotification->set('content', $content);
				$this->UserNotification->save();				
			}
		}
	}

	/**
	 * Lista todos los registros del usuario que estan en en_espera
	 */
	function getInvites($user_id = null) {
		return $this->find('all', array('recursive' => -1, 'conditions' => array('UsersMatch.user_id' => $this->Session->read('Auth.User.id'))));
	}

	function index() {
		$this -> UsersMatch -> recursive = 0;
		$this -> set('usersMatches', $this -> paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid users match', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('usersMatch', $this -> UsersMatch -> read(null, $id));
	}

	function add() {
		if (!empty($this -> data)) {
			$this -> UsersMatch -> create();
			if ($this -> UsersMatch -> save($this -> data)) {
				$this -> Session -> setFlash(__('The users match has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The users match could not be saved. Please, try again.', true));
			}
		}
		$users = $this -> UsersMatch -> User -> find('list');
		$matches = $this -> UsersMatch -> Match -> find('list');
		$userMatchStatuses = $this -> UsersMatch -> UserMatchStatus -> find('list');
		$this -> set(compact('users', 'matches', 'userMatchStatuses'));
	}

	function edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid users match', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> UsersMatch -> save($this -> data)) {
				$this -> Session -> setFlash(__('The users match has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The users match could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> UsersMatch -> read(null, $id);
		}
		$users = $this -> UsersMatch -> User -> find('list');
		$matches = $this -> UsersMatch -> Match -> find('list');
		$userMatchStatuses = $this -> UsersMatch -> UserMatchStatus -> find('list');
		$this -> set(compact('users', 'matches', 'userMatchStatuses'));
	}

	function delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for users match', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> UsersMatch -> delete($id)) {
			$this -> Session -> setFlash(__('Users match deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Users match was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for users match', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> UsersMatch -> read(null, $id);
		$oldData["UsersMatch"]["active"] = false;
		if ($this -> UsersMatch -> save($oldData)) {
			$this -> Session -> setFlash(__('Users match archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Users match was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for users match', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> UsersMatch -> read(null, $id);
		$oldData["UsersMatch"]["active"] = true;
		if ($this -> UsersMatch -> save($oldData)) {
			$this -> Session -> setFlash(__('Users match archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Users match was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> UsersMatch -> find($type, $findParams);
		} else {
			return null;
		}
	}

	function admin_index() {
		$this -> UsersMatch -> recursive = 0;
		$this -> set('usersMatches', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid users match', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('usersMatch', $this -> UsersMatch -> read(null, $id));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> UsersMatch -> create();
			if ($this -> UsersMatch -> save($this -> data)) {
				$this -> Session -> setFlash(__('The users match has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The users match could not be saved. Please, try again.', true));
			}
		}
		$users = $this -> UsersMatch -> User -> find('list');
		$matches = $this -> UsersMatch -> Match -> find('list');
		$userMatchStatuses = $this -> UsersMatch -> UserMatchStatus -> find('list');
		$this -> set(compact('users', 'matches', 'userMatchStatuses'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid users match', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> UsersMatch -> save($this -> data)) {
				$this -> Session -> setFlash(__('The users match has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The users match could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> UsersMatch -> read(null, $id);
		}
		$users = $this -> UsersMatch -> User -> find('list');
		$matches = $this -> UsersMatch -> Match -> find('list');
		$userMatchStatuses = $this -> UsersMatch -> UserMatchStatus -> find('list');
		$this -> set(compact('users', 'matches', 'userMatchStatuses'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for users match', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> UsersMatch -> delete($id)) {
			$this -> Session -> setFlash(__('Users match deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Users match was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for users match', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> UsersMatch -> read(null, $id);
		$oldData["UsersMatch"]["active"] = false;
		if ($this -> UsersMatch -> save($oldData)) {
			$this -> Session -> setFlash(__('Users match archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Users match was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for users match', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> UsersMatch -> read(null, $id);
		$oldData["UsersMatch"]["active"] = true;
		if ($this -> UsersMatch -> save($oldData)) {
			$this -> Session -> setFlash(__('Users match archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Users match was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> UsersMatch -> find($type, $findParams);
		} else {
			return null;
		}
	}

}
