<?php
class BrandsController extends AppController {

	var $name = 'Brands';
	function beforeFilter(){
		parent::beforeFilter();
		$this -> Auth -> allow('*');
	}
	function view($slug = null) {
		if (!$slug) {
			$this -> Session -> setFlash(__('Invalid brand', true));
			$this -> redirect(array('action' => 'index'));
		}
		$brand = $this -> Brand -> find('first', array('slug'=>$slug));
		$id=$brand['Brand']['id'];
		$category["Category"] = $brand["Category"];
		$pageURL = $this -> getUrl();
		/** 
		 * EEMPLAZAR LA SIGUIENTE LINEA CON EL PAGINADO
		 **/
		$this->loadModel("Product");
		//$products = $this -> Brand -> Subcategory -> Product -> find('all');
		$conditions = array();
		if((isset($this->params['named']['subcategoria'])) && (!empty($this->params['named']['subcategoria']))) {
			$conditions['Product.subcategory_id']=$this->params['named']['subcategoria'];
		}
		if((isset($this->params['named']['coleccion'])) && (!empty($this->params['named']['coleccion']))) {
			$conditions['Product.collection_id']=$this->params['named']['coleccion'];
		}
		if((isset($this->params['named']['talla'])) && (!empty($this->params['named']['talla']))) {
			/**
			 * Buscar en Inventories con el valor de la talla que llega (size_id) y retornar los product_id
			 * Luego, hacer una condicion tipo "Product.id"=>$product_ids
			 **/
			$product_ids = $this->requestAction('/inventories/listProductIDs/'.$this->params['named']['talla']);
			$conditions['Product.id']=$product_ids;
		}
		$this->paginate=array(
			"Product" => array(
				'limit' => 12,
				'conditions' => $conditions
			)
		);
		$products = $this->paginate('Product', array('Product.brand_id'=>$id));
		/**
		 * REEMPLAZAR LA ENTERIOR LINEA CON EL PAGINADO
		 **/
		$this -> set(compact('brand', 'category', 'pageURL', 'products'));
	}

	function getUrl() {
		$pageURL = 'http';
		if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";
		}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}

	function getCollections($id) {
		return $this -> Brand -> Collection -> find('list', array("conditions" => array('brand_id' => $id)));
	}

	function brandOfCategory($categoryId = null) {
		return $this -> Brand -> find("all", array("conditions" => array("category_id" => $categoryId)));
	}

	function brandsView() {
		// Hacer más fácil las busquedas de productos
		$this -> loadModel('Product');
		// Filtros para el paginado
		$subcategory_id = $this -> params['named']['subcategoria'];
		$collection_id = $this -> params['named']['coleccion'];
		$size_id = $this -> params['named']['talla'];
		$order = array('Product.created' => 'ASC');
		// Para esto se considera ASC
		$limit = 10;
		switch($this->params['named']['orden']) {
			case "preferido" :
				$order = array('Product.num_visits' => 'ASC');
				break;
			case "nuevo" :
				$order = array('Product.created' => 'ASC');
				break;
			default :
				$order = array('Product.created' => 'ASC');
				break;
		}
		$product_ids = $this -> Product -> find('list', array('fields' => array('Inventory.product_id'), 'conditions' => array('Inventory.size_id' => $size_id)));
		// ID's desde inventarios
		// Paginar según los datos enviados. Hay tres datos con los que paginar
		$this -> paginate = array('Product' => array('order' => $order, 'limit' => $limit, 'conditions' => array('Product.subcategory_id' => $subcategory_id, 'Product.collection_id' => $collection_id, 'Product.id' => $product_ids)));
		$products = $this -> paginate('Product');
		$this -> set('products', $products);
	}

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