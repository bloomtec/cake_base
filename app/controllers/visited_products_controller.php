<?php
class VisitedProductsController extends AppController {

	var $name = 'VisitedProducts';
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('sync');
	}
	
	function sync($product_id = null) {
		$user_id = $this->Session->read('Auth.User.id');
		if($user_id && $product_id) {
			$row = $this->VisitedProduct->find(
				'first',
				array(
					'recursive'=>-1,
					'conditions' => array(
						'VisitedProduct.user_id'=>$user_id,
						'VisitedProduct.product_id'=>$product_id
					)
				)
			);
			if($row) {
				$row['VisitedProduct']['count'] = $row['VisitedProduct']['count'] + 1;
				$this->VisitedProduct->save($row); 
			} else {
				$this->VisitedProduct->create();
				$this->VisitedProduct->set('user_id', $user_id);
				$this->VisitedProduct->set('product_id', $product_id);
				$this->VisitedProduct->set('count', 1);
				$this->VisitedProduct->save();
			}
			$product_ids = $this->VisitedProduct->find(
				'list',
				array(
					'conditions'=>array(
						'VisitedProduct.user_id'=>$user_id
					),
					'fields' => array(
						'VisitedProduct.product_id'
					),
					'order'=>array('VisitedProduct.created'=>'DESC'),
					'limit'=>5
				)
			);
			$this->loadModel('Product');
			return $this->Product->find('all', array('conditions'=>array('Product.id'=>$product_ids)));
			}
	}

	function index() {
		$this -> VisitedProduct -> recursive = 0;
		$this -> set('visitedProducts', $this -> paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid visited product', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('visitedProduct', $this -> VisitedProduct -> read(null, $id));
	}

	function setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for visited product', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> VisitedProduct -> read(null, $id);
		$oldData["VisitedProduct"]["active"] = false;
		if ($this -> VisitedProduct -> save($oldData)) {
			$this -> Session -> setFlash(__('Visited product archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Visited product was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for visited product', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> VisitedProduct -> read(null, $id);
		$oldData["VisitedProduct"]["active"] = true;
		if ($this -> VisitedProduct -> save($oldData)) {
			$this -> Session -> setFlash(__('Visited product archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Visited product was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> VisitedProduct -> find($type, $findParams);
		} else {
			return null;
		}
	}

	function admin_index() {
		$this -> VisitedProduct -> recursive = 0;
		$this -> set('visitedProducts', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid visited product', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('visitedProduct', $this -> VisitedProduct -> read(null, $id));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> VisitedProduct -> create();
			if ($this -> VisitedProduct -> save($this -> data)) {
				$this -> Session -> setFlash(__('The visited product has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The visited product could not be saved. Please, try again.', true));
			}
		}
		$products = $this -> VisitedProduct -> Product -> find('list');
		$users = $this -> VisitedProduct -> User -> find('list');
		$this -> set(compact('products', 'users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid visited product', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> VisitedProduct -> save($this -> data)) {
				$this -> Session -> setFlash(__('The visited product has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The visited product could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> VisitedProduct -> read(null, $id);
		}
		$products = $this -> VisitedProduct -> Product -> find('list');
		$users = $this -> VisitedProduct -> User -> find('list');
		$this -> set(compact('products', 'users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for visited product', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> VisitedProduct -> delete($id)) {
			$this -> Session -> setFlash(__('Visited product deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Visited product was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for visited product', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> VisitedProduct -> read(null, $id);
		$oldData["VisitedProduct"]["active"] = false;
		if ($this -> VisitedProduct -> save($oldData)) {
			$this -> Session -> setFlash(__('Visited product archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Visited product was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for visited product', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> VisitedProduct -> read(null, $id);
		$oldData["VisitedProduct"]["active"] = true;
		if ($this -> VisitedProduct -> save($oldData)) {
			$this -> Session -> setFlash(__('Visited product archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Visited product was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> VisitedProduct -> find($type, $findParams);
		} else {
			return null;
		}
	}

}
