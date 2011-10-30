<?php
class ProductsController extends AppController {

	var $name = 'Products';
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('getSocketsByArchitecture', 'featuredProduct','searchResults');
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
	}

	function view($slug = null) {
		if (!$slug) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('product', $this->Product->findBySlug($slug));
	}
	
	function admin_index() {
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
	
	function admin_formByType($type_id = null) {
		$this->layout="ajax";
		$productTypes = $this->Product->ProductType->find('list');
		$architectures = $this->Product->Architecture->find('list');
		$slots = $this->Product->Slot->find('list');
		//$sockets = $this->Product->Socket->find('list');
		$brands = $this->Product->Brand->find('list');
		$tags = $this->Product->Tag->find('list', array('conditions'=>array('Tag.id >'=>13)));
		$this->set(compact('productTypes', 'architectures', 'slots', 'sockets', 'tags', 'brands', 'type_id'));
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
	
	function admin_add() {
		if (!empty($this->data)) {
			// Añadir el Tag
			$this->data['Tag']['Tag'][]=$this->data['Product']['product_type_id'];
			// Revisar las recomendaciones
			$data = null;
			$recommendations = false;
			if(!empty($this -> data['Product']['recommendations'])) {
				$data = $this->validateRecommendations($this -> data['Product']['recommendations'], $this -> data['Product']['ref']);
				$recommendations = true;
			}
			
			if(!$recommendations || $data) {
				$this->Product->create();
				if ($this->Product->save($this->data)) {
					$this->Session->setFlash(__('The product has been saved', true));
					$this->redirect(array('action' => 'index'));
				} else {
					debug($this->Product->invalidFields());
					$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
				}
			} else {
				$this->Session->setFlash(__('The recommendations entered are not valid. Check for repeated values and that the ref is not the same as the product being added. Please, try again.', true));
			}
		}
		$productTypes = $this->Product->ProductType->find('list');
		$this->set(compact('productTypes'));
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
				$product = $this -> Product -> findByClasification($prod_classification);
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
			if ($this->Product->save($this->data)) {
				$this->Session->setFlash(__('The product has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Product->read(null, $id);
		}
		$productTypes = $this->Product->ProductType->find('list');
		$architectures = $this->Product->Architecture->find('list');
		$slots = $this->Product->Slot->find('list');
		$sockets = $this->Product->Socket->find('list');
		$tags = $this->Product->Tag->find('list');
		$this->set(compact('productTypes', 'architectures', 'slots', 'sockets', 'tags'));
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

}
