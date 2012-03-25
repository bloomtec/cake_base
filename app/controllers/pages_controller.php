<?php
class PagesController extends AppController {

	var $name = 'Pages';

	function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			$this -> redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this -> layout = "default";
		$this -> set(compact('page', 'subpage', 'title_for_layout'));
		$this -> render(implode('/', $path));
	}

	function index() {
		$this -> Page -> recursive = 0;
		$this -> set('pages', $this -> paginate());
	}

	function politicas() {
		$this -> layout = "default";
	}

	function terminosYCondiciones() {
		$this -> layout = "default";
	}

	function nuestraEmpresa() {
		$this -> layout = "default";
	}

	function contacto() {
		$this -> layout = "default";
		if(!empty($this -> data)) {			
			// Address the message is going to (string). Separate the addresses with a comma if you want to send the email to more than one recipient.
			$this -> Email -> to = Configure::read('contact_mail');
			// array of addresses to cc the message to
			$this -> Email -> cc = '';
			// array of addresses to bcc (blind carbon copy) the message to
			$this -> Email -> bcc = '';
			// reply to address (string)
			$this -> Email -> replyTo = Configure::read('reply_contact_mail');
			// Return mail address that will be used in case of any errors(string) (for mail-daemon/errors)
			$this -> Email -> return = Configure::read('reply_contact_mail');
			// from address (string)
			$this -> Email -> from = Configure::read('contact_mail');
			// subject for the message (string)
			$this -> Email -> subject = __('Petición de contacto del sitio ', true) . Configure::read('site_name');
			// The email element to use for the message (located in app/views/elements/email/html/ and app/views/elements/email/text/)
			$this -> Email -> template = 'contact_email';
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
			$this -> Email -> smtpOptions = array('port' => '465', 'timeout' => '30', 'host' => 'ssl://smtp.gmail.com', 'username' => Configure::read('contact_mail'), 'password' => Configure::read('password_contact_mail'), 'client' => 'smtp_helo_comopromos.com ');

			// Asignar cosas al template
			$this -> set('name', $this -> data['Pages']['name']);
			$this -> set('email', $this -> data['Pages']['email']);
			$this -> set('message', $this -> data['Pages']['message']);
		
			// Enviar el correo
			Configure::write('debug', 0);
			$this -> Email -> send();
			$this -> set('smtp_errors', $this -> Email -> smtpError);
			$this -> Email -> reset();
		}
	}

	function dudas() {
		$this -> layout = "default";
		if(!empty($this -> data)) {			
			// Address the message is going to (string). Separate the addresses with a comma if you want to send the email to more than one recipient.
			$this -> Email -> to = Configure::read('contact_mail');
			// array of addresses to cc the message to
			$this -> Email -> cc = '';
			// array of addresses to bcc (blind carbon copy) the message to
			$this -> Email -> bcc = '';
			// reply to address (string)
			$this -> Email -> replyTo = Configure::read('reply_contact_mail');
			// Return mail address that will be used in case of any errors(string) (for mail-daemon/errors)
			$this -> Email -> return = Configure::read('reply_contact_mail');
			// from address (string)
			$this -> Email -> from = Configure::read('contact_mail');
			// subject for the message (string)
			$this -> Email -> subject = __('Dudas del sitio ', true) . Configure::read('site_name');
			// The email element to use for the message (located in app/views/elements/email/html/ and app/views/elements/email/text/)
			$this -> Email -> template = 'contact_email';
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
			$this -> Email -> smtpOptions = array('port' => '465', 'timeout' => '30', 'host' => 'ssl://smtp.gmail.com', 'username' => Configure::read('contact_mail'), 'password' => Configure::read('password_contact_mail'), 'client' => 'smtp_helo_comopromos.com ');

			// Asignar cosas al template
			$this -> set('name', $this -> data['Pages']['name']);
			$this -> set('email', $this -> data['Pages']['email']);
			$this -> set('message', $this -> data['Pages']['message']);
		
			// Enviar el correo
			Configure::write('debug', 0);
			$this -> Email -> send();
			$this -> set('smtp_errors', $this -> Email -> smtpError);
			$this -> Email -> reset();
		}
	}

	function comoComprar() {
		$this -> layout = "default";
	}

	function privacidad() {

	}

	function sugierenos() {
		$this -> layout = "default";
		if(!empty($this -> data)) {			
			// Address the message is going to (string). Separate the addresses with a comma if you want to send the email to more than one recipient.
			$this -> Email -> to = Configure::read('contact_mail');
			// array of addresses to cc the message to
			$this -> Email -> cc = '';
			// array of addresses to bcc (blind carbon copy) the message to
			$this -> Email -> bcc = '';
			// reply to address (string)
			$this -> Email -> replyTo = Configure::read('reply_contact_mail');
			// Return mail address that will be used in case of any errors(string) (for mail-daemon/errors)
			$this -> Email -> return = Configure::read('reply_contact_mail');
			// from address (string)
			$this -> Email -> from = Configure::read('contact_mail');
			// subject for the message (string)
			$this -> Email -> subject = __('Sugerencia de restaurante para ', true) . Configure::read('site_name');
			// The email element to use for the message (located in app/views/elements/email/html/ and app/views/elements/email/text/)
			$this -> Email -> template = 'sugierenos_email';
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
			$this -> Email -> smtpOptions = array('port' => '465', 'timeout' => '30', 'host' => 'ssl://smtp.gmail.com', 'username' => Configure::read('contact_mail'), 'password' => Configure::read('password_contact_mail'), 'client' => 'smtp_helo_comopromos.com ');

			// Asignar cosas al template
			$this -> set('restaurant', $this -> data['Pages']['restaurant']);
			$this -> set('restaurant_email', $this -> data['Pages']['restaurant_email']);
			$this -> set('name', $this -> data['Pages']['name']);
			$this -> set('email', $this -> data['Pages']['email']);
			$this -> set('message', $this -> data['Pages']['message']);
		
			// Enviar el correo
			Configure::write('debug', 0);
			$this -> Email -> send();
			$this -> set('smtp_errors', $this -> Email -> smtpError);
			$this -> Email -> reset();
		}
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Página erronea', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('page', $this -> Page -> read(null, $id));
	}

	function add() {
		if (!empty($this -> data)) {
			$this -> Page -> create();
			if ($this -> Page -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se guardó la página', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar la página. Por favor, intenta de nuevo..', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Página no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Page -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se guardó la página', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar la página. Por favor, intenta de nuevo..', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Page -> read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('ID de página no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Page -> delete($id)) {
			$this -> Session -> setFlash(__('Página eliminada', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('No se eliminó la página', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('ID de página no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Page -> read(null, $id);
		$oldData["Page"]["active"] = false;
		if ($this -> Page -> save($oldData)) {
			$this -> Session -> setFlash(__('Página archivada', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('No se archivó la página', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('ID de página no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Page -> read(null, $id);
		$oldData["Page"]["active"] = true;
		if ($this -> Page -> save($oldData)) {
			$this -> Session -> setFlash(__('Página archivada', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('No se archivó la página', true));
		$this -> redirect(array('action' => 'index'));
	}

	function owner_ez() {
	}

	function manager_ez() {
	}

	function manager_index() {
		$this -> Page -> recursive = 0;
		$this -> set('pages', $this -> paginate());
	}

	function admin_ez() {
	}

	function admin_layouts() {
		App::import("Folder");
		$folder = new Folder(LAYOUTS);
		$layoutsCtp = $folder -> read();
		$layouts;
		foreach ($layoutsCtp[1] as $layout) {
			$layout = substr($layout, 0, -4);
			$layouts[$layout] = $layout;
		}
		return $layouts;
	}

	function admin_index() {
		$this -> Page -> recursive = 0;
		$this -> set('pages', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Página no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('page', $this -> Page -> read(null, $id));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> Page -> create();
			if ($this -> Page -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se guardó la página', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar la página. Por favor, intenta de nuevo..', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Página no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Page -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se guardó la página', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar la página. Por favor, intenta de nuevo..', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Page -> read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('ID de página no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Page -> delete($id)) {
			$this -> Session -> setFlash(__('Página eliminada', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('No se eliminó la página', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_wysiwyg() {//ESTA FUNCION MUESTRA EL LISTADO DE LAS IMAGENES SUBIDAS POR EL WYSIWYG
		$this -> layout = "ez/file_browser";
		App::import("Folder");
		$folder = new Folder(WWW_ROOT . DS . "wysiwyg");
		$this -> set("folder", $folder -> read());
		$this -> set("folderPath", DS . "wysiwyg");
	}

	function admin_setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('ID de página no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Page -> read(null, $id);
		$oldData["Page"]["active"] = false;
		if ($this -> Page -> save($oldData)) {
			$this -> Session -> setFlash(__('Página archivada', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('No se archivó la página', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('ID de página no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Page -> read(null, $id);
		$oldData["Page"]["active"] = true;
		if ($this -> Page -> save($oldData)) {
			$this -> Session -> setFlash(__('Página archivada', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('No se archivó la página', true));
		$this -> redirect(array('action' => 'index'));
	}

}
