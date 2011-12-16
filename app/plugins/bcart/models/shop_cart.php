<?php
class ShopCart extends BcartAppModel {
	var $name = 'ShopCart';
	var $displayField = 'id';
	var $isPicture = false;
	var $sluggable = false;
	var $sortable = false;
	var $activable = false;

	var $validate = array(
		'identifier' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'ShopCartItem' => array(
			'className' => 'Bcart.ShopCartItem',
			'foreignKey' => 'shop_cart_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	function cleanCarts() {
		$shopCarts = $this->find('all', array('conditions'=>array('ShopCart.user_id'=>null)));
		$dias = -1;
		$date = gmdate('Y-m-d H:i:s', time() + (3600 * -5));
		$date = strtotime(date("Y-m-d H:i:s", strtotime($date)) . " +" . $dias . " day");
		$date = date("Y-m-d H:i:s", $date);
		$date = new DateTime($date);
		foreach ($shopCarts as $cart) {
			$updatedDate = $cart['ShopCart']['updated'];
			$updatedDate = strtotime(date("Y-m-d H:i:s", strtotime($updatedDate)));
			$updatedDate = date("Y-m-d H:i:s", $updatedDate);
			$updatedDate = new DateTime($updatedDate);
			if($updatedDate >= $date) {
				// carrito todavía en el rango de vida, dejarlo quieto
			} else {
				$this->delete($cart['ShopCart']['id']);
			}
		}
	return true;
	}

}
