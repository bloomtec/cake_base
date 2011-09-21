<?php
class FriendshipsController extends AppController {

	var $name = 'Friendships';
	
	function request(){
		$this->layout="ajax";
		
	}
	
	function acceptFriendship() {
		
	}
	
	function rejectFriendship() {
		
	}
	
	function requestFriendship() {
		
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

	function add() {
		$this->autoRender=false;
		if (!empty($this->data)) {
			$this->Friendship->create();
			if ($this->Friendship->save($this->data)) {
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
