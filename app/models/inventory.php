<?php
class Inventory extends AppModel {
	var $name = 'Inventory';
	var $displayField = 'id';
	var $isPicture=false;
	var $sluggable=false;
	var $sortable=false;
	var $activable=false;

	var $validate = array(
		'product_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'quantity' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'InventoryMovement' => array(
			'className' => 'InventoryMovement',
			'foreignKey' => 'inventory_id',
			'dependent' => false,
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

	function beforeSave(){
		return true;	
	}
	
	function afterSave($created) {
		$this->checkInventory();
	}
	
	function checkInventory() {
		App::import('Model', 'Bcart.ShopCart');
		//App::import('Model', 'Bcart.ShopCartItem');
		$this -> ShopCart = new ShopCart();
		//$this -> ShopCart -> ShopCartItem = new ShopCartItem();
		$carts = $this -> ShopCart -> find('all');
		// Recorrer los carros
		foreach ($carts as $cart) {
			// Recorrer los items del carro
			foreach ($cart['ShopCartItem'] as $item) {
				$this -> Product -> ShopCart -> ShopCartItem -> recursive = -1;
				$this -> Product -> recursive = -1;
				$aItem = $this -> ShopCart -> ShopCartItem -> read(null, $item['id']);
				$aProduct = $this -> Product -> read(null, $aItem['ShopCartItem']['foreign_key']);
				$availability = $this -> requestAction('/inventories/checkProductAvailability/' . $aItem['ShopCartItem']['foreign_key']);
				if ($availability < $aItem['ShopCartItem']['quantity']) {
					$aItem['ShopCartItem']['message'] = 'La cantidad de este item es inferior a la ingresada originalmente';
					$aItem['ShopCartItem']['quantity'] = $availability;
					if($this -> ShopCart -> ShopCartItem -> save($aItem)){
						//debug('se realizo un cambio');
					} else {
						//debug('error al realizar un cambio');
					}
					if ($aProduct['Product']['is_active'] === false) {
						$aItem['ShopCartItem']['message'] = 'Este producto no esta activo en la tienda actualmente';
						if($this -> ShopCart -> ShopCartItem -> save($aItem)){
							//debug('se realizo un cambio');
						} else {
							//debug('error al realizar un cambio');
						}
					}
				}
			}
		}
	}
	
}
