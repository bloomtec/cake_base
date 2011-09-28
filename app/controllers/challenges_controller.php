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
	function challengeFromSearch($challengedId=null){
		$this->layout="ajax";
		$myTeams=$this->requestAction("/teams/myTeamsWhereCaptain");
		$this->set(compact("challengedId","myTeams"));	
	}
	
	function createChallenge() {
		if (!empty($this->data)) {
			$this->Challenge->create();
			$user_id = $this->Session->read('Auth.User.id');
			$this->data['Challenge']['challenge_status_id']=3;
			$this->data['Challenge']['user_challenger_id']=$user_id;
			$message=null;
			if($this->data['Challenge']['message']){
				$message=rawurlencode($this->data['Challenge']['message']);
			}
			if ($this->Challenge->save($this->data)) {
				// Crear notificación de reto de equipo
				// Mensaje para la solicitud
				$team_challenger_id=$this->data['Challenge']['team_challenger_id'];
				$team_challenged_id=$this->data['Challenge']['team_challenged_id'];
				$team_challenger_name = $this->requestAction('/teams/getTeamName/'.$team_challenger_id);
				$team_challenged_name = $this->requestAction('/teams/getTeamName/'.$team_challenged_id);
				$subject = "El equipo :: $team_challenger_name :: ha retado a :: $team_challenged_name ::";
				$content = "<div class=\"notificacion-equipo\"><a class=\"overlay\" href=\"/challenges/viewChallengeRequest/$team_challenger_id/$team_challenged_id/$message\">Ver más</a></div>";
				$this->loadModel("TeamNotification");
				$this->TeamNotification->create();
				$this->TeamNotification->set('team_id', $team_challenged_id);
				$this->TeamNotification->set('other_team_id', $team_challenger_id);
				$this->TeamNotification->set('subject', $subject);
				$this->TeamNotification->set('content', $content);
				$this->TeamNotification->save();
				// Fin crear notificacion
				echo "El Reto fue creado";
			} else {
				echo "No se pudo crear el reto";
			}
		}
		Configure::write("debug",0);
		$this->autoRender=false;
		exit(0);
	}
	
	/**
	 * $team_challenger_id :: id del usuario que solicita la amistad
	 * $team_challenged_id :: id del usuario al que le solicitan la amistad
	 * $message :: mensaje del usuario
	 */
	function viewChallengeRequest($team_challenger_id = null, $team_challenged_id = null, $message = null) {
		$this -> layout = "ajax";
		$this->loadModel('Team');
		$team = $this -> Team -> read(null, $team_challenger_id);
		$this->loadModel('TeamNotification');
		$this -> set(compact("team"));
		$this -> set('team_challenger_id', $team_challenger_id);
		$this -> set('team_challenged_id', $team_challenged_id);
		$this -> set('message', rawurldecode($message));
	}
	
	function acceptChallenge($team_challenger_id, $team_challenged_id) {
		$this -> autoRender = false;
		$data = $this -> Challenge -> find('first', array('recursive' => -1, 'conditions' => array('Challenge.team_challenger_id' => $team_challenger_id, 'Challenge.team_challenged_id' => $team_challenged_id)));
		$data['Challenge']['challenge_status_id'] = 1;
		if ($this -> Challenge -> save($data)) {
			$this->loadModel('TeamNotification');
			$notification = $this->TeamNotification->find('first', array('recursive'=>-1, array('TeamNotification.team_id'=>$team_challenged_id, 'TeamNotification.other_team_id'=>$team_challenger_id)));
			$this->TeamNotification->delete($notification['TeamNotification']['id']);
			echo "Has aceptado el reto";
		} else {
			echo "No se pudo aceptar el reto";
		}
		exit(0);
	}

	function rejectChallenge($team_challenger_id, $team_challenged_id) {
		$this -> autoRender = false;
		$data = $this -> Challenge -> find('first', array('recursive' => -1, 'conditions' => array('Challenge.team_challenger_id' => $team_challenger_id, 'Challenge.team_challenged_id' => $team_challenged_id)));
		$data['Challenge']['challenge_status_id'] = 2;
		if ($this -> Challenge -> save($data)) {
			$this->loadModel('TeamNotification');
			$notification = $this->TeamNotification->find('first', array('recursive'=>-1, array('TeamNotification.team_id'=>$team_challenged_id, 'TeamNotification.other_team_id'=>$team_challenger_id)));
			$this->TeamNotification->delete($notification['TeamNotification']['id']);
			echo "Has rechazado el reto";
		} else {
			echo "No se pudo rechazar el reto";
		}
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
