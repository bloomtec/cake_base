<?php
class ShopCart extends AppModel {
	var $name = 'ShopCart';
	var $displayField = 'id';
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
			'className' => 'ShopCartItem',
			'foreignKey' => 'shop_cart_id',
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
	
	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 */
	
	/*
 	Get all item in current session
 	from shopping cart table
 	*/
	function getCart($inventory_id, $session_id) {
		return $this -> find('all', array('conditions' => array('Cart.inventory_id' => $inventory_id, 'Cart.session_id' => $session_id), 'order' => 'Cart.id ASC'));
	}

	function isCartEmpty($session_id) {
		$result = $this -> find('first', array('conditions' => array('Cart.session_id' => $session_id), 'recursive' => 0));
		if(empty($result)) {
			return true;
		}
		return false;
	}

	// put the product in cart table
	function addCart($inventory_id, $session_id) {
		$this -> create();
		$this -> set('inventory_id', $inventory_id);
		$this -> set('session_id', $session_id);
		$this -> set('cantidad', 1);
		$this -> save();

	}

	// put the product in cart table
	function updateCart($inventory_id, $session_id) {
		$sql = "UPDATE carts
		SET cantidad = cantidad + 1
		WHERE session_id = '$session_id' AND inventory_id = $inventory_id";
		$this -> query($sql);
	}

	/*
 	Delete all cart entries older than three day
 	*/
	function cleanUp() {
		$threeDaysAgo = date('Y-m-d H:i:s',   mktime(0, 0, 0,   date('m'), date('d') - 3,   date('Y')));

		$delete_condition = "Cart.created < '$threeDaysAgo'";
		$this -> deleteAll($delete_condition, false);
	}

	function getCartContent($session_id) {
		$cartContent = array();

		$sql = "SELECT
					carts.id, carts.inventory_id, carts.cantidad,
					inventories.id, inventories.talla_id, inventories.color_id,
					products.id, products.precio, products.nombre, products.imagen,
					categories.id, categories.nombre, categories.descripcion, categories.imagen
				FROM carts, inventories, products, categories
				WHERE carts.session_id = '$session_id'
				AND inventories.id = carts.inventory_id
				AND products.id = inventories.product_id
				AND categories.id = products.category_id";

		$results = $this -> query($sql);

		foreach($results as $result) {
			$cartContent[] = $result;
		}

		return $cartContent;
	}

	/*
 	Remove an item from the cart
 	*/
	function emptyBasket($cartId = NULL) {
		if($cartId) {
			$this -> delete($cartId);
		}
	}

	function doUpdate($nueva_cantidad, $cart_id) {
		// update product quantity
		$this -> read(null, $cart_id);
		$this -> set('cantidad', $nueva_cantidad);		
		//$this -> id = $cart_id;
		//$this -> cantidad = $nueva_cantidad;
		$this -> save();
	}
	
	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 */

}
