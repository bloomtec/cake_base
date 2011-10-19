<?php
class VisitedProductsController extends AppController {

	var $name = 'VisitedProducts';

	function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> allow('sync', 'visited');
	}

	function sync($product_id = null) {
		$user_id = $this -> Session -> read('Auth.User.id');
		if ($user_id && $product_id) {
			$row = $this -> VisitedProduct -> find('first', array('recursive' => -1, 'conditions' => array('VisitedProduct.user_id' => $user_id, 'VisitedProduct.product_id' => $product_id)));
			if ($row) {
				$row['VisitedProduct']['count'] = $row['VisitedProduct']['count'] + 1;
				$this -> VisitedProduct -> save($row);
			} else {
				$this -> VisitedProduct -> create();
				$this -> VisitedProduct -> set('user_id', $user_id);
				$this -> VisitedProduct -> set('product_id', $product_id);
				$this -> VisitedProduct -> set('count', 1);
				$this -> VisitedProduct -> save();
			}
			$product_ids = $this -> VisitedProduct -> find('list', array('conditions' => array('VisitedProduct.user_id' => $user_id), 'fields' => array('VisitedProduct.product_id'), 'order' => array('VisitedProduct.updated' => 'DESC'), 'limit' => 5));
			$this -> loadModel('Product');
			return $this -> Product -> find('all', array('conditions' => array('Product.id' => $product_ids)));
		}
	}

	function visited() {
		$user_id = $this -> Session -> read('Auth.User.id');
		if ($user_id) {
			$product_ids = $this -> VisitedProduct -> find('list', array('conditions' => array('VisitedProduct.user_id' => $user_id), 'fields' => array('VisitedProduct.product_id'), 'order' => array('VisitedProduct.updated' => 'DESC'), 'limit' => 15));
			$this -> loadModel('Product');
			return $this -> Product -> find('all', array('conditions' => array('Product.id' => $product_ids)));
		} else {
			return null;
		}
	}

}
