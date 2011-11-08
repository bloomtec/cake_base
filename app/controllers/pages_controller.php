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
		$this -> layout = "home";
		$this -> set(compact('page', 'subpage', 'title_for_layout'));
		$this -> render(implode('/', $path));
	}

	function enviarDuda($clasification) {
		if (!empty($this -> data)) {
			$email = $this -> data['email'];
			$userName = $this -> data['name'];
			$subscribir = $this -> data['subscribe'] ? 'si':'no';
			$comentario = $this -> data['comentario'];
			$asunto = "Duda enviada desde la página web ";
			$mensaje = "de: " . $userName . " / " . $email . " <br />" ."Producto: $clasification <br /> Subscrito al newsletter?: $subscribir <br />".$comentario;
			$cabeceras = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			// Cabeceras adicionales
			$cabeceras .= 'From: ' . $userName . ' <' . $email . '>' . "\r\n";
			//debug($mensaje);
			if (mail("ricardopandales@gmail.com,colors_tennis1@hotmail.com", $asunto, $mensaje, $cabeceras)) {
				echo true;
			} else {
				echo false;
			}
		} else {
			echo false;
		}
		Configure::write('debug', 0);
		$this -> autoRender = false;
		exit(0);
	}

	function contacto() {
		$this -> layout = 'pages';
		if (!empty($this -> data)) {
			$email = $this -> data['email'];
			$userName = $this -> data['name'];
			$comentario = $this -> data['comentario'];
			$asunto = "Comentario enviado desde la página web";
			$mensaje = "de: " . $userName . " / " . $email . " <br />" . $comentario;
			$cabeceras = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			// Cabeceras adicionales
			$cabeceras .= 'From: ' . $userName . ' <' . $email . '>' . "\r\n";
			//debug($mensaje);
			if (mail("ricardopandales@gmail.com,colors_tennis1@hotmail.com", $asunto, $mensaje, $cabeceras)) {
				echo true;
			} else {
				echo false;
			}
			Configure::write('debug', 0);
			$this -> autoRender = false;
			exit(0);

		} else {

		}

	}

	function seguimientoPedidos() {
		$this -> layout = 'overlay';
		$this -> set('titulo', 'CONOCE EL ESTADO DE TU PEDIDO');
	}

	function notificacionDisponibilidad($productId) {
		$this -> loadModel('Product');
		$this -> layout = 'overlay';
		$this -> set('titulo', 'NOTIFICARME CUANDO ESTÉ DISPONIBLE');
		$this -> set('product', $this -> Product -> read(null, $productId));
	}

	function enviarDisponibilidad() {
		if (!empty($this -> data)) {
			$email = $this -> data['email'];
			//$userName=$this->data['name'];
			$subscribir = $this -> data['subscribe'];
			$asunto = "Solicitud disponibilidad " . $this -> data['brand'] . " / " . $this -> data['clasification'];
			$mensaje = "de: " . $email . " <br />" . $asunto . "<br /> Talla: " . $this -> data['talla'];
			$cabeceras = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			// Cabeceras adicionales
			$cabeceras .= 'From:  <' . $email . '>' . "\r\n";
			//debug($mensaje);
			if (mail("ricardopandales@gmail.com,colors_tennis1@hotmail.com", $asunto, $mensaje, $cabeceras)) {
				echo true;
			} else {
				echo false;
			}
		} else {
			echo false;
		}
		Configure::write('debug', 0);
		$this -> autoRender = false;
		exit(0);
	}

	function dudasCompra() {
		$this -> layout = 'overlay';
		$this -> set('titulo', '¿TIENES ALGUNA DUDA DE TU COMPRA?');
	}

	function admin_ez() {

	}

	function admin_layouts() {
		$layouts = array('home' => 'home', 'pages' => 'pages');
		return $layouts;
	}

	function admin_wysiwyg() {//ESTA FUNCION MUESTRA EL LISTADO DE LAS IMAGENES SUBIDAS POR EL WYSIWYG
		$this -> layout = "file_browser";
		App::import("Folder");
		$folder = new Folder(WWW_ROOT . DS . "wysiwyg");
		$this -> set("folder", $folder -> read());
		$this -> set("folderPath", DS . "wysiwyg");
	}

	function index() {
		$this -> layout = "ez.ctp";
		$this -> Page -> recursive = 0;
		$this -> set('pages', $this -> paginate());
	}

	function view($slug = null) {

		if (!$slug) {
			$this -> Session -> setFlash(__('Invalid page', true));
			$this -> redirect(array('action' => 'index'));
		}
		$page = $this -> Page -> findBySlug($slug);
		$this -> set('page', $page);
		$this -> layout = $page['Page']['layout'];
	}

	function add() {
		if (!empty($this -> data)) {
			$this -> Page -> create();
			if ($this -> Page -> save($this -> data)) {
				$this -> Session -> setFlash(__('The page has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The page could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid page', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Page -> save($this -> data)) {
				$this -> Session -> setFlash(__('The page has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The page could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Page -> read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for page', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Page -> delete($id)) {
			$this -> Session -> setFlash(__('Page deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Page was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for page', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Page -> read(null, $id);
		$oldData["Page"]["active"] = false;
		if ($this -> Page -> save($oldData)) {
			$this -> Session -> setFlash(__('Page archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Page was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for page', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Page -> read(null, $id);
		$oldData["Page"]["active"] = true;
		if ($this -> Page -> save($oldData)) {
			$this -> Session -> setFlash(__('Page archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Page was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_index() {
		$this -> Page -> recursive = 0;
		$this -> set('pages', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid page', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('page', $this -> Page -> read(null, $id));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> Page -> create();
			if ($this -> Page -> save($this -> data)) {
				$this -> Session -> setFlash(__('The page has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The page could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid page', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Page -> save($this -> data)) {
				$this -> Session -> setFlash(__('The page has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The page could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Page -> read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for page', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Page -> delete($id)) {
			$this -> Session -> setFlash(__('Page deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Page was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for page', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Page -> read(null, $id);
		$oldData["Page"]["active"] = false;
		if ($this -> Page -> save($oldData)) {
			$this -> Session -> setFlash(__('Page archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Page was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for page', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Page -> read(null, $id);
		$oldData["Page"]["active"] = true;
		if ($this -> Page -> save($oldData)) {
			$this -> Session -> setFlash(__('Page archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Page was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

}
