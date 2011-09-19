<?php
class ChallengesController extends AppController {

	var $name = 'Challenges';
	
	function getChallengerUsers($challenge_id = null) { // Existe alguna condicion de busqueda?
		if($challenge_id) {
			$this->loadModel('UsersTeam');
			$this->loadModel('User');
			$reto = $this->Challenge->read(null, $challenge_id);
			// Sacar los ids de los equipos involucrados
			$challenger_team_id = $reto['Challenge']['team_challenger_id'];
			// Ahora obtener los jugadores relacionados con dichos equipos
			$users_ids = $this->UsersTeam->find('list', array(
				'fields' => array(
					'UsersTeam.user_id'),
					'conditions' => array(
						'UsersTeam.team_id' => $challenger_team_id
					)
				)
			);
			return $this->User->find('all', array('conditions' => array('User.id' => $users_ids)));
		} else {
			return null;
		}
	}
	
	function getChallengedUsers($challenge_id = null) {
		if($challenge_id) {
			$this->loadModel('UsersTeam');
			$this->loadModel('User');
			$reto = $this->Challenge->read(null, $challenge_id);
			// Sacar los ids de los equipos involucrados
			$challenged_team_id = $reto['Challenge']['team_challenged_id'];
			// Ahora obtener los jugadores relacionados con dichos equipos
			$users_ids = $this->UsersTeam->find('list', array(
				'fields' => array(
					'UsersTeam.user_id'),
					'conditions' => array(
						'UsersTeam.team_id' => $challenged_team_id
					)
				)
			);
			return $this->User->find('all', array('conditions' => array('User.id' => $users_ids)));
		} else {
			return null;
		}
	}
	
	function getAllUsers($challenge_id = null) {
		if($challenge_id) {
			$this->loadModel('UsersTeam');
			$this->loadModel('User');
			$reto = $this->Challenge->read(null, $challenge_id);
			// Sacar los ids de los equipos involucrados
			$challenger_team_id = $reto['Challenge']['team_challenger_id'];
			$challenged_team_id = $reto['Challenge']['team_challenged_id'];
			// Ahora obtener los jugadores relacionados con dichos equipos
			$users_ids = $this->UsersTeam->find('list', array(
				'fields' => array(
					'UsersTeam.user_id'),
					'conditions' => array(
						'OR' => array(
							'UsersTeam.team_id' => $challenger_team_id,
							'UsersTeam.team_id' => $challenged_team_id
						)
					)
				)
			);
			return $this->User->find('all', array('conditions' => array('User.id' => $users_ids)));
		} else {
			return null;
		}
	}
	function challege(){
		$this->layout="ajax";
			
	}
	function challegeFromSearch($challengedId=null){
		$this->layout="ajax";
		$myTeams=$this->requestAction("/teams/myTeams");
		$this->set(compact("challengedId","myTeams"));	
	}	
	function createChallenge($challenger_id = null, $challenged_id = null, $user_id = null,
								$date = null, $place = null, $title = null, $message = null, $bet = null) {
		if($challenger_id && $challenged_id && $user_id && $date && $place && $title) {
			$reto = $this->Challenge->create();
			$reto['Challenge']['challenge_status_id'] = 3;
			$reto['Challenge']['team_challenger_id'] = $challenger_id;
			$reto['Challenge']['team_challenged_id'] = $challenged_id;
			$reto['Challenge']['user_challenger_id'] = $user_id;
			$reto['Challenge']['date'] = $date;
			$reto['Challenge']['place'] = $place;
			$reto['Challenge']['title'] = $title;
			$reto['Challenge']['message'] = $message;
			$reto['Challenge']['bet'] = $bet;
			if($this->Challenge->save($reto)) {
				echo true;
			} else {
				echo false;
			}
		} else {
			echo false;
		}
		Configure::write("debug",0);
		$this->autoRender=false;
		exit(0);
	}
	
	function getInvites($team_id = null) {
		if($team_id) {
			$this->set("invites", $this->paginate("Challenge", array('Challenge.team_challenged_id' => $team_id, 'Challenge.challenge_status_id' => 3)));
		} else {
			$this->set("invites", null);
		}
	}

	function index() {
		$this->Challenge->recursive = 0;
		$this->set('challenges', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid challenge', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('challenge', $this->Challenge->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Challenge->create();
			if ($this->Challenge->save($this->data)) {
				$this->Session->setFlash(__('The challenge has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The challenge could not be saved. Please, try again.', true));
			}
		}
		$challengeStatuses = $this->Challenge->ChallengeStatus->find('list');
		$teamChallengers = $this->Challenge->TeamChallenger->find('list');
		$teamChallengeds = $this->Challenge->TeamChallenged->find('list');
		$userChallengers = $this->Challenge->UserChallenger->find('list');
		$userDecideds = $this->Challenge->UserDecided->find('list');
		$this->set(compact('challengeStatuses', 'teamChallengers', 'teamChallengeds', 'userChallengers', 'userDecideds'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid challenge', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Challenge->save($this->data)) {
				$this->Session->setFlash(__('The challenge has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The challenge could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Challenge->read(null, $id);
		}
		$challengeStatuses = $this->Challenge->ChallengeStatus->find('list');
		$teamChallengers = $this->Challenge->TeamChallenger->find('list');
		$teamChallengeds = $this->Challenge->TeamChallenged->find('list');
		$userChallengers = $this->Challenge->UserChallenger->find('list');
		$userDecideds = $this->Challenge->UserDecided->find('list');
		$this->set(compact('challengeStatuses', 'teamChallengers', 'teamChallengeds', 'userChallengers', 'userDecideds'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for challenge', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Challenge->delete($id)) {
			$this->Session->setFlash(__('Challenge deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Challenge was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for challenge', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Challenge->read(null,$id);
		$oldData["Challenge"]["active"]=false;
		if ($this->Challenge->save($oldData)) {
			$this->Session->setFlash(__('Challenge archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Challenge was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for challenge', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Challenge->read(null,$id);
		$oldData["Challenge"]["active"]=true;
		if ($this->Challenge->save($oldData)) {
			$this->Session->setFlash(__('Challenge archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Challenge was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Challenge->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->Challenge->recursive = 0;
		$this->set('challenges', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid challenge', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('challenge', $this->Challenge->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Challenge->create();
			if ($this->Challenge->save($this->data)) {
				$this->Session->setFlash(__('The challenge has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The challenge could not be saved. Please, try again.', true));
			}
		}
		$challengeStatuses = $this->Challenge->ChallengeStatus->find('list');
		$teamChallengers = $this->Challenge->TeamChallenger->find('list');
		$teamChallengeds = $this->Challenge->TeamChallenged->find('list');
		$userChallengers = $this->Challenge->UserChallenger->find('list');
		$userDecideds = $this->Challenge->UserDecided->find('list');
		$this->set(compact('challengeStatuses', 'teamChallengers', 'teamChallengeds', 'userChallengers', 'userDecideds'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid challenge', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Challenge->save($this->data)) {
				$this->Session->setFlash(__('The challenge has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The challenge could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Challenge->read(null, $id);
		}
		$challengeStatuses = $this->Challenge->ChallengeStatus->find('list');
		$teamChallengers = $this->Challenge->TeamChallenger->find('list');
		$teamChallengeds = $this->Challenge->TeamChallenged->find('list');
		$userChallengers = $this->Challenge->UserChallenger->find('list');
		$userDecideds = $this->Challenge->UserDecided->find('list');
		$this->set(compact('challengeStatuses', 'teamChallengers', 'teamChallengeds', 'userChallengers', 'userDecideds'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for challenge', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Challenge->delete($id)) {
			$this->Session->setFlash(__('Challenge deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Challenge was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for challenge', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Challenge->read(null,$id);
		$oldData["Challenge"]["active"]=false;
		if ($this->Challenge->save($oldData)) {
			$this->Session->setFlash(__('Challenge archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Challenge was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for challenge', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Challenge->read(null,$id);
		$oldData["Challenge"]["active"]=true;
		if ($this->Challenge->save($oldData)) {
			$this->Session->setFlash(__('Challenge archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Challenge was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Challenge->find($type, $findParams);
	}else{
		return null;
	}
}
}
