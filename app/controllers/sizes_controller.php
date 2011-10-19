<?php
class SizesController extends AppController {

	var $name = 'Sizes';
	
	function humanizeSize($size_id) {
		$size = $this->Size->read(null, $size_id);
		$reference = $this->Size->SizeReference->read(null, $size['Size']['size_reference_id']);
		return $reference['SizeReference']['size'];
	}
	
	function getSizeReferenceID($size_id) {
		$size = $this->Size->read(null, $size_id);
		return $size['Size']['size_reference_id'];
	}
	
	function getSizeID($size_reference) {
		$size = $this->Size->find('first', array('conditions'=>array('Size.size_reference_id'=>$size_reference)));
		return $size['Size']['id'];
	}
	
	function getSizeIDs($subcategory_id) {
		return $this->Size->find('list', array('fields'=>array('Size.id'), 'conditions'=>array('Size.subcategory_id'=>$subcategory_id)));
	}

	function index() {
		$this -> Size -> recursive = 0;
		$this -> set('sizes', $this -> paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid size', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('size', $this -> Size -> read(null, $id));
	}

	function add() {
		if (!empty($this -> data)) {
			$this -> Size -> create();
			if ($this -> Size -> save($this -> data)) {
				$this -> Session -> setFlash(__('The size has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The size could not be saved. Please, try again.', true));
			}
		}
		$sizeReferences = $this -> Size -> SizeReference -> find('list');
		$subcategories = $this -> Size -> Subcategory -> find('list');
		$this -> set(compact('sizeReferences', 'subcategories'));
	}

	function edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid size', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Size -> save($this -> data)) {
				$this -> Session -> setFlash(__('The size has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The size could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Size -> read(null, $id);
		}
		$sizeReferences = $this -> Size -> SizeReference -> find('list');
		$subcategories = $this -> Size -> Subcategory -> find('list');
		$this -> set(compact('sizeReferences', 'subcategories'));
	}

	function delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for size', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Size -> delete($id)) {
			$this -> Session -> setFlash(__('Size deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Size was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for size', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Size -> read(null, $id);
		$oldData["Size"]["active"] = false;
		if ($this -> Size -> save($oldData)) {
			$this -> Session -> setFlash(__('Size archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Size was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for size', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Size -> read(null, $id);
		$oldData["Size"]["active"] = true;
		if ($this -> Size -> save($oldData)) {
			$this -> Session -> setFlash(__('Size archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Size was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> Size -> find($type, $findParams);
		} else {
			return null;
		}
	}

	function admin_index() {
		$this -> Size -> recursive = 0;
		$this -> set('sizes', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid size', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('size', $this -> Size -> read(null, $id));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> Size -> create();
			if ($this -> Size -> save($this -> data)) {
				$this -> Session -> setFlash(__('The size has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The size could not be saved. Please, try again.', true));
			}
		}
		$sizeReferences = $this -> Size -> SizeReference -> find('list');
		$subcategories = $this -> Size -> Subcategory -> find('list');
		$this -> set(compact('sizeReferences', 'subcategories'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid size', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Size -> save($this -> data)) {
				$this -> Session -> setFlash(__('The size has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The size could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Size -> read(null, $id);
		}
		$sizeReferences = $this -> Size -> SizeReference -> find('list');
		$subcategories = $this -> Size -> Subcategory -> find('list');
		$this -> set(compact('sizeReferences', 'subcategories'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for size', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Size -> delete($id)) {
			$this -> Session -> setFlash(__('Size deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Size was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for size', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Size -> read(null, $id);
		$oldData["Size"]["active"] = false;
		if ($this -> Size -> save($oldData)) {
			$this -> Session -> setFlash(__('Size archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Size was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for size', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Size -> read(null, $id);
		$oldData["Size"]["active"] = true;
		if ($this -> Size -> save($oldData)) {
			$this -> Session -> setFlash(__('Size archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Size was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> Size -> find($type, $findParams);
		} else {
			return null;
		}
	}

}
