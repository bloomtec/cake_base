<?php
class PrizesController extends AppController {

	var $name = 'Prizes';

	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}

	function index() {
		$this -> Prize -> recursive = 0;
		$this -> set('prizes', $this -> paginate());
		$this -> set('title_for_layout', __('Premios',true));
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Premio no válido', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('prize', $this -> Prize -> read(null, $id));
		$this -> paginate = array(
			'conditions' => array(
				'Prize.id <>' => $id
			)
		);
		$this -> set('prizes', $this -> paginate());
	}

	function admin_index() {
		$this -> Prize -> recursive = 0;
		$this -> set('prizes', $this -> paginate());
	}

	function redeem($id = null) {
		if($id) {
			$this -> loadModel('User');
			$this -> User -> recursive = -1;
			$user = $this -> User -> read(null, $this -> Auth -> user('id'));
			$prize = $this -> Prize -> read(null, $id);
			if($user['User']['total_score'] >= $prize['Prize']['score']) {
				// Redimir
				if($user['User']['score'] >= $prize['Prize']['score']) {
					$user['User']['score'] -= $prize['Prize']['score'];
				} else {
					$points = $prize['Prize']['score'];
					$points -= $user['User']['score'];
					$user['User']['score'] = 0;
					$user['User']['score_by_invitations'] -= $points;
				}
				if($this -> User -> save($user)) {
					// Se quitaron los puntos al usuario, enviar el correo
					$this -> prizeRedeemedEmail($user, $prize);
					$this -> Session -> setFlash(__('¡Se te ha enviado un correo con información!', true));
					$this -> redirect(array('action' => 'index'));
				}
			} else {
				// No alcanzan los puntos
				$this -> Session -> setFlash(__('¡No tienes suficientes puntos para este premio!', true));
				$this -> redirect(array('action' => 'index'));
			}
		}
	}
	
	public function prizeRedeemedEmail($user = null, $prize = null) {
		/**
		 * Asignar las variables del componente Email
		 */
		if ($user && $prize) {
			
			// Address the message is going to (string). Separate the addresses with a comma if you want to send the email to more than one recipient.
			$this -> Email -> to = $user['User']['email'];
			// array of addresses to cc the message to
			$this -> Email -> cc = '';
			// array of addresses to bcc (blind carbon copy) the message to
			$this -> Email -> bcc = '';
			// reply to address (string)
			$this -> Email -> replyTo = Configure::read('info_mail');
			// Return mail address that will be used in case of any errors(string) (for mail-daemon/errors)
			$this -> Email -> return = Configure::read('reply_info_mail');
			// from address (string)
			$this -> Email -> from = Configure::read('info_mail');
			// subject for the message (string)
			$this -> Email -> subject = Configure::read('site_name') . __(' prize redeemed', true);
			// The email element to use for the message (located in app/views/elements/email/html/ and app/views/elements/email/text/)
			$this -> Email -> template = 'prize_redeemed_email';
			// The layout used for the email (located in app/views/layouts/email/html/ and app/views/layouts/email/text/)
			//$this -> Email -> layout = '';
			// Length at which lines should be wrapped. Defaults to 70. (integer)
			//$this -> Email -> lineLength = '';
			// how do you want message sent string values of text, html or both
			$this -> Email -> sendAs = 'html';
			// array of files to send (absolute and relative paths)
			//$this -> Email -> attachments = '';
			// how to send the message (mail, smtp [would require smtpOptions set below] and debug)
			$this -> Email -> delivery = 'smtp';
			// associative array of options for smtp mailer (port, host, timeout, username, password, client)
			$this -> Email -> smtpOptions = array('port' => '465', 'timeout' => '30', 'host' => 'ssl://smtp.gmail.com', 'username' => Configure::read('info_mail'), 'password' => Configure::read('password_info_mail'), 'client' => 'smtp_helo_clickandeat.co');

			/**
			 * Asignar cosas al template
			 */
			$this -> set('user', $user);
			$this -> set('prize', $prize);

			/**
			 * Enviar el correo
			 */
			Configure::write('debug', 0);
			$this -> Email -> send();
			$this -> set('smtp_errors', $this -> Email -> smtpError);
			$this -> Email -> reset();
		}

	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Premio no válido', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('prize', $this -> Prize -> read(null, $id));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> Prize -> create();
			if ($this -> Prize -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se registró el premio', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo registrar el premio. Por favor, intente de nuevo.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Premio no válido', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Prize -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se registró el premio', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo registrar el premio. Por favor, intente de nuevo.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Prize -> read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('ID de premio no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Prize -> delete($id)) {
			$this -> Session -> setFlash(__('Premio eliminado', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('No se pudo eliminar el premio', true));
		$this -> redirect(array('action' => 'index'));
	}

}
