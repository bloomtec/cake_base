<?php
class ShopCartsController extends AppController {

	var $name = 'ShopCarts';
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(
			'addToCart', 'removeFromCart', 'checkoutCart', 'viewCart', 'getCart',
			'updateShopCartItemQuantity'
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
	 * Encontrar el carrito
	 */
	function getCart() {
		$user_id = $this->Session->read('Auth.User.id');
		$user_agent = $this->Session->_userAgent;
		$shopping_cart = null;
		if($user_id) {
			/**
			 * buscar el carrito con el id de usuario
			 */
			$shopping_cart = $this->ShopCart->find('first', array('conditions'=>array('ShopCart.user_id'=>$user_id)));
		} else {
			/**
			 * buscar el carrito con el userAgent
			 */
			$shopping_cart = $this->ShopCart->find('first', array('conditions'=>array("ShopCart.user_agent"=>$user_agent)));
		}
		return $shopping_cart;
	}
	
	/**
	 * Añadir ítems al carrito
	 **/
	function addToCart() {
		$this->layout="ajax";
		$shopping_cart = $this->getCart();
		$cart_id = -1;
		if(empty($shopping_cart)) {
			// Crear un carrito porque no lo hay
			$this->ShopCart->create();
			if($user_id=$this->Session->read('Auth.User.id')) {
				$this->ShopCart->set('user_id', $user_id);
			} else {
				$this->ShopCart->set('user_agent', $this->Session->_userAgent);
			}
			if($this->ShopCart->save()){
				// Se creo el carrito, guardar la info
				$cart_id=$this->ShopCart->id;				
			} else {
				// No se creo el carrito, retornar algo
				echo false;
			}
		} else {
			$cart_id=$shopping_cart['ShopCart']['id'];
		}
		// Verificar si el ítem ya esta dentro del carrito
		$cart_item = $this->ShopCart->ShopCartItem->find(
			'first',
			array(
				'conditions'=>array(
					'ShopCartItem.shop_cart_id'=>$cart_id,
					'ShopCartItem.foreign_key'=>$this->data['ShopCartItem']['foreign_key'],
					'ShopCartItem.is_gift'=>$this->data['ShopCartItem']['is_gift'],
					'ShopCartItem.size_id'=>$this->data['ShopCartItem']['size_id']
				)
			)
		);
		if($cart_item) {
			$cart_item['ShopCartItem']['quantity'] = $cart_item['ShopCartItem']['quantity'] + 1;
			if($this->ShopCart->ShopCartItem->save($cart_item)) {
				echo json_encode($cart_item);
			} else {
				echo false;
			}
		} else {
			// No está el ítem
			$this->ShopCart->ShopCartItem->create();
			$this->data['ShopCartItem']['shop_cart_id'] = $cart_id;
			if($this->ShopCart->ShopCartItem->save($this->data)) {
				 echo json_encode($cart_item);
			} else {
				echo false;
			}
		}
		exit(0);
	}
	
	/**
	 * Remover ítems del carrito
	 */
	function removeFromCart() {
		$this->layout="ajax";
		$item_id = null; // Definir como llega el id del ítem
		$shopping_cart = $this->getCart();
		if(empty($shopping_cart)) {
			// No hay carrito; hacer algo?
		} else {
			// Hay carrito, borrar el ítem acorde su id
			$this->ShopCart->ShopCartItem->delete($item_id);
		}
		exit(0);
	}
	
	/**
	 * Actualizar la cantidad de un ítem
	 */
	function updateShopCartItemQuantity() {
		$item_id = null; // Definir como llega el id del ítem
		$this->ShopCart->ShopCartItem->read(null, $item_id);
		$this -> Cart -> doUpdate($this -> data['Cart']['cantidad'], $this -> data['Cart']['id']);
		$this -> redirect(array('controller' => 'carts', 'action' => 'view'));
	}
	
	/**
	 * Pasar a generar la orden con los ítems del carrito
	 */
	function checkoutCart() {
		$this->layout="ajax";
		$shopping_cart = $this->getCart();
		if(empty($shopping_cart)) {
			// No hay carrito; hacer algo?
		} else {
			// Hay carrito, crear la orden
			$this->requestAction('orders/createOrder/'.$shopping_cart['ShopCart']['id']);
		}
		exit(0);
	}
	
	function viewCart() {
		$this->layout='carrito';
		$shopping_cart = $this->getCart();
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

}
