<?php
class TagsController extends AppController {

	var $name = 'Tags';
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('filtro','view','index','productsFilter');
	}
	
	function index() {
		$this->Tag->recursive = 0;
		$this->set('tags', $this->paginate());
	}

	function view($slug = null) {
		$this->layout='categoria';
		$conditions = array();
		$limit = 16;
		$this->Tag->recursive=-1;
		$tag = $this->Tag->findBySlug($slug);
		if(isset($this->data) && !empty($this->data)) {
			debug($this->data);
			/**
			 * Proceder con el filtrado
			 */
			// Filtro marca
			if(isset($this->data['brand_id']) && !empty($this->data['brand_id'])) {
				$conditions['Product.brand_id'] = $this->data['brand_id'];
			}
			// Revisar si se filtra por arquitectura
			if(isset($this->data['architecture_id']) && !empty($this->data['architecture_id'])) {
				$conditions['Product.architecture_id'] = $this->data['architecture_id']; 
			}
			// Revisar si se filtra por socket
			if(isset($this->data['socket_id']) && !empty($this->data['socket_id'])) {
				$products_with_socket_id = $this->Tag->Product->ProductsSocket->find(
					'list',
					array(
						'conditions' => array(
							'ProductsSocket.socket_id'=>$this->data['socket_id']
						),
						'fields'=>array(
							'ProductsSocket.product_id'
						)
					)
				);
				$conditions['Product.id'] = $products_with_socket_id; 
			}
			// Revisar si se filtra por nombre de producto
			if(isset($this->data['named']['name']) && !empty($this->data['named']['name'])) {
				$conditions['Product.name'] = $this->data['named']['name'];
			}
			// Revisar si se filtra por nombre de producto
			if(isset($this->data['named']['name']) && !empty($this->data['named']['name'])) {
				$conditions['Product.name'] = $this->data['named']['name'];
			}
			// Revisar si se filtra por "is_gamers"
			if(isset($this->data['named']['gamers']) && !empty($this->data['named']['gamers'])) {
				$conditions['Product.is_gamers'] = $this->data['named']['is_gamers'];
			}
		}
		// Obtener del tag el tipo de producto
		$conditions['Product.product_type_id']=$tag['Tag']['id'];
		if (empty($tag)) {
			$this->Session->setFlash(__('Invalid tag', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->paginate = array(
			"Product" => array(
				'limit' => $limit,
				'conditions' => $conditions
			)			
		);
		$products = $this->paginate('Product');
		$this->set(compact('products', 'tag'));
	}
	
	function filtro($tag_id = null){
		$this->layout='ajax';
		// Filtrar las marcas acorde el tag
		$brands_ids = $this->Tag->Product->find(
			'list',
			array(
				'conditions' => array(
					'Product.product_type_id'=>$tag_id
				),
				'fields'=>array(
					'Product.brand_id'
				)
			)
		);
		$brands = $this->Tag->Product->Brand->find(
			'list',
			array(
				'conditions' => array(
					'Brand.id'=>$brands_ids
				)
			)
		);
		// Recoger la demás info acorde el tag
		if ($tag_id == 1 || $tag_id == 2) {
			$architectures = $this->Tag->Product->Architecture->find('list');
			$sockets = $this->Tag->Product->Socket->find('list');
			$this->set(compact('architectures', 'sockets'));
		}
		if ($tag_id == 2) {
			//TODO:Como manejar filtro por video incluido?
		}
		$tag = $this->Tag->findById($tag_id);
		$this->set(compact('brands', 'tag_id', 'tag'));
	}
	
	function admin_index() {
		$this->Tag->recursive = 0;
		$this->set('tags', $this->paginate());
	}

	function admin_view($slug = null) {
		if (!$slug) {
			$this->Session->setFlash(__('Invalid tag', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Tag->recursive=2;
		$this->set('tag', $this->Tag->findBySlug($slug));
	}
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->Tag->create();
			if ($this->Tag->save($this->data)) {
				$this->Session->setFlash(__('The tag has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tag could not be saved. Please, try again.', true));
			}
		}
		$products = $this->Tag->Product->find('list');
		$this->set(compact('products'));
	}
	
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid tag', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Tag->save($this->data)) {
				$this->Session->setFlash(__('The tag has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tag could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Tag->read(null, $id);
		}
		$products = $this->Tag->Product->find('list');
		$this->set(compact('products'));
	}
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for tag', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Tag->delete($id)) {
			$this->Session->setFlash(__('Tag deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Tag was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	
	function admin_reOrder(){
    	foreach($this->data["Item"] as $id=>$position){
    		$this->Tag->id=$id;
    		$this->Tag->saveField("sort",$position); 
    	}
		echo true;
		Configure::write('debug', 0);
		$this->autoRender = false;
		exit();
	}

}
