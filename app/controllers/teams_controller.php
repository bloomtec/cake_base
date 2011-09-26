<?php
class TeamsController extends AppController {

	var $name = 'Teams';
	
	function search() {
		$this->layout="ajax";
	}
	
	function request() {
		$this->layout="ajax";
		if(!empty($this->params) && isset($this->params['named']['team_id'])) {
			
		}
	}
	
	/**
	 * Retorna los equipos con el nombre COMO la criteria de busqueda
	 * y en los que el usuario no haga parte.
	 */
	function ajaxSearch() {
        $this->layout="ajax";
        if(isset($this->params['named']['criteria'])) {
        	$limit = 3;
        	if(isset($this->params['named']['limit'])) {
        		$limit = $this->params['named']['limit'];
			}
			$criteria = $this->params['named']['criteria'];
            $user_teams_data = $this->myTeams();
            $user_teams_ids = array();
            foreach($user_teams_data as $key=>$val) {
                $user_teams_ids[] = $key;
            }
			$teams = $this->paginate(
				'Team',
				array(
					'Team.name LIKE' => "%$criteria%",
					'NOT' => array(
						'Team.id' => $user_teams_ids
					)
				)
			);
			$this->paginate=array("limit"=>$limit);
			$this->set("teams", $teams);
        }
    }
	
	function getTeamName($team_id = null) {
		$team = $this->Team->read('name', $team_id);
		return $team['Team']['name'];
	}

	/**
	 * Retorna los equipos en que el usuario logueado es
	 * el capitan
	 */
	function listUserTeamsWhereCaptain() {
		$user_id = $this -> Session -> read('Auth.User.id');
		$teams_ids_where_captain = $this -> Team -> User -> UsersTeam -> find(
			'list',
			array(
				'recursive' => -1,
				'conditions' => array(
					'UsersTeam.user_id' => $user_id,
					'UsersTeam.is_captain' => true
				),
				'fields' => array(
					'UsersTeam.team_id'
				)
			)
		);
		$teams_where_captain = $this -> Team -> find(
			'all',
			array(
				'recursive' => -1,
				'conditions' => array(
					'Team.id' => $teams_ids_where_captain
				)
			)
		);
		$this -> set('teams', $teams_where_captain);
	}
	
	function listUserTeams($user_id = null) {
		$this->layout="ajax";
		if(empty($user_id)) {
			$user_id = $this->Session->read('Auth.User.id');
		}
		$user_teams_ids = $this -> Team -> UsersTeam -> find('list', array('recursive' => -1, 'conditions' => array('UsersTeam.user_team_status_id' => 2, 'UsersTeam.user_id' => $user_id), 'fields' => 'UsersTeam.team_id'));
		$teams = $this->paginate('Team', array('Team.id' => $user_teams_ids));
		$this -> set('teams', $teams);
	}
	
	/**
	 * Retorna los equipos a los que no pertenece el usuario logueado
	 */
	function listNotUserTeams() {
		$this->layout="ajax";
		$teams_ids_in = $this -> Team -> UsersTeam -> find(
			'list',
			array(
				'recursive' => -1,
				'conditions' => array(
					'UsersTeam.user_id' => $this -> Session -> read('Auth.User.id')
				),
				'fields' => 'UsersTeam.team_id'
			)
		);
		$this -> set('teams', $this->paginate('Team', array('NOT Team.id' => $teams_ids_in)));
	}

	/**
	 * Retorna los equipos a los que pertenece el usuario logueado
	 */
	function myTeams() {
		$teams_ids_in = $this -> Team -> UsersTeam -> find(
			'list',
			array(
				'recursive' => -1,
				'conditions' => array(
					'UsersTeam.user_id' => $this -> Session -> read('Auth.User.id'),
					'UsersTeam.user_team_status_id' => 2
				),
				'fields' => array(
					'UsersTeam.team_id'
				)
			)
		);
		$user_teams = $this -> Team -> find(
			'all',
			array(
				'recursive' => -1,
				'conditions' => array(
					'Team.id' => $teams_ids_in
				)
			)
		);
		
		$teams_list = array();
		
		foreach($user_teams as $user_team) {
			$teams_list[$user_team['Team']['id']] = $user_team['Team']['name'];
		}
		
		return $teams_list;
	}
	
	function ajax_delete($team_id = null) {
		$this->autoRender = false;
		if($team_id) {
			$result = $this->Team->find('first', array('condition' => array('Team.id' => $team_id)));
			if($result && $this->Team->delete($result['Team']['id'], false)) {
				echo 1;
			} else {
				echo 0;
			}
		} else {
			echo 0;
		}
	}

	function index() {
		$this->Team->recursive = 0;
		$this->set('teams', $this->paginate());
	}

	function view($id = null) {
		$this->layout="ajax";
		if (!$id) {
			$this->Session->setFlash(__('Invalid team', true));
			
		}
		$this->set('team', $this->Team->read(null, $id));
	}
	function profile($id = null) {
		$this->layout="ajax";
		if (!$id) {
			$this->Session->setFlash(__('Invalid team', true));
	
		}
		$this->set('team', $this->Team->read(null, $id));
	}
	
	function viewCreate() {
		$this->layout="ajax";
		$teamStyles = $this->Team->TeamStyle->find('list');
		$users = $this->Team->User->find('list');
		$this->set(compact('teamStyles', 'users'));
	}
	
	function payroll($id){
		$limit = 8;
		if(isset($this->params['named']['limit'])) {
			$limit = $this->params['named']['limit'];
		}
		$this->layout="ajax";
        $users_ids = $this->Team->UsersTeam->find('list', array('conditions' => array('UsersTeam.team_id' => $id, 'UsersTeam.user_team_status_id' => 2), 'fields' => array('UsersTeam.user_id')));
        $this->paginate=array("limit"=>$limit);
		$this->set("payroll", $this->paginate("User", array('User.id' => $users_ids)));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Team->create();
			$this->Team->set('team_style_id', $this->data['Team']['team_style_id']);
			$this->Team->set('name', $this->data['Team']['name']);
			$this->Team->set('image', $this->data['Team']['image']);
			if ($this->Team->save()) {
				$team_id = $this->Team->id;
				$this->Team->UsersTeam->create();
				$this->Team->UsersTeam->set('user_id', $this->Session->read('Auth.User.id'));
				$this->Team->UsersTeam->set('team_id', $team_id);
				$this->Team->UsersTeam->set('is_captain', true);
				$this->Team->UsersTeam->set('user_team_status_id', 2);
				$this->Team->UsersTeam->save();
				foreach($this->data['User']['User'] as $key=>$user_id) {
					$this->Team->UsersTeam->create();
					$this->Team->UsersTeam->set('user_id', $user_id);
					$this->Team->UsersTeam->set('team_id', $team_id);
					$this->Team->UsersTeam->set('is_captain', false);
					$this->Team->UsersTeam->set('user_team_status_id', 1);
					if($this->Team->UsersTeam->save()) {
						$team_name = $this->requestAction('/teams/getTeamName/' . $this->Team->id);
						$subject = "Convocatoria Al Equipo :: $team_name";
						$content = "<div class=\"notificacion-usuario\"><a class=\"overlay\" href=\"/users_teams/viewCalling/$user_id/$team_id\">Ver más</a></div>";
						$this->loadModel("UserNotification");
						$this->UserNotification->create();
						$this->UserNotification->set('user_id', $user_id);
						$this->UserNotification->set('subject', $subject);
						$this->UserNotification->set('content', $content);
						$this->UserNotification->save();
					}
				}
				echo true;
			} else {
				echo false;
			}
		}
		configure::write("debug",0);
		$this->autoRender=false;
		exit(0);
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid team', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Team->save($this->data)) {
				$this->Session->setFlash(__('The team has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Team->read(null, $id);
		}
		$teamStyles = $this->Team->TeamStyle->find('list');
		$users = $this->Team->User->find('list');
		$this->set(compact('teamStyles', 'users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for team', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Team->delete($id)) {
			$this->Session->setFlash(__('Team deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Team was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for team', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Team->read(null,$id);
		$oldData["Team"]["active"]=false;
		if ($this->Team->save($oldData)) {
			$this->Session->setFlash(__('Team archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Team was not archived', true));
		$this->redirect(array('action' => 'index'));
	}

	function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for team', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Team->read(null,$id);
		$oldData["Team"]["active"]=true;
		if ($this->Team->save($oldData)) {
			$this->Session->setFlash(__('Team archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Team was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function requestFind($type,$findParams,$key) {
		if($key==Configure::read("key")){
			return $this->Team->find($type, $findParams);
		}else{
			return null;
		}
	}
	
	function admin_index() {
		$this->Team->recursive = 0;
		$this->set('teams', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid team', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('team', $this->Team->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Team->create();
			if ($this->Team->save($this->data)) {
				$this->Session->setFlash(__('The team has been saved', true));
			//	$this->redirect(array('action' => 'index'));
			} else {
				//$this->Session->setFlash(__('The team could not be saved. Please, try again.', true));
			}
		}
		$teamStyles = $this->Team->TeamStyle->find('list');
		$users = $this->Team->User->find('list');
		$this->set(compact('teamStyles', 'users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid team', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Team->save($this->data)) {
				$this->Session->setFlash(__('The team has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Team->read(null, $id);
		}
		$teamStyles = $this->Team->TeamStyle->find('list');
		$users = $this->Team->User->find('list');
		$this->set(compact('teamStyles', 'users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for team', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Team->delete($id)) {
			$this->Session->setFlash(__('Team deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Team was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for team', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Team->read(null,$id);
		$oldData["Team"]["active"]=false;
		if ($this->Team->save($oldData)) {
			$this->Session->setFlash(__('Team archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Team was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for team', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Team->read(null,$id);
		$oldData["Team"]["active"]=true;
		if ($this->Team->save($oldData)) {
			$this->Session->setFlash(__('Team archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Team was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_requestFind($type,$findParams,$key) {
		if($key==Configure::read("key")){
			return $this->Team->find($type, $findParams);
		}else{
			return null;
		}
	}
}
