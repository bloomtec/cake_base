<?php
class ShopCartsController extends AppController {

	var $name = 'ShopCarts';
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(
			'addToCart', 'removeFromCart', 'checkoutCart', 'viewCart'
		);
	}
	
	/**
	 * ---------------------------------------------------------------------------------------------
	 * 									METODOS PARA MANEJO DEL CARRITO
	 * 
	 * El carrito debe de poder ser accedido por cualquiera.
	 * ---------------------------------------------------------------------------------------------
	 */
	/**
	 * Añadir ítems al carrito
	 **/
	function addToCart() {
		$this->layout="ajax";
		/**
		 * Se debe verificar si hay o no sesión de usuario.
		 */
		$user_id = $this->Session->read('Auth.User.id');
		if($user_id) {
			// Hay sesión abierta
			$shopping_cart = $this->ShopCart->find('first', array('conditions'=>array('ShopCart.user_id'=>$user_id)));
		} else {
			// No hay sesión, cargar de cookie si la hay
		}
		exit(0);
	}
	/**
	 * Remover ítems del carrito
	 */
	function removeFromCart() {
		$this->layout="ajax";
		exit(0);
	}
	/**
	 * Pasar a generar la orden con los ítems del carrito
	 */
	function checkoutCart() {
		
	}
	
	/**
	 * Ver el carrito del usuario
	 * -- Si existe sesión entonces mostrar el carrito del usuario
	 * -- Si no hay sesión verificar si hay cookie y mostrar datos acorde
	 * -- Si no hay cookie generar cookie y carrito vacío
	 */
	function viewCart() {
		// Verificar si hay o no sesión abierta
		$shopping_cart = null;
		$user_id = $this->Session->read('Auth.User.id');
		if($user_id) {
			// Hay sesión abierta
			$shopping_cart = $this->ShopCart->find('first', array('conditions'=>array('ShopCart.user_id'=>$user_id)));
		} else {
			// No hay sesión, cargar de cookie si la hay
		}
		$this -> set('shopping_cart', $shopping_cart);
	}
	
	/**
	 * ---------------------------------------------------------------------------------------------
	 * 										CRUD
	 * 	
	 * 						REVISAR QUE METODOS QUEDAN PARA EL FINAL
	 * ---------------------------------------------------------------------------------------------
	 */

	function index() {
		$this -> ShopCart -> recursive = 0;
		$this -> set('shopCarts', $this -> paginate());
	}

	function edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid shop cart', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> ShopCart -> save($this -> data)) {
				$this -> Session -> setFlash(__('The shop cart has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The shop cart could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> ShopCart -> read(null, $id);
		}
		$users = $this -> ShopCart -> User -> find('list');
		$this -> set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for shop cart', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> ShopCart -> delete($id)) {
			$this -> Session -> setFlash(__('Shop cart deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Shop cart was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for shop cart', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> ShopCart -> read(null, $id);
		$oldData["ShopCart"]["active"] = false;
		if ($this -> ShopCart -> save($oldData)) {
			$this -> Session -> setFlash(__('Shop cart archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Shop cart was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for shop cart', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> ShopCart -> read(null, $id);
		$oldData["ShopCart"]["active"] = true;
		if ($this -> ShopCart -> save($oldData)) {
			$this -> Session -> setFlash(__('Shop cart archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Shop cart was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> ShopCart -> find($type, $findParams);
		} else {
			return null;
		}
	}

	function admin_index() {
		$this -> ShopCart -> recursive = 0;
		$this -> set('shopCarts', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid shop cart', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('shopCart', $this -> ShopCart -> read(null, $id));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> ShopCart -> create();
			if ($this -> ShopCart -> save($this -> data)) {
				$this -> Session -> setFlash(__('The shop cart has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The shop cart could not be saved. Please, try again.', true));
			}
		}
		$users = $this -> ShopCart -> User -> find('list');
		$this -> set(compact('users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid shop cart', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> ShopCart -> save($this -> data)) {
				$this -> Session -> setFlash(__('The shop cart has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The shop cart could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> ShopCart -> read(null, $id);
		}
		$users = $this -> ShopCart -> User -> find('list');
		$this -> set(compact('users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for shop cart', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> ShopCart -> delete($id)) {
			$this -> Session -> setFlash(__('Shop cart deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Shop cart was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for shop cart', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> ShopCart -> read(null, $id);
		$oldData["ShopCart"]["active"] = false;
		if ($this -> ShopCart -> save($oldData)) {
			$this -> Session -> setFlash(__('Shop cart archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Shop cart was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for shop cart', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> ShopCart -> read(null, $id);
		$oldData["ShopCart"]["active"] = true;
		if ($this -> ShopCart -> save($oldData)) {
			$this -> Session -> setFlash(__('Shop cart archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Shop cart was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> ShopCart -> find($type, $findParams);
		} else {
			return null;
		}
	}

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 */

	function cesta() {
		$this -> layout = "ajax";
	}

	function checkout() {
		$this -> set('cartContents', $this -> getMiniCart());
	}

	/*
	 Get all item in current session
	 from shopping cart table
	 */
	// This renders the mini cart based on the current session id
	function getMiniCart() {
		return $this -> Cart -> getCartContent($this -> session_id);
	}

	function add() {
		$data = $this -> Inventory -> findById($this -> inventory_id);

		if (is_array($data) && !($data['Inventory']['disponible'] = 1)) {
			$this -> Session -> setFlash('Lo que ha pedido ya no se encuentra en stock');
			$this -> redirect('/');
		}

		// check if the product is already
		// in cart table for this session
		$sessionData = $this -> Cart -> getCart($this -> inventory_id, $this -> session_id);
		if (empty($sessionData)) {
			// put the product in cart table
			$this -> Cart -> addCart($this -> inventory_id, $this -> session_id);
		} else {
			// update product quantity in cart table
			$this -> Cart -> updateCart($this -> inventory_id, $this -> session_id);
		}

		// an extra job for us here is to remove abandoned carts.
		// right now the best option is to call this function here
		$this -> Cart -> cleanUp();
		$this -> redirect($this -> referer());
		//$this -> redirect( array('controller' => 'inventories', 'action' => "view/inventory_id:$this->inventory_id"));
	}

	function ajaxAdd() {

		$product_id = $_POST['product_id'];
		$color_id = $_POST['color_id'];
		$talla_id = $_POST['talla_id'];

		$inventoy_id = $this -> requestAction('/inventories/getInventoryID/' . $product_id . '/' . $color_id . '/' . $talla_id);

		$data = $this -> Inventory -> findById($inventoy_id);

		if (is_array($data) && !($data['Inventory']['disponible'] = 1)) {
			echo false;
			Configure::write("debug", 0);
			$this -> autoRender = false;
			exit(0);
			return;

		}

		// check if the product is already
		// in cart table for this session
		$sessionData = $this -> Cart -> getCart($inventoy_id, $this -> session_id);
		if (empty($sessionData)) {
			// put the product in cart table
			$this -> Cart -> addCart($inventoy_id, $this -> session_id);
		} else {
			// update product quantity in cart table
			$this -> Cart -> updateCart($inventoy_id, $this -> session_id);
		}

		// an extra job for us here is to remove abandoned carts.
		// right now the best option is to call this function here
		$this -> Cart -> cleanUp();

		// $this -> redirect( array('controller' => 'inventories', 'action' => "view/inventory_id:$this->inventory_id"));

		echo true;
		Configure::write("debug", 0);
		$this -> autoRender = false;
		exit(0);
		return;
	}

	function getCart() {
		$carts = $this -> Cart -> find('all', array('conditions' => array('Cart.session_id' => $this -> passedArgs['s']), 'recursive' => 2));
		if (isset($this -> params['requested'])) {
			return $carts;
		}
		$this -> set('carts', $carts);
	}

	function view() {
		$this -> layout = "virtual";
	}

	function remove() {
		$this -> Cart -> emptyBasket($this -> passedArgs['cart_id']);
		$this -> redirect($this -> referer());

		/* if($this -> Cart -> isCartEmpty($this -> session_id)) {
		 $this -> redirect( array('controller' => 'carts', 'action' => 'view'));
		 } else {
		 $this -> redirect( array('controller' => 'inventories', 'action' => 'index'));
		 } */
	}

	function ajaxRemove() {
		$this -> Cart -> emptyBasket($_POST["cart_id"]);
		echo true;
		Configure::write("debug", 0);
		$this -> autoRender = false;
		exit(0);
		return;

	}

	function updates() {
		$this -> Cart -> doUpdate($this -> data['Cart']['cantidad'], $this -> data['Cart']['id']);
		$this -> redirect(array('controller' => 'carts', 'action' => 'view'));
	}
	
	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 */

}
