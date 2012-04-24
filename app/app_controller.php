<?php
class AppController extends Controller {

	var $components = array(
		'Session',
		'Auth' => array(
			'authorize' => 'controller',
			'userScope' => array(
				'User.active' => 1
			),
			'fields' => array(
				'username' => 'email',
				'password' => 'password'
			)
		),
			'Email',
			'Language'
		);
	
	var $cacheAction = true;

	function isAuthorized() {
		if (isset($this -> params["prefix"])) {
			$role_id = $this -> Session -> read('Auth.User.role_id');
			$prefix = $this -> params["prefix"];
			if (
				($prefix == "admin" && $role_id == 1) ||
				($prefix == "manager" && ($role_id == 1 || $role_id == 2)) ||
				($prefix == "owner" && ($role_id == 1 || $role_id == 4))
			) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}

	function beforeFilter() {
		Configure::write('Config.language', "spa");
		if (isset($this -> params["prefix"])) {
			$this -> layout = "ez/ez";
			$prefix = $this -> params["prefix"];
			$this -> Auth -> loginRedirect = array("controller" => "pages", "action" => "ez", $prefix => true);
			$role = $this -> Session -> read('Auth.User.role_id');
			if($role == 1 && $prefix != 'admin') {
				$this -> redirect(array('controller' => 'Pages', 'action' => 'ez', 'admin' => true));
			} elseif($role == 2) {
				$this -> redirect(array('controller' => 'Pages', 'action' => 'ez', 'manager' => true));
			} elseif($role == 4) {
				$this -> redirect(array('controller' => 'Pages', 'action' => 'ez', 'owner' => true));
			} else {
				// TODO : hacer algo?
			}
			$this -> Auth -> deny($this -> action);
		} else {
			$this -> Auth -> allow($this -> action);
		}
	}

	function getList() {
		if($this -> {$this -> modelNames[0]} -> hasField('is_present', false)) {
			return $this -> {$this -> modelNames[0]} -> find("list", array('conditions' => array('is_present' => true)));
		} else {
			return $this -> {$this -> modelNames[0]} -> find("list");
		}
	}

	function configEmail() {
		$this -> Email -> smtpOptions = array('port' => '465', 'timeout' => '30', 'auth' => true, 'host' => 'ssl://smtp.gmail.com', 'username' => 'your_username@gmail.com', 'password' => 'your_gmail_password');
		$this -> Email -> delivery = 'smtp';
		/**
		 $body='prueba';
		 $nombrePara="";
		 $subject="prueba";
		 $correoPara="tatiana0204@gmail.com";
		 $this->Email->delivery = 'smtp';
		 $this->Email->from    = 'Aplicación Web Omega Ingenieros <no-responder@omegaingenieros.com>';
		 $this->Email->to      = $nombrePara.'<'.$correoPara.'>';
		 $this->Email->subject = $subject;
		 $this->Email->send($body);
		 */
		/* Do not pass any args to send() */
		$this -> Email -> send();
		/* Check for SMTP errors. */
		$this -> set('smtp_errors', $this -> Email -> smtpError);
	}

	function getComments($foreign_key) {
		return $this -> $this -> modelNames[0] -> find('all', array('conditions' => array('model' => $this -> modelNames[0], 'foreign_key' => $foreign_key)));
	}

	function addComments() {
		$this -> data['Comment']['model'] = $this -> modelNames[0];
		$this -> loadModel('Comment');
		if (!empty($this -> data)) {
			$this -> Comment -> create();
			if ($this -> Comment -> save($this -> data)) {
				$this -> Session -> setFlash(__('The comment has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The comment could not be saved. Please, try again.', true));
			}
		}
	}

}
