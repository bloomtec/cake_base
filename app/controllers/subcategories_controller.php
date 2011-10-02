<?php
class SubcategoriesController extends AppController {

	var $name = 'Subcategories';

	function listBrandCategories($brand_id = null) {
		$this -> autoRender = false;
		if ($brand_id) {
			$categories = $this -> Subcategory -> find('list', array('conditions' => array('Subcategory.brand_id' => $brand_id)));
			echo json_encode($categories);
		} else {
			echo 0;
		}
		exit(0);
	}

	function getBrandCategory($brand_id = null) {
		$this -> autoRender = false;
		if ($brand_id) {
			$search = $this -> Subcategory -> Brand -> find('first', array('conditions' => array('Brand.id' => $brand_id, )));
			$search = $this -> Subcategory -> Brand -> Category -> find('first', array('conditions' => array('Category.id' => $search['Brand']['category_id'])));
			echo json_encode($search);
		} else {
			echo 0;
		}

		exit(0);
	}

	function index() {
		$this -> Subcategory -> recursive = 0;
		$this -> set('subcategories', $this -> paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid subcategory', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('subcategory', $this -> Subcategory -> read(null, $id));
	}

	function add() {
		if (!empty($this -> data)) {
			$this -> Subcategory -> create();
			if ($this -> Subcategory -> save($this -> data)) {
				$this -> Session -> setFlash(__('The subcategory has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The subcategory could not be saved. Please, try again.', true));
			}
		}
		$brands = $this -> Subcategory -> Brand -> find('list');
		$this -> set(compact('brands'));
	}

	function edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid subcategory', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Subcategory -> save($this -> data)) {
				$this -> Session -> setFlash(__('The subcategory has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The subcategory could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Subcategory -> read(null, $id);
		}
		$brands = $this -> Subcategory -> Brand -> find('list');
		$this -> set(compact('brands'));
	}

	function delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for subcategory', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Subcategory -> delete($id)) {
			$this -> Session -> setFlash(__('Subcategory deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Subcategory was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for subcategory', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Subcategory -> read(null, $id);
		$oldData["Subcategory"]["active"] = false;
		if ($this -> Subcategory -> save($oldData)) {
			$this -> Session -> setFlash(__('Subcategory archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Subcategory was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for subcategory', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Subcategory -> read(null, $id);
		$oldData["Subcategory"]["active"] = true;
		if ($this -> Subcategory -> save($oldData)) {
			$this -> Session -> setFlash(__('Subcategory archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Subcategory was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> Subcategory -> find($type, $findParams);
		} else {
			return null;
		}
	}

	function admin_index() {
		$this -> Subcategory -> recursive = 0;
		$this -> set('subcategories', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid subcategory', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('subcategory', $this -> Subcategory -> read(null, $id));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> Subcategory -> create();
			if ($this -> Subcategory -> save($this -> data)) {
				$this -> loadModel('Size');
				foreach ($this->data['Subcategory']['sizes'] as $key => $size_reference_id) {
					$this -> Size -> create();
					$this -> Size -> set('size_reference_id', $size_reference_id);
					$this -> Size -> set('subcategory_id', $this -> Subcategory -> id);
					$this -> Size -> save();
				}
				$this -> Session -> setFlash(__('The subcategory has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The subcategory could not be saved. Please, try again.', true));
			}
		}

		$brands = $this -> Subcategory -> Brand -> find('list');
		$this -> set('sizes', $this -> requestAction('/size_references/listSizes'));
		$this -> set(compact('brands'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid subcategory', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Subcategory -> save($this -> data)) {
				$this -> Session -> setFlash(__('The subcategory has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The subcategory could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Subcategory -> read(null, $id);
		}
		$brands = $this -> Subcategory -> Brand -> find('list');
		$temp = $this -> Subcategory -> find('first', array('conditions' => array('Subcategory.id' => $id)));
		$size_reference_ids = array();
		foreach ($temp['Subcategory']['Size'] as $key => $size) {
			$size_reference_ids[]=$size['size_reference_id'];
		}
		$sizes = $this -> requestAction('/size_references/listSizes');
		foreach ($size_reference_ids as $outer_key => $size_reference_id) {
			foreach ($sizes as $inner_key => $size_id) {
				if($size_id == $size_reference_id) {
					unset($sizes[$inner_key]);
				}
			}
		}
		$this->set('size_reference_ids', $size_reference_ids);
		$this -> set('sizes', $sizes);
		$this -> set(compact('brands'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for subcategory', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Subcategory -> delete($id)) {
			$this -> Session -> setFlash(__('Subcategory deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Subcategory was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for subcategory', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Subcategory -> read(null, $id);
		$oldData["Subcategory"]["active"] = false;
		if ($this -> Subcategory -> save($oldData)) {
			$this -> Session -> setFlash(__('Subcategory archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Subcategory was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for subcategory', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Subcategory -> read(null, $id);
		$oldData["Subcategory"]["active"] = true;
		if ($this -> Subcategory -> save($oldData)) {
			$this -> Session -> setFlash(__('Subcategory archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Subcategory was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> Subcategory -> find($type, $findParams);
		} else {
			return null;
		}
	}

}
