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
		if (!$slug) {
			$this->Session->setFlash(__('Invalid tag', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Tag->recursive=-1;
		$this->set('tag', $this->Tag->findBySlug($slug));
		$this->set('products',$this->paginate('Product'));
	}
	
	function filtro(){
		$this->layout='ajax';
		$conditions = array();
		$limit = 16;
		// Revisar que llegue algun tipo de filtrado
		if(isset($this->params['named']) && !empty($this->params['named'])) {
			// Revisar si se pone limite al paginado
			if(isset($this->params['named']['limite']) && !empty($this->params['named']['limite'])) {
				$limit = $this->params['named']['limite'];
			} else {
				//TODO:Nada por el momento
			}
			// Revisar si se filtra por arquitectura
			if(isset($this->params['named']['architecture']) && !empty($this->params['named']['architecture'])) {
				$conditions['Product.architecture_id'] = $this->params['named']['architecture']; 
			} else {
				//TODO:Nada por el momento
			}
			// Revisar si se filtra por tipo de producto
			if(isset($this->params['named']['type']) && !empty($this->params['named']['type'])) {
				$conditions['Product.product_type_id'] = $this->params['named']['type'];
				// Si es busqueda de tarjeta madre revisar si se quiere con o sin video
				if(($this->params['named']['type'] == 2) && isset($this->params['named']['video_included']) && !empty($this->params['named']['video_included'])) {
					$conditions['Product.is_video_included'] = $this->params['named']['video_included'];
				} else {
					//TODO:Nada por el momento
				}
			} else {
				//TODO:Nada por el momento
			}
			// Revisar si se filtra por nombre de producto
			if(isset($this->params['named']['name']) && !empty($this->params['named']['name'])) {
				$conditions['Product.name'] = $this->params['named']['name'];
			} else {
				//TODO:Nada por el momento
			}
			// Revisar si se filtra por nombre de producto
			if(isset($this->params['named']['name']) && !empty($this->params['named']['name'])) {
				$conditions['Product.name'] = $this->params['named']['name'];
			} else {
				//TODO:Nada por el momento
			}
			// Revisar si se filtra por "is_gamers"
			if(isset($this->params['named']['gamers']) && !empty($this->params['named']['gamers'])) {
				$conditions['Product.is_gamers'] = $this->params['named']['is_gamers'];
			} else {
				//TODO:Nada por el momento
			}
		} else {
			//TODO:Nada por el momento
		}
		$this->paginate = array(
			"Product" => array(
				$limit,
				$conditions
			)
		);
		return $this->paginate("Product");
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
