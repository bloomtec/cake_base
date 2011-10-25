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
	function home(){
		$this->layout="default";
	}
	function categoria(){
		$this->layout="categoria";
	}
	function armaTuComputador(){
		$this->layout="personaliza";
	}
	function admin_ez() {

	}
	function admin_layouts(){
		App::import("Folder");
		$folder = new Folder(LAYOUTS);
		$layoutsCtp=$folder->read();
		$layouts;
		foreach($layoutsCtp[1] as $layout){
				$layout=substr($layout,0, -4);
				$layouts[$layout]=$layout;
		}
		return $layouts;
	}
	function admin_wysiwyg(){//ESTA FUNCION MUESTRA EL LISTADO DE LAS IMAGENES SUBIDAS POR EL WYSIWYG
	    $this->layout="ez/file_browser";
	    App::import("Folder");
	    $folder= new Folder(WWW_ROOT.DS."wysiwyg");
	    $this->set("folder",$folder->read());
	    $this->set("folderPath",DS."wysiwyg");
 	}
	
	function index() {
		$this -> Page -> recursive = 0;
		$this -> set('pages', $this -> paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid page', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('page', $this -> Page -> read(null, $id));
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
