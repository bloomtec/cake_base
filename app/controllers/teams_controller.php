<?php
class TeamsController extends AppController {

	var $name = 'Teams';
	
	function search() {
		if(!empty($this->data) && isset($this->data['Team']['criteria'])) {
			$criteria = $this->data['Team']['criteria'];
			$this->set("results", $this->paginate("Team", array('Team.name LIKE' => "%$criteria%")));
		}
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
			$this->redirect(array('action' => 'index'));
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
		$this->layout="ajax";
		$this->loadModel("User");
        $users_ids = $this->Team->UsersTeam->find('list', array('conditions' => array('UsersTeam.team_id' => $id), 'fields' => array('UsersTeam.user_id')));
        $this->paginate=array("limit"=>2);
		$this->set("payroll", $this->paginate("User", array('User.id' => $users_ids)));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Team->create();
			if ($this->Team->save($this->data)) {
				$this->Session->setFlash(__('The team has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team could not be saved. Please, try again.', true));
			}
		}
		$teamStyles = $this->Team->TeamStyle->find('list');
		$users = $this->Team->User->find('list');
		$this->set(compact('teamStyles', 'users'));
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
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team could not be saved. Please, try again.', true));
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
