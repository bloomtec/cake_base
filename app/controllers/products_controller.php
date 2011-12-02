<?php
class ProductsController extends AppController {

	var $name = 'Products';

	function getProduct($product_id = null) {
		$this->Product->recursive=-1;
		$product = $this->Product->read(null, $product_id);
		$this->Product->Inventory->recursive=-1;
		$inventory = $this->Product->Inventory->find('first', array('conditions'=>array('Inventory.product_id'=>$product_id)));
		$data = array();
		$data['Product']=$product['Product'];
		$data['Inventory']=$inventory['Inventory'];
		return $data;
	}

	function searchResults(){
		$q=$this->data['query'];
		$brand_ids = $this->Product->Brand->find(
			'list',
			array(
				'fields'=>array('Brand.id'),
				'conditions'=>array('Brand.name LIKE' => "%$q%"),
				'recursive'				
			)
		);		
		$this->paginate = array(
			'conditions' => array(
				"OR" => array(
					'Product.name LIKE' => "%$q%",
					'Product.description LIKE' => "$q",
					'Product.ref LIKE' => "$q",
					'Product.brand_id'=>$brand_ids
				)
			)
		);
		$products = $this->paginate();
		$this->set('products', $products);
	}

	function findRecommendedProducts($product_id) {
		$recommended_product_ids = $this -> Product -> Recommendation -> find('list', array('fields' => array('Recommendation.recommended_product_id'), 'conditions' => array('Recommendation.product_id' => $product_id), 'limit' => 5, 'order' => 'rand()'));
		return $this -> Product -> find('all', array('conditions' => array('Product.id' => $recommended_product_ids, 'Product.is_visible'=>1)));
	}

	function featuredProduct($tag_id) {
		$this->layout="ajax";
		$featured_products_ids = $this->Product->find(
			'list',
			array(
				'fields' => array(
					'Product.id'
				),
				'conditions' => array(
					'Product.is_featured' => 1
				)
			)
		);
		$featured_products_ids_with_tag_id = $this->Product->ProductsTag->find(
			'list',
			array(
				'fields' => array(
					'ProductsTag.product_id'
				),
				'conditions' => array(
					'ProductsTag.product_id' => $featured_products_ids,
					'ProductsTag.tag_id' => $tag_id
				)
			)
		);
		$product = $this->Product->find(
			'first',
			array(
				'conditions' => array(
					'Product.id'=>$featured_products_ids_with_tag_id
				),
				'order'=>array(
					'rand()'
				)
			)
		);
		$this->set('product', $product);
	}

	function index() {
		$this->Product->recursive = 0;
		$this->set('products', $this->paginate());
		$this->layout="personaliza";
	}

	function view($slug = null) {
		if (!$slug) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array('action' => 'index'));
		}
		$product = $this->Product->findBySlug($slug);
		$this->set('product', $product);
		$this -> requestAction('/visited_products/sync/'.$product['Product']['id']);
	}

	function admin_index() {
		if(!empty($this->data)) {
			//debug($this->data);
			$conditions = array();
			if(!empty($this->data['Product']['product_type_id'])){
				$conditions['Product.product_type_id']=$this->data['Product']['product_type_id'];
			}
			if(!empty($this->data['Product']['palabra_clave'])){
				$conditions['Product.name LIKE']="%".$this->data['Product']['palabra_clave']."%";
				$conditions['Product.ref LIKE']="%".$this->data['Product']['palabra_clave']."%";
			}
			$this->paginate=array(
				'conditions'=>$conditions
			);
		}
		$productTypes = $this->Product->ProductType->find('list', array('order'=>array('ProductType.name'=>'ASC')));
		$this->set(compact('productTypes'));
		$this->Product->recursive = 0;
		$this->set('products', $this->paginate());
	}

	function admin_view($slug = null) {
		if (!$slug) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('product', $this->Product->findBySlug($slug));
	}

	function admin_formByType($type_id = null, $id = null) {
		$this->layout="ajax";
		$this -> data = $this ->Session->read('tmp_data');
		$this->Session->delete('tmp_data');
		if (empty($this->data) && $id) {
			$this->data = $this->Product->read(null, $id);
		}
		$productTypes = $this->Product->ProductType->find('list');
		$architectures = $this->Product->Architecture->find('list');
		$slots = $this->Product->Slot->find('list');
		$this->set(compact('productTypes', 'architectures', 'slots', 'type_id'));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Session->write('tmp_data', $this->data);
			// Añadir el Tag
			$this->data['Tag']['Tag'][]=$this->data['Product']['product_type_id'];
			// Revisar las recomendaciones
			$data = null;
			$recommendations = false;
			if(!empty($this -> data['Product']['recommendations'])) {
				$data = $this->validateRecommendations($this -> data['Product']['recommendations'], $this -> data['Product']['ref']);
				$recommendations = true;
			}
			if(!$recommendations || !empty($data)) {
				$this->Product->create();
				if ($this->Product->save($this->data)) {
					// Asignar los slots
					foreach($this->data['slots'] as $slot_id=>$data) {
						if($data['checked']) {
							$this->Product->ProductsSlot->create();
							$this->Product->ProductsSlot->set('product_id', $this->Product->id);
							$this->Product->ProductsSlot->set('slot_id', $slot_id);
							$this->Product->ProductsSlot->set('quantity', $data['quantity']);
							$this->Product->ProductsSlot->save();
						}
					}
					// Crear el inventario en 0
					$this->Product->Inventory->create();
					$this->Product->Inventory->set('product_id', $this->Product->id);
					$this->Product->Inventory->set('quantity', 0);
					if($this->Product->Inventory->save()) {
						// Añadir las recomendaciones
						$data = split(",", $data);
						foreach ($data as $ref) {
							$recommended_product = $this -> Product -> findByRef($ref);
							$this -> Product -> Recommendation -> create();
							$this -> Product -> Recommendation -> set('product_id', $this -> Product -> id);
							$this -> Product -> Recommendation -> set('recommended_product_id', $recommended_product['Product']['id']);
							$this -> Product -> Recommendation -> save();
						}
					$this->Session->setFlash(__('The product has been saved', true));
					} else {
						$this->Session->setFlash(__('The product has been saved without an inventory', true));
					}
					$this->redirect(array('action' => 'index'));
				} else {
					//debug($this->Product->invalidFields());
					$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
				}
			} else {
				$this->Session->setFlash(__('The recommendations entered are not valid. Check that the ref exists, that there are no repeated values and that the ref is not the same as the product being added. Please, try again.', true));
			}
		}
		$productTypes = $this->Product->ProductType->find('list', array('order'=>array('ProductType.name'=>'ASC')));
		$brands = $this->Product->Brand->find('list', array('order'=>array('Brand.name'=>'ASC')));
		$tags = $this->Product->Tag->find('list', array('conditions'=>array('Tag.id >'=>18)));
		$this->set(compact('productTypes', 'brands', 'tags'));
	}

	function validateRecommendations($data = null, $ref = null) {
		$this->autorender=false;
		$valid_recommendations = true;
		/**
		 * Contenedor de recomencdaciones
		 */
		$recommendations = split(",", $data);
		/*
		 * Hacer trim a los valores y validar
		 */
		foreach ($recommendations as $key => $recommendation) {
			$recommendations[$key] = trim($recommendation);
			$prod_classification = $recommendations[$key];
			if (empty($recommendations[$key])) {
				unset($recommendations[$key]);
			} else {
				$product = $this -> Product -> findByRef($prod_classification);
				if (empty($product)) {
					$valid_recommendations = false;
				}
			}
		}
		$data = "";
		foreach ($recommendations as $key => $val) {
			$data = $data . $val . ",";
		}
		$data = substr($data, 0, strlen($data) - 1);
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
			if ($recommendation == $ref) {
				$valid_recommendations = false;
			}
		}
		if (!$valid_recommendations) {
			return null;
		} else {
			return $data;
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			// Revisar las recomendaciones
			$data = null;
			$recommendations = false;
			if(!empty($this -> data['Product']['recommendations'])) {
				$data = $this->validateRecommendations($this -> data['Product']['recommendations'], $this -> data['Product']['ref']);
				$recommendations = true;
			}
			if(!$recommendations || !empty($data)) {
				if ($this->Product->save($this->data)) {
					// Eliminar slots para reasignarlos
					$slots = $this->Product->ProductsSlot->find('all', array('conditions'=>array('ProductsSlot.product_id'=>$this->data['Product']['id'])));
					foreach($slots as $slot) {
						$this->Product->ProductsSlot->delete($slot['ProductsSlot']['id']);
					}
					// Asignar los slots
					foreach($this->data['slots'] as $slot_id=>$data) {
						if($data['checked']) {
							$this->Product->ProductsSlot->create();
							$this->Product->ProductsSlot->set('product_id', $this->data['Product']['id']);
							$this->Product->ProductsSlot->set('slot_id', $slot_id);
							$this->Product->ProductsSlot->set('quantity', $data['quantity']);
							$this->Product->ProductsSlot->save();
						}
					}
					// Eliminar recomendaciones para reasignarlar
					$recomendados = $this -> Product -> Recommendation -> find('all', array('conditions'=>array('Recommendation.product_id'=>$this->data['Product']['id'])));
					if(!empty($recomendados)) {
						foreach($recomendados as $recomendado) {
							$this -> Product -> Recommendation -> delete($recomendado['Recommendation']['id']);
						}
						// Añadir las recomendaciones
						$data = split(",", $data);
						foreach ($data as $ref) {
							$recommended_product = $this -> Product -> findByRef($ref);
							$this -> Product -> Recommendation -> create();
							$this -> Product -> Recommendation -> set('product_id', $this->data['Product']['id']);
							$this -> Product -> Recommendation -> set('recommended_product_id', $recommended_product['Product']['id']);
							$this -> Product -> Recommendation -> save();
						}
					}
					$this->Session->setFlash(__('The product has been saved', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
				}
			} else {
				$this->Session->setFlash(__('The recommendations don\'t seem valid. Check them and try again', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Product->read(null, $id);
		}
		$productTypes = $this->Product->ProductType->find('list', array('order'=>array('ProductType.name'=>'ASC')));
		$brands = $this->Product->Brand->find('list', array('order'=>array('Brand.name'=>'ASC')));
		$tags = $this->Product->Tag->find('list', array('conditions'=>array('Tag.id >'=>18)));
		$this->set(compact('productTypes', 'brands', 'tags'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Product->delete($id)) {
			$this->Session->setFlash(__('Product deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		//debug($this->Product->invalidFields());
		$this->Session->setFlash(__('Product was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Product->read(null,$id);
		$oldData["Product"]['is_active']=false;
		if ($this->Product->save($oldData)) {
			$this->Session->setFlash(__('Product archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Product was not archived', true));
		$this->redirect(array('action' => 'index'));
	}

	function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Product->read(null,$id);
		$oldData["Product"]['is_active']=true;
		if ($this->Product->save($oldData)) {
			$this->Session->setFlash(__('Product archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Product was not archived', true));
		$this->redirect(array('action' => 'index'));
	}

	function getSocketsByArchitecture($architecture_id = null) {
		$this->layout="ajax";
		if($architecture_id) {
			echo json_encode($this->Product->Socket->find('list', array('conditions'=>array('Socket.architecture_id'=>$architecture_id))));
		} else {
			echo null;
		}
		exit(0);
	}
}
