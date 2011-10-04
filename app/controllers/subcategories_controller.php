<?php
class SubcategoriesController extends AppController {

	var $name = 'Subcategories';

	function getList($brandId = null) {
		return $this -> Subcategory -> find("all", array("conditions" => array("brand_id" => $brandId)));
	}

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

	function getSizes($id) {
		$this->loadModel('SizeReference');
		$size_ids = $this->Subcategory->Size->find('list', array('conditions'=>array('Size.subcategory_id'=>$id)));
		$names = $this->SizeReference->find('list', array('conditions'=>array('SizeReference.id'=>$size_ids), 'recursive'=>-1));
		return $names;
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
		$subcategory = $this -> Subcategory -> read(null, $id);
		$brand["Brand"] = $subcategory["Brand"];
		$this -> Subcategory -> Brand -> Category -> recurseive = -1;
		$category = $this -> Subcategory -> Brand -> Category -> read(null, $subcategory["Brand"]["category_id"]);
		$this -> set('subcategory', $subcategory);
		$this -> set('brand', $brand);
		$this -> set('category', $category);
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
				if (!empty($this -> data['Subcategory']['sizes'])) {
					foreach ($this->data['Subcategory']['sizes'] as $key => $size_reference_id) {
						$this -> Size -> create();
						$this -> Size -> set('size_reference_id', $size_reference_id);
						$this -> Size -> set('subcategory_id', $this -> Subcategory -> id);
						$this -> Size -> save();
					}
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
			/**
			 * Salvar la subcategoria
			 */
			if ($this -> Subcategory -> save($this -> data)) {
				/**
				 * Salvar la información de tallas
				 */
				// Quitar las tallas actuales
				$actual_size_ids = $this -> Subcategory -> Size -> find('list', array('conditions' => array('Size.subcategory_id' => $id)));
				foreach ($actual_size_ids as $key => $val) {
					$this -> Subcategory -> Size -> delete($key);
				}
				// Llenar las tallas seleccionadas de las previas
				if (!empty($this -> data['Subcategory']['current_sizes'])) {
					foreach ($this->data['Subcategory']['current_sizes'] as $key => $val) {
						$this -> Subcategory -> Size -> create();
						$this -> Subcategory -> Size -> set('size_reference_id', $val);
						$this -> Subcategory -> Size -> set('subcategory_id', $id);
						$this -> Subcategory -> Size -> save();
					}
				}
				// Llevar las tallas seleccionadas de las nuevas
				if (!empty($this -> data['Subcategory']['sizes'])) {
					foreach ($this->data['Subcategory']['sizes'] as $key => $size_reference_id) {
						$this -> Subcategory -> Size -> create();
						$this -> Subcategory -> Size -> set('size_reference_id', $size_reference_id);
						$this -> Subcategory -> Size -> set('subcategory_id', $id);
						$this -> Subcategory -> Size -> save();
					}
				}
				$this -> Session -> setFlash(__('Se editó la subcategoría', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Subcategory -> read(null, $id);
		}
		$brands = $this -> Subcategory -> Brand -> find('list');
		$temp = $this -> Subcategory -> find('first', array('conditions' => array('Subcategory.id' => $id)));
		$size_reference_ids = array();
		//ID's que se tienen actualmente
		foreach ($temp['Size'] as $key => $size) {
			$size_reference_ids[] = $size['size_reference_id'];
		}
		$sizes = $this -> requestAction('/size_references/listSizes');
		// Todas las tallas disponibles
		/**
		 * Quitar de las tallas disponibles las tallas que ya estan
		 * y obtener las tallas actuales
		 */
		$current_sizes = array();
		foreach ($size_reference_ids as $outer_key => $size_reference_id) {
			$size_data = $this -> requestAction('/size_references/listSize/' . $size_reference_id);
			foreach ($size_data as $key => $val) {
				$current_sizes[$key] = $val;
			}
			foreach ($sizes as $inner_key => $size_id) {
				if ($inner_key == $size_reference_id) {
					unset($sizes[$size_reference_id]);
				}
			}
		}
		$this -> set('current_sizes', $current_sizes);
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
