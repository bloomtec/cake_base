<?php
class TeamNotificationsController extends AppController {

	var $name = 'TeamNotifications';

	/**
	 * Se debe de retornar aquellas notificaciones que pertenezcan a los
	 * equipos a los que pertenece el usuario.
	 */
	function viewNotifications() {
		$this -> layout = "ajax";
		/**
		 * Obtener el id del usuario
		 */
		$user_id = $this -> Session -> read('Auth.User.id');
		/**
		 * Obtener los equipos a los que el usuario pertenece
		 */
		$teams = $this -> requestAction('/teams/myTeams');
		$teams_ids = array();
		foreach($teams as $id=>$name) {
			$teams_ids[] = $id;
		}
		$notifications = $this -> TeamNotification -> find('all', array('recursive' => -1, 'conditions' => array('TeamNotification.team_id' => $teams_ids)));
		$this -> set(compact('notifications'));
	}

	function index() {
		$this -> TeamNotification -> recursive = 0;
		$this -> set('teamNotifications', $this -> paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid team notification', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('teamNotification', $this -> TeamNotification -> read(null, $id));
	}

	function add() {
		if (!empty($this -> data)) {
			$this -> TeamNotification -> create();
			if ($this -> TeamNotification -> save($this -> data)) {
				$this -> Session -> setFlash(__('The team notification has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The team notification could not be saved. Please, try again.', true));
			}
		}
		$teams = $this -> TeamNotification -> Team -> find('list');
		$this -> set(compact('teams'));
	}

	function edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid team notification', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> TeamNotification -> save($this -> data)) {
				$this -> Session -> setFlash(__('The team notification has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The team notification could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> TeamNotification -> read(null, $id);
		}
		$teams = $this -> TeamNotification -> Team -> find('list');
		$this -> set(compact('teams'));
	}

	function delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for team notification', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> TeamNotification -> delete($id)) {
			$this -> Session -> setFlash(__('Team notification deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Team notification was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for team notification', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> TeamNotification -> read(null, $id);
		$oldData["TeamNotification"]["active"] = false;
		if ($this -> TeamNotification -> save($oldData)) {
			$this -> Session -> setFlash(__('Team notification archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Team notification was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for team notification', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> TeamNotification -> read(null, $id);
		$oldData["TeamNotification"]["active"] = true;
		if ($this -> TeamNotification -> save($oldData)) {
			$this -> Session -> setFlash(__('Team notification archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Team notification was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> TeamNotification -> find($type, $findParams);
		} else {
			return null;
		}
	}

	function admin_index() {
		$this -> TeamNotification -> recursive = 0;
		$this -> set('teamNotifications', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid team notification', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('teamNotification', $this -> TeamNotification -> read(null, $id));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> TeamNotification -> create();
			if ($this -> TeamNotification -> save($this -> data)) {
				$this -> Session -> setFlash(__('The team notification has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The team notification could not be saved. Please, try again.', true));
			}
		}
		$teams = $this -> TeamNotification -> Team -> find('list');
		$this -> set(compact('teams'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid team notification', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> TeamNotification -> save($this -> data)) {
				$this -> Session -> setFlash(__('The team notification has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The team notification could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> TeamNotification -> read(null, $id);
		}
		$teams = $this -> TeamNotification -> Team -> find('list');
		$this -> set(compact('teams'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for team notification', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> TeamNotification -> delete($id)) {
			$this -> Session -> setFlash(__('Team notification deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Team notification was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for team notification', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> TeamNotification -> read(null, $id);
		$oldData["TeamNotification"]["active"] = false;
		if ($this -> TeamNotification -> save($oldData)) {
			$this -> Session -> setFlash(__('Team notification archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Team notification was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for team notification', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> TeamNotification -> read(null, $id);
		$oldData["TeamNotification"]["active"] = true;
		if ($this -> TeamNotification -> save($oldData)) {
			$this -> Session -> setFlash(__('Team notification archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Team notification was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> TeamNotification -> find($type, $findParams);
		} else {
			return null;
		}
	}

}