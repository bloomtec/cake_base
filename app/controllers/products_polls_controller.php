<?php
class ProductsPollsController extends AppController {

	var $name = 'ProductsPolls';
	
	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}
	
	function userPoll($product_id = null, $votacion = null) {
		$this->layout="ajax";
		if($product_id && $votacion) {
			if(
				$poll = $this->ProductsPoll->find(
					'first',
					array(
						'recursive'=>-1,
						'conditions'=>array(
							'ProductsPoll.user_id'=>$this->Session->read('Auth.User.id'),
							'ProductsPoll.product_id'=>$product_id
						)
					)
				)
			) {
				$this->ProductsPoll->delete($poll['ProductsPoll']['id']);
			}
			$this->ProductsPoll->create();
			$this->ProductsPoll->set('user_id', $this->Session->read("Auth.User.id"));
			$this->ProductsPoll->set('product_id', $product_id);
			$this->ProductsPoll->set('vote', $votacion);
			if ($this->ProductsPoll->save()) {
				$product_polls = $this->ProductsPoll->find(
					'list',
					array(
						'conditions'=>array(
							'ProductsPoll.product_id'=>$product_id
						),
						'fields'=>array('ProductsPoll.vote')
					)
				);
				$total = 0.0;
				foreach($product_polls as $poll) {
					$total = $total + $poll['vote'];
				}
				$result = $total / count($product_polls);
				echo "$result";
			} else {
				echo false;
			}
		}
		exit(0);
	}
	
	function getProductPoll($product_id = null) {
		$this->layout="ajax";
		$product_polls = $this->ProductsPoll->find(
			'list',
			array(
				'conditions'=>array(
					'ProductsPoll.product_id'=>$product_id
				),
				'fields'=>array('ProductsPoll.vote')
			)
		);
		$total = 0.0;
		if(!empty($product_polls)) {
			foreach($product_polls as $poll) {
				$total = $total + $poll['vote'];
			}
			$result = $total / count($product_polls);
			echo "$result";
		} else {
			echo "0";
		}		
		exit(0);
	}

}