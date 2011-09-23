<?php
class PicturesController extends AppController {

	var $name = 'Pictures';

	function index() {
		$this -> Picture -> recursive = 0;
		$this -> set('pictures', $this -> paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid picture', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('picture', $this -> Picture -> read(null, $id));
	}

	function getBackground() {
		// si esta logeuado devuelve una imagen el album members id=2
		// si no está logueado devuelve una imagen del album publico id=1
		$image="";
		if ($this -> Auth -> user()) {//logueado
			$image = $this -> Picture -> find("first", array("order" =>'RAND()', "conditions" => array("gallery_id" => 2)));
		} else {
			$image = $this -> Picture -> find("first", array("order" => 'RAND()', "conditions" => array("gallery_id" => 1)));
		}
		echo json_encode($image);
		$this->autoRender=false;
		exit(0);

	}

	function add() {
		if (!empty($this -> data)) {
			$this -> Picture -> create();
			if ($this -> Picture -> save($this -> data)) {
				$this -> Session -> setFlash(__('The picture has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The picture could not be saved. Please, try again.', true));
			}
		}
		$galleries = $this -> Picture -> Gallery -> find('list');
		$this -> set(compact('galleries'));
	}

	function edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid picture', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Picture -> save($this -> data)) {
				$this -> Session -> setFlash(__('The picture has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The picture could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Picture -> read(null, $id);
		}
		$galleries = $this -> Picture -> Gallery -> find('list');
		$this -> set(compact('galleries'));
	}

	function delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for picture', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Picture -> delete($id)) {
			$this -> Session -> setFlash(__('Picture deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Picture was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for picture', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Picture -> read(null, $id);
		$oldData["Picture"]["active"] = false;
		if ($this -> Picture -> save($oldData)) {
			$this -> Session -> setFlash(__('Picture archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Picture was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for picture', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Picture -> read(null, $id);
		$oldData["Picture"]["active"] = true;
		if ($this -> Picture -> save($oldData)) {
			$this -> Session -> setFlash(__('Picture archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Picture was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> Picture -> find($type, $findParams);
		} else {
			return null;
		}
	}

	function admin_index() {
		$this -> Picture -> recursive = 0;
		$this -> set('pictures', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid picture', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('picture', $this -> Picture -> read(null, $id));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> Picture -> create();
			if ($this -> Picture -> save($this -> data)) {
				$this -> Session -> setFlash(__('The picture has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The picture could not be saved. Please, try again.', true));
			}
		}
		$galleries = $this -> Picture -> Gallery -> find('list');
		$this -> set(compact('galleries'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid picture', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Picture -> save($this -> data)) {
				$this -> Session -> setFlash(__('The picture has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The picture could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Picture -> read(null, $id);
		}
		$galleries = $this -> Picture -> Gallery -> find('list');
		$this -> set(compact('galleries'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for picture', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Picture -> delete($id)) {
			$this -> Session -> setFlash(__('Picture deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Picture was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for picture', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Picture -> read(null, $id);
		$oldData["Picture"]["active"] = false;
		if ($this -> Picture -> save($oldData)) {
			$this -> Session -> setFlash(__('Picture archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Picture was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for picture', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Picture -> read(null, $id);
		$oldData["Picture"]["active"] = true;
		if ($this -> Picture -> save($oldData)) {
			$this -> Session -> setFlash(__('Picture archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Picture was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> Picture -> find($type, $findParams);
		} else {
			return null;
		}
	}

}
