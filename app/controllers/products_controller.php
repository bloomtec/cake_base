<?php
class ProductsController extends AppController {

	var $name = 'Products';
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('getProduct', 'getComments');
	}
	
	function search($criteria = null){
		$this->layout='overlay2';
		$this->set('titulo','RESULTADO DE BÚSQUEDA');
		$this->set('brands', $this->Product->Brand->find('all',array('recursive'=>-1)));
		/**
		 * Palabra clave que busca en:
		 * Subcategorias, marcas, colecciones -> nombre
		 */
		if($criteria) {
			$subcategories_ids = $this->Product->Subcategory->find(
				'list',
				array(
					'fields' => array('Subcategory.id'),
					'conditions' => array('Subcategory.name LIKE' => "%$criteria%")
				)
			);
			$brands_ids = $this->Product->Brand->find(
				'list',
				array(
					'fields' => array('Brand.id'),
					'conditions' => array('Brand.name LIKE' => "%$criteria%")
				)
			);
			$collections_ids = $this->Product->Collection->find(
				'list',
				array(
					'fields' => array('Collection.id'),
					'conditions' => array('Collection.name LIKE' => "%$criteria%")
				)
			);
			$products = $this->Product->find(
				'all',
				array(
					'recursive' => 1,
					'conditions' => array(
						'OR' => array(
							'Product.subcategory_id' => $subcategories_ids,
							'Product.brand_id' => $brands_ids,
							'Product.collection_id' => $collections_ids,
							'Product.name LIKE' => "%$criteria%",
							'Product.description LIKE' => "%$criteria%",
							'Product.clasification LIKE' => "%$criteria%"
						)
					)
				)
			);
			$this->set('products', $products);
		}else{
			$this->set('products', $this->Product->find('all'));
		}
	}
	
	function getComments($product_id = null) {
		return $this -> Product -> Comment -> find('all', array('recursive' => 1, 'conditions' => array('Comment.product_id' => $product_id, 'Comment.is_visible' => TRUE)));
	}

	function getProduct($product_id = null, $size_id = null) {
		$this->Product->recursive=-1;
		$product = $this->Product->read(null, $product_id);
		$this->Product->Inventory->recursive=-1;
		$inventory = $this->Product->Inventory->find('first', array('conditions'=>array('Inventory.product_id'=>$product_id, 'Inventory.size_id'=>$size_id)));
		$data = array();
		$data['Product']=$product['Product'];
		$data['Inventory']=$inventory['Inventory'];
		return $data;
	}

	function findRecommendedProducts($product_id) {
		$recommended_product_ids = $this -> Product -> Recommendation -> find('list', array('fields' => array('Recommendation.recommended_product_id'), 'conditions' => array('Recommendation.product_id' => $product_id), 'limit' => 5, 'order' => 'rand()'));
		return $this -> Product -> find('all', array('conditions' => array('Product.id' => $recommended_product_ids)));
	}

	function findOtherRecommendedProducts($product_id) {
		$recommended_product_ids = $this -> Product -> OtherRecommendation -> find('list', array('fields' => array('OtherRecommendation.recommended_product_id'), 'conditions' => array('OtherRecommendation.product_id' => $product_id), 'limit' => 5, 'order' => 'rand()'));
		return $this -> Product -> find('all', array('conditions' => array('Product.id' => $recommended_product_ids)));
	}

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
		$comments = $this->getComments($product['Product']['id']);
		$this -> set(compact('product', 'brand', 'category', 'comments'));
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
			if($this->Product->findByClasification($this->data['Product']['clasification'])) {
				$this -> Session -> setFlash(__('Ya existe un producto con esa clasificación', true));
			} else {
				$valid_recommendations = true;
				$valid_other_recommendations = true;
				/**
				 * Contenedor de recomencdaciones
				 */
				$recommendations = split(",", $this -> data['Product']['recommendations']);
				/*
				 * Hacer trim a los valores y validar
				 */
				foreach ($recommendations as $key => $recommendation) {
					$recommendations[$key] = trim($recommendation);
					$prod_classification = $recommendations[$key];
					if (empty($recommendations[$key])) {
						unset($recommendations[$key]);
					} else {
						$product = $this -> Product -> findByClasification($prod_classification);
						if (empty($product)) {
							$valid_recommendations = false;
						}
					}
				}
				$this -> data['Product']['recommendations'] = "";
				foreach ($recommendations as $key => $val) {
					$this -> data['Product']['recommendations'] = $this -> data['Product']['recommendations'] . $val . ",";
				}
				$this -> data['Product']['recommendations'] = substr($this -> data['Product']['recommendations'], 0, strlen($this -> data['Product']['recommendations']) - 1);
				/**
				 * Revisar datos dobles
				 */
				foreach ($recommendations as $key1 => $recommendation1) {
					foreach ($recommendations as $key2 => $recommendation2) {
						if ($key1 != $key2) {
							if ($recommendation1 == $recommendation2) {
								$valid_recommendations = false;
							}
						}
					}
				}
				/**
				 * Revisar si es el mismo producto el que se recomienda
				 */
				foreach ($recommendations as $key => $recommendation) {
					if ($recommendation == $this -> data['Product']['clasification']) {
						$valid_recommendations = false;
					}
				}
				/**
				 * Contenedor de otras recomendaciones
				 */
				$other_recommendations = split(",", $this -> data['Product']['other_recommendations']);
				/*
				 * Hacer trim a los valores
				 */
				foreach ($other_recommendations as $key => $other_recommendation) {
					$other_recommendations[$key] = trim($other_recommendation);
					$prod_classification = $other_recommendations[$key];
					if (empty($other_recommendations[$key])) {
						unset($other_recommendations[$key]);
					} else {
						$product = $this -> Product -> findByClasification($prod_classification);
						if (empty($product)) {
							$valid_other_recommendations = false;
						}
					}
				}
				$this -> data['Product']['other_recommendations'] = "";
				foreach ($other_recommendations as $key => $val) {
					$this -> data['Product']['other_recommendations'] = $this -> data['Product']['other_recommendations'] . $val . ",";
				}
				$this -> data['Product']['other_recommendations'] = substr($this -> data['Product']['other_recommendations'], 0, strlen($this -> data['Product']['other_recommendations']) - 1);
				/**
				 * Revisar datos dobles
				 */
				foreach ($other_recommendations as $key1 => $other_recommendation1) {
					foreach ($recommendations as $key2 => $other_recommendation2) {
						if ($key1 != $key2) {
							if ($other_recommendation1 == $other_recommendation2) {
								$valid_other_recommendations = false;
							}
						}
					}
				}
				/**
				 * Revisar si es el mismo producto el que se recomienda
				 */
				foreach ($other_recommendations as $key => $other_recommendation) {
					if ($other_recommendation == $this -> data['Product']['clasification']) {
						$valid_other_recommendations = false;
					}
				}
				/**
				 * Revisar que no se meta el mismo producto en ambos tipos de recomendacion
				 */
				foreach ($recommendations as $key1 => $value1) {
					foreach ($other_recommendations as $key2 => $value2) {
						if ($value1 == $value2) {
							$valid_other_recommendations = false;
							$valid_recommendations = false;
						}
					}
				}
				if (!$valid_recommendations && !$valid_other_recommendations) {
					$this -> Session -> setFlash(__('Error en recomendaciones, revise que no exista un producto en ambos campos de recomendación.', true));
				} else {
					if (!$valid_recommendations) {
						$this -> Session -> setFlash(__('Error en recomendaciones, revise que no haya valor duplicado y que no sea el mismo producto', true));
					}
					if (!$valid_other_recommendations) {
						$this -> Session -> setFlash(__('Error en otras recomendaciones, revise que no haya valor duplicado y que no sea el mismo producto', true));
					}
				}
				/**
				 * Si estan validos ambos campos entonces guardar
				 * Limpiar y guardar las recomendaciones correspondientes
				 */
				if ($valid_recommendations && $valid_other_recommendations) {
					$this -> Product -> create();
					if ($this -> Product -> save($this -> data)) {
						/*
						 * Crear las recomendaciones
						 */
						foreach ($recommendations as $clasification) {
							$recommended_product = $this -> Product -> findByClasification($clasification);
							$this -> Product -> Recommendation -> create();
							$this -> Product -> Recommendation -> set('product_id', $this -> Product -> id);
							$this -> Product -> Recommendation -> set('recommended_product_id', $recommended_product['Product']['id']);
							$this -> Product -> Recommendation -> save();
						}
						/*
						 * Crear las otras recomendaciones
						 */
						foreach ($other_recommendations as $clasification) {
							$recommended_product = $this -> Product -> findByClasification($clasification);
							$this -> Product -> OtherRecommendation -> create();
							$this -> Product -> OtherRecommendation -> set('product_id', $this -> Product -> id);
							$this -> Product -> OtherRecommendation -> set('recommended_product_id', $recommended_product['Product']['id']);
							$this -> Product -> OtherRecommendation -> save();
						}
						/**
						 * Iniciar los inventarios en 0
						 */
						// obtener los size_id de sizes que correspondan a la subcategoría
						$product = $this->Product->read(null, $this->Product->id);
						$size_ids = $this->requestAction('/sizes/getSizeIDs/'.$product['Product']['subcategory_id']);
						foreach($size_ids as $key=>$val) {
							$this->Product->Inventory->create();
							$this->Product->Inventory->set('product_id', $this->Product->id);
							$this->Product->Inventory->set('size_id', $val);
							$this->Product->Inventory->save();
						}
						$this -> Session -> setFlash(__('The product has been saved', true));
						$this -> redirect(array('controller'=>'inventories','action' => 'listProductInventory',$this->Product->id));
					} else {
						$this -> Session -> setFlash(__('The product could not be saved. Please, try again.', true));
					}
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
			$recommendations = split(",", $this -> data['Product']['recommendations']);
			/*
			 * Hacer trim a los valores y validar
			 */
			foreach ($recommendations as $key => $recommendation) {
				$recommendations[$key] = trim($recommendation);
				$prod_classification = $recommendations[$key];
				if (empty($recommendations[$key])) {
					unset($recommendations[$key]);
				} else {
					$product = $this -> Product -> findByClasification($prod_classification);
					if (empty($product)) {
						$valid_recommendations = false;
					}
				}
			}
			$this -> data['Product']['recommendations'] = "";
			foreach ($recommendations as $key => $val) {
				$this -> data['Product']['recommendations'] = $this -> data['Product']['recommendations'] . $val . ",";
			}
			$this -> data['Product']['recommendations'] = substr($this -> data['Product']['recommendations'], 0, strlen($this -> data['Product']['recommendations']) - 1);
			/**
			 * Revisar datos dobles
			 */
			foreach ($recommendations as $key1 => $recommendation1) {
				foreach ($recommendations as $key2 => $recommendation2) {
					if ($key1 != $key2) {
						if ($recommendation1 == $recommendation2) {
							$valid_recommendations = false;
						}
					}
				}
			}
			/**
			 * Revisar si es el mismo producto el que se recomienda
			 */
			foreach ($recommendations as $key => $recommendation) {
				if ($recommendation == $this -> data['Product']['clasification']) {
					$valid_recommendations = false;
				}
			}
			/**
			 * Contenedor de otras recomendaciones
			 */
			$other_recommendations = split(",", $this -> data['Product']['other_recommendations']);
			/*
			 * Hacer trim a los valores
			 */
			foreach ($other_recommendations as $key => $other_recommendation) {
				$other_recommendations[$key] = trim($other_recommendation);
				$prod_classification = $other_recommendations[$key];
				if (empty($other_recommendations[$key])) {
					unset($other_recommendations[$key]);
				} else {
					$product = $this -> Product -> findByClasification($prod_classification);
					if (empty($product)) {
						$valid_other_recommendations = false;
					}
				}
			}
			$this -> data['Product']['other_recommendations'] = "";
			foreach ($other_recommendations as $key => $val) {
				$this -> data['Product']['other_recommendations'] = $this -> data['Product']['other_recommendations'] . $val . ",";
			}
			$this -> data['Product']['other_recommendations'] = substr($this -> data['Product']['other_recommendations'], 0, strlen($this -> data['Product']['other_recommendations']) - 1);
			/**
			 * Revisar datos dobles
			 */
			foreach ($other_recommendations as $key1 => $other_recommendation1) {
				foreach ($recommendations as $key2 => $other_recommendation2) {
					if ($key1 != $key2) {
						if ($other_recommendation1 == $other_recommendation2) {
							$valid_other_recommendations = false;
						}
					}
				}
			}
			/**
			 * Revisar si es el mismo producto el que se recomienda
			 */
			foreach ($other_recommendations as $key => $other_recommendation) {
				if ($other_recommendation == $this -> data['Product']['clasification']) {
					$valid_other_recommendations = false;
				}
			}
			/**
			 * Revisar que no se meta el mismo producto en ambos tipos de recomendacion
			 */
			foreach ($recommendations as $key1 => $value1) {
				foreach ($other_recommendations as $key2 => $value2) {
					if ($value1 == $value2) {
						$valid_other_recommendations = false;
						$valid_recommendations = false;
					}
				}
			}
			if (!$valid_recommendations && !$valid_other_recommendations) {
				$this -> Session -> setFlash(__('Error en recomendaciones, revise que no exista un producto en ambos campos de recomendación.', true));
			} else {
				if (!$valid_recommendations) {
					$this -> Session -> setFlash(__('Error en recomendaciones, revise que no haya valor duplicado y que no sea el mismo producto', true));
				}
				if (!$valid_other_recommendations) {
					$this -> Session -> setFlash(__('Error en otras recomendaciones, revise que no haya valor duplicado y que no sea el mismo producto', true));
				}
			}
			/**
			 * Si estan validos ambos campos entonces guardar
			 * Limpiar y guardar las recomendaciones correspondientes
			 */
			if ($valid_recommendations && $valid_other_recommendations) {
				if ($this -> Product -> save($this -> data)) {
					/**
					 * Eliminar las recomendaciones del producto previas--------------------------------------------------
					 */
					$product_recommendations = $this -> Product -> Recommendation -> find('all');
					foreach ($product_recommendations as $product_recommendation) {
						if ($product_recommendation['Recommendation']['product_id'] == $this -> data['Product']['id']) {
							$this -> Product -> Recommendation -> delete($product_recommendation['Recommendation']['id']);
						}
					}
					/*
					 * Crear las recomendaciones
					 */
					foreach ($recommendations as $clasification) {
						$recommended_product = $this -> Product -> findByClasification($clasification);
						$this -> Product -> Recommendation -> create();
						$this -> Product -> Recommendation -> set('product_id', $this -> data['Product']['id']);
						$this -> Product -> Recommendation -> set('recommended_product_id', $recommended_product['Product']['id']);
						$this -> Product -> Recommendation -> save();
					}
					/**
					 * Eliminar las recomendaciones del producto previas--------------------------------------------------
					 */
					$product_recommendations = $this -> Product -> OtherRecommendation -> find('all');
					foreach ($product_recommendations as $product_recommendation) {
						if ($product_recommendation['OtherRecommendation']['product_id'] == $this -> data['Product']['id']) {
							$this -> Product -> OtherRecommendation -> delete($product_recommendation['OtherRecommendation']['id']);
						}
					}
					/*
					 * Crear las otras recomendaciones
					 */
					foreach ($other_recommendations as $clasification) {
						$recommended_product = $this -> Product -> findByClasification($clasification);
						$this -> Product -> OtherRecommendation -> create();
						$this -> Product -> OtherRecommendation -> set('product_id', $this -> data['Product']['id']);
						$this -> Product -> OtherRecommendation -> set('recommended_product_id', $recommended_product['Product']['id']);
						$this -> Product -> OtherRecommendation -> save();
					}
					$this -> Session -> setFlash(__('The product has been saved', true));
					$this -> redirect(array('action' => 'index'));
				} else {
					$this -> Session -> setFlash(__('The product could not be saved. Please, try again.', true));
				}
			}
		}
		$this -> data = $this -> Product -> read(null, $id);
		$brands = $this -> Product -> Brand -> find('list');
		$collections = $this -> requestAction('/collections/localListBrandCollections/' . $this -> data['Product']['brand_id']);
		$subcategories = $this -> requestAction('/subcategories/localListBrandCategories/' . $this -> data['Product']['brand_id']);
		$this -> set(compact('brands', 'collections', 'subcategories'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for product', true));
			$this -> redirect(array('action' => 'index'));
		} else {
			$can_delete = true;
			$product = $this -> Product -> read(null, $id);
			$inventory = $this -> Product -> Inventory -> find('all', array('recursive'=>-1, 'conditions'=>array('Inventory.product_id'=>$id)));
			foreach ($inventory as $key => $data) {
				if($data['Inventory']['quantity']>0){
					$can_delete=false;
				}
			}
			if ($can_delete) {
				/*foreach ($inventory as $key => $data) {
					$this -> Product -> Inventory -> delete($data['Inventory']['id']);
				}*/
				if ($this -> Product -> delete($id)) {
					$this -> Session -> setFlash(__('Producto eliminado', true));
					$this -> redirect(array('action' => 'index'));
				}
			} else {
				$this -> Session -> setFlash(__('No se puede eliminar el producto, revise que no hayan existencias en el inventario.', true));
				$this -> redirect(array('action' => 'index'));
			}
		}
		$this -> Session -> setFlash(__('Error al tratar de eliminar el producto.', true));
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
