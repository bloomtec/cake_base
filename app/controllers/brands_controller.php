<?php
class BrandsController extends AppController {

	var $name = 'Brands';

	function admin_index() {
		$this -> Brand -> recursive = 0;
		$this -> set('brands', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid brand', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('brand', $this -> Brand -> read(null, $id));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> Brand -> create();
			if ($this -> Brand -> save($this -> data)) {
				$this -> Session -> setFlash(__('The brand has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The brand could not be saved. Please, try again.', true));
			}
		}
		$categories = $this -> Brand -> Category -> find('list');
		$this -> set(compact('categories'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid brand', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Brand -> save($this -> data)) {
				$this -> Session -> setFlash(__('The brand has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The brand could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Brand -> read(null, $id);
		}
		$categories = $this -> Brand -> Category -> find('list');
		$this -> set(compact('categories'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for brand', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Brand -> delete($id)) {
			$this -> Session -> setFlash(__('Brand deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Brand was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for brand', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Brand -> read(null, $id);
		$oldData["Brand"]["active"] = false;
		if ($this -> Brand -> save($oldData)) {
			$this -> Session -> setFlash(__('Brand archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Brand was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for brand', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Brand -> read(null, $id);
		$oldData["Brand"]["active"] = true;
		if ($this -> Brand -> save($oldData)) {
			$this -> Session -> setFlash(__('Brand archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Brand was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> Brand -> find($type, $findParams);
		} else {
			return null;
		}
	}

}
