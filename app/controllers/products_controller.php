<?php
class ProductsController extends AppController {

	var $name = 'Products';

	function index() {
		$this -> layout = 'ajax';
		$this -> Product -> recursive = 0;
		$this -> set('products', $this -> paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid product', true));
			$this -> redirect(array('action' => 'index'));
		}
		$product = $this -> Product -> read(null, $id);
		$brand = $this -> Product -> Subcategory -> Brand -> read(null, $product['Subcategory']['brand_id']);
		$category['Category'] = $brand['Category'];
		$this -> set(compact('product', 'brand', 'category'));
	}

	function setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for product', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Product -> read(null, $id);
		$oldData["Product"]["active"] = false;
		if ($this -> Product -> save($oldData)) {
			$this -> Session -> setFlash(__('Product archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Product was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for product', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Product -> read(null, $id);
		$oldData["Product"]["active"] = true;
		if ($this -> Product -> save($oldData)) {
			$this -> Session -> setFlash(__('Product archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Product was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> Product -> find($type, $findParams);
		} else {
			return null;
		}
	}

	function admin_index() {
		$this -> Product -> recursive = 0;
		$this -> set('products', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid product', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('product', $this -> Product -> read(null, $id));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$valid_recommendations = true;
			$valid_other_recommendations = true;
			/**
			 * Contenedor de recomencdaciones
			 */
			$recommendations = split(",", $this->data['Product']['recommendations']);
			/*
			 * Hacer trim a los valores y validar
			 */
			foreach($recommendations as $key=>$recommendation){
				$recommendations[$key]=trim($recommendation);
				$prod_classification=$recommendations[$key];
				if(empty($recommendations[$key])) {
					unset($recommendations[$key]);
				} else {
					$product = $this->Product->findByClasification($prod_classification);
					if(empty($product)) {
						$valid_recommendations = false;
					}
				}
			}
			/**
			 * Contenedor de otras recomendaciones
			 */
			$other_recommendations = split(",", $this->data['Product']['other_recommendations']);
			/*
			 * Hacer trim a los valores
			 */
			foreach($other_recommendations as $key=>$other_recommendation){
				$other_recommendations[$key]=trim($other_recommendation);
				$prod_classification=$other_recommendations[$key];
				if(empty($other_recommendations[$key])) {
					unset($other_recommendations[$key]);
				} else {
					$product = $this->Product->findByClasification($prod_classification);
					if(empty($product)) {
						$valid_other_recommendations = false;
					}
				}
			}
			
			if(!$valid_recommendations) {
				$this -> Session -> setFlash(__('Error en recomendaciones', true));
			}
			if(!$valid_other_recommendations) {
				$this -> Session -> setFlash(__('Error en otras recomendaciones', true));
			}
			/**
			 * Si estan validos ambos campos entonces guardar
			 * Limpiar y guardar las recomendaciones correspondientes
			 */
			if($valid_recommendations && $valid_other_recommendations) {
				$this -> Product -> create();
				if ($this -> Product -> save($this -> data)) {
					/*
					 * Crear las recomendaciones
					 */
					foreach($recommendations as $clasification) {
						$recommended_product = $this->Product->findByClasification($clasification);
						$this->Product->Recommendation->create();
						$this->Product->Recommendation->set('product_id', $this->Product->id);
						$this->Product->Recommendation->set('recommended_product_id', $recommended_product['Product']['id']);
						$this->Product->Recommendation->save();
					}
					/*
					 * Crear las otras recomendaciones
					 */
					foreach($recommendations as $clasification) {
						$recommended_product = $this->Product->findByClasification($clasification);
						$this->Product->OtherRecommendation->create();
						$this->Product->OtherRecommendation->set('product_id', $this->Product->id);
						$this->Product->OtherRecommendation->set('recommended_product_id', $recommended_product['Product']['id']);
						$this->Product->OtherRecommendation->save();
					}
					$this -> Session -> setFlash(__('The product has been saved', true));
					$this -> redirect(array('action' => 'index'));
				} else {
					$this -> Session -> setFlash(__('The product could not be saved. Please, try again.', true));
				}
			}
		}
		$this -> loadModel('Brand');
		$brands = $this -> Brand -> find('list');
		$this -> set(compact('brands'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid product', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			$valid_recommendations = true;
			$valid_other_recommendations = true;
			/**
			 * Contenedor de recomencdaciones
			 */
			$recommendations = split(",", $this->data['Product']['recommendations']);
			/*
			 * Hacer trim a los valores y validar
			 */
			foreach($recommendations as $key=>$recommendation){
				$recommendations[$key]=trim($recommendation);
				$prod_classification=$recommendations[$key];
				if(empty($recommendations[$key])) {
					unset($recommendations[$key]);
				} else {
					$product = $this->Product->findByClasification($prod_classification);
					if(empty($product)) {
						$valid_recommendations = false;
					}
				}
			}
			/**
			 * Contenedor de otras recomendaciones
			 */
			$other_recommendations = split(",", $this->data['Product']['other_recommendations']);
			/*
			 * Hacer trim a los valores
			 */
			foreach($other_recommendations as $key=>$other_recommendation){
				$other_recommendations[$key]=trim($other_recommendation);
				$prod_classification=$other_recommendations[$key];
				if(empty($other_recommendations[$key])) {
					unset($other_recommendations[$key]);
				} else {
					$product = $this->Product->findByClasification($prod_classification);
					if(empty($product)) {
						$valid_other_recommendations = false;
					}
				}
			}
			
			if(!$valid_recommendations) {
				$this -> Session -> setFlash(__('Error en recomendaciones', true));
			}
			if(!$valid_other_recommendations) {
				$this -> Session -> setFlash(__('Error en otras recomendaciones', true));
			}
			/**
			 * Si estan validos ambos campos entonces guardar
			 * Limpiar y guardar las recomendaciones correspondientes
			 */
			if($valid_recommendations && $valid_other_recommendations) {
				$this -> Product -> create();
				if ($this -> Product -> save($this -> data)) {
					/**
					 * Eliminar las recomendaciones del producto previas
					 */
					$product_recommendations = $this->Product->Recommendation->find('all');
					foreach($product_recommendations as $product_recommendation) {
						if($product_recommendation['Recommendation']['product_id']==$this->data['Product']['id']) {
							$this->Product->Recommendation->delete($product_recommendation['Recommendation']['id']);
						}
					}
					/*
					 * Crear las recomendaciones
					 */
					foreach($recommendations as $clasification) {
						$recommended_product = $this->Product->findByClasification($clasification);
						$this->Product->Recommendation->create();
						$this->Product->Recommendation->set('product_id', $this->data['Product']['id']);
						$this->Product->Recommendation->set('recommended_product_id', $recommended_product['Product']['id']);
						$this->Product->Recommendation->save();
					}
					/**
					 * Eliminar las recomendaciones del producto previas
					 */
					$product_recommendations = $this->Product->OtherRecommendation->find('all');
					foreach($product_recommendations as $product_recommendation) {
						if($product_recommendation['OtherRecommendation']['product_id']==$this->data['Product']['id']) {
							$this->Product->OtherRecommendation->delete($product_recommendation['OtherRecommendation']['id']);
						}
					}
					/*
					 * Crear las otras recomendaciones
					 */
					foreach($recommendations as $clasification) {
						$recommended_product = $this->Product->findByClasification($clasification);
						$this->Product->OtherRecommendation->create();
						$this->Product->OtherRecommendation->set('product_id', $this->data['Product']['id']);
						$this->Product->OtherRecommendation->set('recommended_product_id', $recommended_product['Product']['id']);
						$this->Product->OtherRecommendation->save();
					}
					$this -> Session -> setFlash(__('The product has been saved', true));
					$this -> redirect(array('action' => 'index'));
				} else {
					$this -> Session -> setFlash(__('The product could not be saved. Please, try again.', true));
				}
			}
		}
		$this -> loadModel('Brand');
		$brands = $this -> Brand -> find('list');
		$this -> set(compact('brands'));
		$this -> data = $this -> Product -> read(null, $id);
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for product', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Product -> delete($id)) {
			$this -> Session -> setFlash(__('Product deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Product was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for product', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Product -> read(null, $id);
		$oldData["Product"]["active"] = false;
		if ($this -> Product -> save($oldData)) {
			$this -> Session -> setFlash(__('Product archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Product was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for product', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Product -> read(null, $id);
		$oldData["Product"]["active"] = true;
		if ($this -> Product -> save($oldData)) {
			$this -> Session -> setFlash(__('Product archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Product was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> Product -> find($type, $findParams);
		} else {
			return null;
		}
	}

}
