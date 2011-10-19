<?php
class Coupon extends AppModel {
	var $name = 'Coupon';
	var $displayField = 'serial';
	var $validate = array(
		'coupon_batch_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'serial' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'is_redeemed' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasOne = array(
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'coupon_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $belongsTo = array(
		'CouponBatch' => array(
			'className' => 'CouponBatch',
			'foreignKey' => 'coupon_batch_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function createCoupon($coupon_batch_id) {
		/**
		 * numero-serial
		 * xxx-xxxxxx
		 */
		$length = 6;
		$string = "";
		$possible = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

		for($i=0;$i < $length;$i++) {
			$char = $possible[mt_rand(0, strlen($possible)-1)];
			$string .= $char;
		}
		
		$code = $coupon_batch_id;
		$longitud = strlen($coupon_batch_id);
		for ($i = (3 - $longitud); $i > 0; $i--) {
			$code = "0" . $code;
		}
		$code=$code."-".$string;		

		$this->create();
		$this->set('coupon_batch_id', $coupon_batch_id);
		$this->set('serial', $code);

		if ($this->save()) {
			return true;
		} else {
			return false;
		}
		
	}
	
}
