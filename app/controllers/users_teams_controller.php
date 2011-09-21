<?php
class UsersTeamsController extends AppController {

	var $name = 'UsersTeams';
	
	function viewCalling($user_id=null,$team_id=null){
		$this->layout="ajax";
		$team=$this->UsersTeam->Team->read(null,$team_id);
		$this->set(compact("team"));
		
	}
	function getPayroll($team_id = null) {
		$this->layout="ajax";
		if($team_id) {
			$this->loadModel("User");
			$users_ids = $this->UsersTeam->find('list', array('conditions' => array('UsersTeam.team_id' => $team_id), 'fields' => array('UsersTeam.user_id')));
			$this->paginate=array("limit"=>1);
			$this->set("payroll", $this->paginate("User", array('User.id' => $users_ids)));
		} else {
			$this->set("payroll", null);
		}
	}
	
	function createInviteToTeam($user_caller_id = null, $user_id = null, $team_id = null) {
		if($user_id && $team_id && $user_caller_id) {
			$invite = $this->UsersTeam->create();
			$invite['UsersTeam']['user_id'] = $user_id;
			$invite['UsersTeam']['team_id'] = $team_id;
			$invite['UsersTeam']['caller_user_id'] = $user_caller_id;
			if($this->UsersTeam->save($invite)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	function createRequestToTeam($user_id, $team_id) {
		if($user_id && $team_id) {
			$invite = $this->UsersTeam->create();
			$invite['UsersTeam']['user_id'] = $user_id;
			$invite['UsersTeam']['team_id'] = $team_id;
			if($this->UsersTeam->save($invite)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	function ajax_addUserToTeam($user_id, $team_id) {
		$this->autoRender = false;
		if($user_id && $team_id) {
			$invite = $this->UsersTeam->create();
			$invite['UsersTeam']['user_id'] = $user_id;
			$invite['UsersTeam']['team_id'] = $team_id;
			if($this->UsersTeam->save($invite)) {
				echo 1;
			} else {
				echo 0;
			}
		} else {
			echo 0;
		}
	}
	
	function ajax_deleteUserFromTeam($user_id, $team_id) {
		$this->autoRender = false;
		if($user_id && $team_id) {
			$result = $this->UsersTeam->find('first', array('condition' => array('user_id' => $user_id, 'team_id' => $team_id)));
			if($result && $this->UsersTeam->delete($result['UsersTeam']['id'], false)) {
				echo 1;
			} else {
				echo 0;
			}
		} else {
			echo 0;
		}
	}
	
	function acceptCallToTeam($user_id = null, $team_id = null) {
		$this->autoRender=false;
		$data = $this->UsersTeam->find(
			'first', 
			array(
				'recursive' => -1,
				'conditions' => array(
					'UsersTeam.user_id' => $user_id,
					'UsersTeam.team_id' => $team_id
				)
			)
		);
		$data['UsersTeam']['user_team_status_id'] = 2;
		if($this->UsersTeam->save($data)){
			echo "Ya haces parte del equipo";
		}else{
			echo "No se pudo aceptar la convocatoria";
		}
		exit(0);
		
	}
	
	function rejectCallToTeam($user_id = null, $team_id = null) {
		$data = $this->UsersTeam->find(
			'first', 
			array(
				'recursive' => -1,
				'conditions' => array(
					'UsersTeam.user_id' => $user_id,
					'UsersTeam.team_id' => $team_id
				)
			)
		);
		$data['UsersTeam']['user_team_status_id'] = 3;
		$this->UsersTeam->save($data);
	}
	
	function ajax_callUserToTeam() {
		$this->autoRender = false;
		$user_id = $this->params['named']['user_id'];
		$team_id = $this->params['named']['team_id'];
		$this -> UsersTeam -> create();
		$this -> UsersTeam -> set('user_id', $user_id);
		$this -> UsersTeam -> set('team_id', $team_id);
		$this -> UsersTeam -> set('is_captain', false);
		$this -> UsersTeam -> set('user_team_status_id', 1);
		$this -> UsersTeam -> set('caller_user_id', $this->Session->read('Auth.User.id'));
		if($this -> UsersTeam -> save()) {
			$team_name = $this->requestAction('/teams/getTeamName/' . $team_id);
			$subject = "Convocatoria Al Equipo :: $team_name";
			$content =
				"<div class=\"notificacion-usuario\">"
				. "<a class=\"aceptar\" href='/users_teams/acceptCallToTeam/$user_id/$team_id'>Aceptar</a><br />"
				. "<class=\"rechazar\" href='/users_teams/rejectCallToTeam/$user_id/$team_id'>Rechazar</a><br />"
				. "</div>";
			$done = $this->requestAction(
				'/user_notifications/createNotification/'
				. $this->params['named']['user_id'] . '/'
				. $subject . '/'
				. $content
			);
			if($done) {
				echo 1;
			} else {
				echo 0;
			}
		} else {
			echo 0;
		}
	}

	function index() {
		$this->UsersTeam->recursive = 0;
		$this->set('usersTeams', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid users team', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('usersTeam', $this->UsersTeam->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->UsersTeam->create();
			if ($this->UsersTeam->save($this->data)) {
				$this->Session->setFlash(__('The users team has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The users team could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid users team', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->UsersTeam->save($this->data)) {
				$this->Session->setFlash(__('The users team has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The users team could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->UsersTeam->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for users team', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->UsersTeam->delete($id)) {
			$this->Session->setFlash(__('Users team deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Users team was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for users team', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->UsersTeam->read(null,$id);
		$oldData["UsersTeam"]["active"]=false;
		if ($this->UsersTeam->save($oldData)) {
			$this->Session->setFlash(__('Users team archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Users team was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for users team', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->UsersTeam->read(null,$id);
		$oldData["UsersTeam"]["active"]=true;
		if ($this->UsersTeam->save($oldData)) {
			$this->Session->setFlash(__('Users team archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Users team was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->UsersTeam->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->UsersTeam->recursive = 0;
		$this->set('usersTeams', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid users team', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('usersTeam', $this->UsersTeam->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->UsersTeam->create();
			if ($this->UsersTeam->save($this->data)) {
				$this->Session->setFlash(__('The users team has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The users team could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid users team', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->UsersTeam->save($this->data)) {
				$this->Session->setFlash(__('The users team has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The users team could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->UsersTeam->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for users team', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->UsersTeam->delete($id)) {
			$this->Session->setFlash(__('Users team deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Users team was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for users team', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->UsersTeam->read(null,$id);
		$oldData["UsersTeam"]["active"]=false;
		if ($this->UsersTeam->save($oldData)) {
			$this->Session->setFlash(__('Users team archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Users team was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for users team', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->UsersTeam->read(null,$id);
		$oldData["UsersTeam"]["active"]=true;
		if ($this->UsersTeam->save($oldData)) {
			$this->Session->setFlash(__('Users team archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Users team was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->UsersTeam->find($type, $findParams);
	}else{
		return null;
	}
}
}
