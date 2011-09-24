<?php
class PagesController extends AppController {

	var $name = 'Pages';

	function getPageByMenuID($menu_id = null) {
		if($menu_id) {
			$page = $this->Page->find(
				'all',
				array(
					'recursive' => -1,
					'conditions' => array('Page.menu_id' => $menu_id)
				)
			);
			return $page;
		}
	}
	
	function viewMenuPages($menu_id = null) {
		$this -> Page -> recursive = 0;
		$this -> set('pages', $this -> paginate());
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
		$menus = $this -> Page -> Menu -> find('list');
		$pageTypes = $this -> Page -> PageType -> find('list');
		$this -> set(compact('menus', 'pageTypes'));
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
		$menus = $this -> Page -> Menu -> find('list');
		$pageTypes = $this -> Page -> PageType -> find('list');
		$this -> set(compact('menus', 'pageTypes'));
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

	function requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> Page -> find($type, $findParams);
		} else {
			return null;
		}
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
		$menus = $this -> Page -> Menu -> find('list');
		$pageTypes = $this -> Page -> PageType -> find('list');
		$this -> set(compact('menus', 'pageTypes'));
	}

	function admin_addTextPage($menu_id = null, $menu_title = null) {
		if (!empty($this -> data)) {
			$this -> Page -> create();
			if ($this -> Page -> save($this -> data)) {
				$this -> Session -> setFlash(__('The page has been saved', true));
				$this -> redirect(array('controller' => 'menus', 'action' => 'view',$this->data["Page"]["menu_id"]));
			} else {
				$this -> Session -> setFlash(__('The page could not be saved. Please, try again.', true));
			}
		}
		$menus = $this -> Page -> Menu -> find('list');
		$pageTypes = $this -> Page -> PageType -> find('list');
		$this -> set(compact('menu_id', 'menu_title', 'menus', 'pageTypes'));
	}

	function admin_addGalleryPage($menu_id = null, $menu_title = null) {
		if (!empty($this -> data)) {
			$this -> Page -> create();
			if ($this -> Page -> save($this -> data)) {
				$this -> Session -> setFlash(__('The page has been saved', true));
				$this -> redirect(array('controller' => 'menus', 'action' => 'view',$this->data["Page"]["menu_id"]));
			} else {
				$this -> Session -> setFlash(__('The page could not be saved. Please, try again.', true));
			}
		}
		$menus = $this -> Page -> Menu -> find('list');
		$pageTypes = $this -> Page -> PageType -> find('list');
		$this -> set(compact('menu_id', 'menu_title', 'menus', 'pageTypes'));
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
		$menus = $this -> Page -> Menu -> find('list');
		$pageTypes = $this -> Page -> PageType -> find('list');
		$this -> set(compact('menus', 'pageTypes'));
	}
	
	function admin_editTextPage($id = null, $menu_title = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid page', true));
			$this -> redirect(array('controller' => 'menus', 'action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Page -> save($this -> data)) {
				$this -> Session -> setFlash(__('The page has been saved', true));
				$this -> redirect(array('controller' => 'menus', 'action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The page could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Page -> read(null, $id);
		}
		$menus = $this -> Page -> Menu -> find('list');
		$pageTypes = $this -> Page -> PageType -> find('list');
		$this -> set(compact('menu_title', 'menus', 'pageTypes'));
	}
	
	function admin_editGalleryPage($id = null, $menu_title = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid page', true));
			$this -> redirect(array('controller' => 'menus', 'action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Page -> save($this -> data)) {
				$this -> Session -> setFlash(__('The page has been saved', true));
				$this -> redirect(array('controller' => 'menus', 'action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The page could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Page -> read(null, $id);
		}
		$menus = $this -> Page -> Menu -> find('list');
		$pageTypes = $this -> Page -> PageType -> find('list');
		$this -> set(compact('menu_title', 'menus', 'pageTypes'));
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
	
	function admin_deleteTextPage($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for page', true));
			$this -> redirect(array('controller' => 'menus', 'action' => 'index'));
		}
		if ($this -> Page -> delete($id)) {
			$this -> Session -> setFlash(__('Page deleted', true));
			$this -> redirect(array('controller' => 'menus', 'action' => 'index'));
		}
		$this -> Session -> setFlash(__('Page was not deleted', true));
		$this -> redirect(array('controller' => 'menus', 'action' => 'index'));
	}
	
	function admin_deleteGalleryPage($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for page', true));
			$this -> redirect(array('controller' => 'menus', 'action' => 'index'));
		}
		if ($this -> Page -> delete($id)) {
			$this -> Session -> setFlash(__('Page deleted', true));
			$this -> redirect(array('controller' => 'menus', 'action' => 'index'));
		}
		$this -> Session -> setFlash(__('Page was not deleted', true));
		$this -> redirect(array('controller' => 'menus', 'action' => 'index'));
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

	function admin_requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> Page -> find($type, $findParams);
		} else {
			return null;
		}
	}

	/**
	 * Displays a view
	 *
	 * @param mixed What page to display
	 * @access public
	 */
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
		$this -> set(compact('page', 'subpage', 'title_for_layout'));
		$this -> render(implode('/', $path));
	}
	function admin_reOrder(){
  /* 
   * Ordena los producto en una categoría

    * */
    	foreach($this->data["Page"] as $id=>$posicion){
    		$this->Page->id=$id;
   			$this->Page->saveField("sort",$posicion);
    	}
    
    echo "yes";
    Configure::write('debug', 0);   
    $this->autoRender = false;   
    exit(); 
	}

}
