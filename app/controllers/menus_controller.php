<?php
class MenusController extends AppController {

	var $name = 'Menus';

	function index() {
		$this->Menu->recursive = 0;
		$this->set('menus', $this->paginate());
	}
	function show() {
		$path = func_get_args();
		$slug=$path[0];
		$menu=$this->Menu->find("first",array("conditions"=>array("slug"=>$slug)));
		$this->set(compact("menu"));
	}
	function display() {
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$this->layout="ajax";
		}
		
		$path = func_get_args();
		$slug=$path[0];
		$menu=$this->Menu->find("first",array("conditions"=>array("slug"=>$slug)));
		$this->set(compact("menu"));
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid menu', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('menu', $this->Menu->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Menu->create();
			if ($this->Menu->save($this->data)) {
				$this->Session->setFlash(__('The menu has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid menu', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Menu->save($this->data)) {
				$this->Session->setFlash(__('The menu has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Menu->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for menu', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Menu->delete($id)) {
			$this->Session->setFlash(__('Menu deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Menu was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for menu', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Menu->read(null,$id);
		$oldData["Menu"]["active"]=false;
		if ($this->Menu->save($oldData)) {
			$this->Session->setFlash(__('Menu archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Menu was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for menu', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Menu->read(null,$id);
		$oldData["Menu"]["active"]=true;
		if ($this->Menu->save($oldData)) {
			$this->Session->setFlash(__('Menu archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Menu was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
	function getList(){
		return $this->Menu->find("list",array("fields"=>array("background_code","title")));
	}
	function getAll(){
		return $this->Menu->find("all",array("recursive"=>-1));
	}
	function requestFind($type,$findParams,$key) {
		if($key==Configure::read("key")){
			return $this->Menu->find($type, $findParams);
		}else{
			return null;
		}
	}
	function admin_index() {
		$this->Menu->recursive = 0;
		$this->set('menus', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid menu', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('menu', $this->Menu->read(null, $id));
		$pageTypes=$this->Menu->Page->PageType->find("list");
		$this -> set('pageTypes',$pageTypes);
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Menu->create();
			if ($this->Menu->save($this->data)) {
				$this->Session->setFlash(__('The menu has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid menu', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Menu->save($this->data)) {
				$this->Session->setFlash(__('The menu has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Menu->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for menu', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Menu->delete($id)) {
			$this->Session->setFlash(__('Menu deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Menu was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for menu', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Menu->read(null,$id);
		$oldData["Menu"]["active"]=false;
		if ($this->Menu->save($oldData)) {
			$this->Session->setFlash(__('Menu archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Menu was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for menu', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Menu->read(null,$id);
		$oldData["Menu"]["active"]=true;
		if ($this->Menu->save($oldData)) {
			$this->Session->setFlash(__('Menu archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Menu was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Menu->find($type, $findParams);
	}else{
		return null;
	}
}
}
