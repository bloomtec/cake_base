<?php
class ProductsController extends AppController {

	var $name = 'Products';
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('getSocketsByArchitecture', 'productsFilter');
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
	
	function productsFilter() {
		$conditions = array();
		$limit = 10;
		// Revisar que llegue algun tipo de filtrado
		if(isset($this->params['named']) && !empty($this->params['named'])) {
			// Revisar si se pone limite al paginado
			if(isset($this->params['named']['limit']) && !empty($this->params['named']['limit'])) {
				$limit = $this->params['named']['limit'];
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
			$limit,
			$conditions
		);
		return $this->paginate('Product');
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
		$tags = $this->Product->Tag->find('list', array('conditions'=>array('Tag.id >'=>13)));
		$this->set(compact('productTypes', 'architectures', 'slots', 'sockets', 'tags', 'type_id'));
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
			$this->Product->create();
			if ($this->Product->save($this->data)) {
				$this->Session->setFlash(__('The product has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
			}
		}
		$productTypes = $this->Product->ProductType->find('list');
		$this->set(compact('productTypes'));
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
