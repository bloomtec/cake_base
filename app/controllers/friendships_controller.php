<?php
class FriendshipsController extends AppController {

	var $name = 'Friendships';
	
	function request(){
		$this->layout="ajax";	
	}
	
	function getFriendsIDs($user_id = null) {
		/**
		 * Campos de la tabla friendships
		 * id
		 * user_a_id
		 * user_b_id
		 * is_accepted
		 * is_blocked
		 * created
		 * updated
		 */
		$this->autoRender = false;
		if($user_id) {
			$friendlist_a = $this->Friendship->find(
				'list',
				array(
					'fields' => array('Friendship.user_a_id'),
					'conditions' => array(
						'Friendship.user_b_id' => $user_id,
						'Friendship.is_accepted' => 1,
						'Friendship.is_blocked' => 0
					),
					'recursive' => 0
				)
			);
			$friendlist_b = $this->Friendship->find(
				'list',
				array(
					'fields' => array('Friendship.user_b_id'),
					'conditions' => array(
						'Friendship.user_a_id' => $user_id,
						'Friendship.is_accepted' => 1,
						'Friendship.is_blocked' => 0
					),
					'recursive' => 0
				)
			);
			// Arreglo de ids a devolver
			$friends_ids = array();
			// Llenar el arreglo con las ids del primer resultado
			foreach($friendlist_a as $friend_id) {
				$friends_ids[] = $friend_id;
			}
			// Llenar el arreglo con las ids del segundo resultado
			foreach($friendlist_b as $friend_id) {
				$friends_ids[] = $friend_id;
			}
			return $friends_ids;
		} else {
			return array();
		}
	}

	function index() {
		$this->Friendship->recursive = 0;
		$this->set('friendships', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid friendship', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('friendship', $this->Friendship->read(null, $id));
	}
	
	/**
	 * $user_a_id :: id del usuario que solicita la amistad
	 * $user_b_id :: id del usuario al que le solicitan la amistad
	 * $message :: mensaje del usuario
	 */
	function viewFriendshipRequest($user_a_id, $user_b_id, $message) {	
		$this -> layout = "ajax";
		$user = $this -> Friendship -> User -> read(null, $user_a_id);
		$this -> set(compact("user"));
		$this -> set('user_a_id', $user_a_id);
		$this -> set('user_b_id', $user_b_id);
		$this -> set('message', $message);
	}
	
	function acceptFriendship($user_a_id, $user_b_id) {
		$this->autoRender=false;
		$data = $this->Friendship->find(
			'first', 
			array(
				'recursive' => -1,
				'conditions' => array(
					'Friendship.user_a_id' => $user_a_id,
					'Friendship.user_b_id' => $user_b_id
				)
			)
		);
		$data['Friendship']['is_accepted'] = true;
		if($this->Friendship->save($data)){
			echo "Has aceptado la solicitud de amistad";
		}else{
			echo "No se pudo aceptar la solicitud de amistad";
		}
		exit(0);
	}
	
	function rejectFriendship($user_a_id, $user_b_id) {
		$this->autoRender=false;
		$data = $this->Friendship->find(
			'first', 
			array(
				'recursive' => -1,
				'conditions' => array(
					'Friendship.user_a_id' => $user_a_id,
					'Friendship.user_b_id' => $user_b_id
				)
			)
		);
		$data['Friendship']['is_accepted'] = false;
		if($this->Friendship->save($data)){
			echo "Has rechazado la solicitud de amistad";
		}else{
			echo "No se pudo rechazar la solicitud de amistad";
		}
		exit(0);
	}

	function add() {
		$this->autoRender=false;
		if (!empty($this->data)) {
			$user_a_id = $this->Session->read('Auth.User.id');
			$user_b_id = $this->data['Friendship']['user_b_id'];
			$user_a_name = $this -> requestAction('/users/getUserName/' . $user_a_id);
			$message = $this -> data['Friendship']['message'];
			$this->data['Friendship']['user_a_id'] = $user_a;
			$this->Friendship->create();
			if ($this->Friendship->save($this->data)) {
				// Crear notificación de solicitud de amigo
				// Mensaje para la solicitud
				// ;
				$subject = "Solicitud de amistad de :: $nombre_solicitante";
				$content = "<div class=\"notificacion-usuario\"><a class=\"overlay\" href='/friendships/viewFriendshipRequest/$user_a_id/$user_b_id/$message'>Ver más</a></div>";
				$this->requestAction(
					'/user_notifications/createNotification/'
					. $user_b_id . '/'
					. $subject . '/'
					. $content
				);
				// Fin crear notificacion
				echo 'The friendship has been saved';
			} else {
				echo 'The friendship could not be saved. Please, try again.';
			}
		}
		Configure::write("debug",0);
		exit(0);
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid friendship', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Friendship->save($this->data)) {
				$this->Session->setFlash(__('The friendship has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The friendship could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Friendship->read(null, $id);
		}
		$userAs = $this->Friendship->UserA->find('list');
		$userBs = $this->Friendship->UserB->find('list');
		$this->set(compact('userAs', 'userBs'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for friendship', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Friendship->delete($id)) {
			$this->Session->setFlash(__('Friendship deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Friendship was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for friendship', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Friendship->read(null,$id);
		$oldData["Friendship"]["active"]=false;
		if ($this->Friendship->save($oldData)) {
			$this->Session->setFlash(__('Friendship archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Friendship was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for friendship', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Friendship->read(null,$id);
		$oldData["Friendship"]["active"]=true;
		if ($this->Friendship->save($oldData)) {
			$this->Session->setFlash(__('Friendship archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Friendship was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Friendship->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->Friendship->recursive = 0;
		$this->set('friendships', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid friendship', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('friendship', $this->Friendship->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Friendship->create();
			if ($this->Friendship->save($this->data)) {
				$this->Session->setFlash(__('The friendship has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The friendship could not be saved. Please, try again.', true));
			}
		}
		$userAs = $this->Friendship->UserA->find('list');
		$userBs = $this->Friendship->UserB->find('list');
		$this->set(compact('userAs', 'userBs'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid friendship', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Friendship->save($this->data)) {
				$this->Session->setFlash(__('The friendship has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The friendship could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Friendship->read(null, $id);
		}
		$userAs = $this->Friendship->UserA->find('list');
		$userBs = $this->Friendship->UserB->find('list');
		$this->set(compact('userAs', 'userBs'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for friendship', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Friendship->delete($id)) {
			$this->Session->setFlash(__('Friendship deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Friendship was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for friendship', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Friendship->read(null,$id);
		$oldData["Friendship"]["active"]=false;
		if ($this->Friendship->save($oldData)) {
			$this->Session->setFlash(__('Friendship archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Friendship was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for friendship', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Friendship->read(null,$id);
		$oldData["Friendship"]["active"]=true;
		if ($this->Friendship->save($oldData)) {
			$this->Session->setFlash(__('Friendship archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Friendship was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Friendship->find($type, $findParams);
	}else{
		return null;
	}
}
}
