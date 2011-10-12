<?php
class OrdersController extends AppController {

	var $name = 'Orders';

	function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> allow(
			'confirmarPagosOnline', 'callBackPagosOnline', 'createOrder', 'removeFromOrder',
			'payOrder', 'getAddressInfo'
		);
	}

	/**
	 * ----------------------------------------------------------------------------------------------------
	 * 											PAGOS ONLINE
	 *
	 * 							METODOS DE CONFIRMACIÓN DE PAGO Y CALLBACK
	 * ----------------------------------------------------------------------------------------------------
	 */

	function confirmarPagosOnline() {

	}

	function callBackPagosOnline() {

	}

	/**
	 * ----------------------------------------------------------------------------------------------------
	 * 									METODOS PARA MANEJO DE ORDENES
	 * ----------------------------------------------------------------------------------------------------
	 */
	
	/**
	 * Generar la orden como tal
	 */
	function createOrder($shop_cart = null, $data = null) {
		if($shop_cart) {
			/**
			 * Datos de la orden
			 */
			
			// Código de la orden
			$code = $this->Order->find('first', array('fields' => array('MAX(Order.code) as max_code')));
			if($code[0]['max_code']) {
				$code = $code[0]['max_code'] + 1;
			} else {
				$code = "000000001";
			}
			$longitud = strlen($code);
			for ($i = (9 - $longitud); $i > 0; $i--) {
				$code = "0" . $code;
			}
			
			/**
			 * Crear la orden
			 */
			$this->Order->create();
			$this->Order->set('code', $code); // Asignar el código de la orden
			if(!empty($shop_cart['ShopCart']['user_id'])) {
				// Si hay sesión de usuario entonces asignar el id del usuario
				$this->Order->set('user_id', $shop_cart['ShopCart']['user_id']);
			} else {
				// Si no hay sesión asignar el user_agent
				$this->Order->set('user_agent', $shop_cart['ShopCart']['user_agent']);
			}
			$this->Order->set('order_state', 1); // Asignar el estado de la orden
			if(!empty($shop_cart['ShopCart']['coupon_id'])) {
				$this->Order->set('coupon_id', $shop_cart['ShopCart']['coupon_id']);
			}
			if($this->Order->save()) {
				foreach ($shop_cart['ShopCart']['ShopCartItem'] as $key => $cart_item) {
					
				}
			}
		} else {
			
		}
	}
	
	/**
	 * Obtener información de envío
	 */
	function getAddressInfo() {
		$this->layout="carrito";
		$shop_cart = $this->requestAction('/shop_carts/getCart');
		if(!empty($this->data)) {
			$this->createOrder($shop_cart, $this->data);
		}
		$user_id = $this->Session->read('Auth.User.id');
		$user = $this->Order->User->read(null, $user_id);
		$this->set('user', $user);
		$this->set('shop_cart', $shop_cart);
	}

	/**
	 * Remover ítems de la órden
	 */
	function removeFromOrder() {
		
	}

	/**
	 * Pagar la orden
	 */
	function payOrder() {
		
	}

	/**
	 * ----------------------------------------------------------------------------------------------------
	 * 										METODOS CRUD
	 *
	 * 						REVISAR QUE METODOS QUEDAN PARA EL FINAL
	 * ----------------------------------------------------------------------------------------------------
	 */
	function index() {
		$this -> Order -> recursive = 0;
		$this -> set('orders', $this -> paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid order', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('order', $this -> Order -> read(null, $id));
	}

	function add() {
		if (!empty($this -> data)) {
			$this -> Order -> create();
			if ($this -> Order -> save($this -> data)) {
				$this -> Session -> setFlash(__('The order has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The order could not be saved. Please, try again.', true));
			}
		}
		$users = $this -> Order -> User -> find('list');
		$orderStates = $this -> Order -> OrderState -> find('list');
		$this -> set(compact('users', 'orderStates'));
	}

	function edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid order', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Order -> save($this -> data)) {
				$this -> Session -> setFlash(__('The order has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The order could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Order -> read(null, $id);
		}
		$users = $this -> Order -> User -> find('list');
		$orderStates = $this -> Order -> OrderState -> find('list');
		$this -> set(compact('users', 'orderStates'));
	}

	function delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for order', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Order -> delete($id)) {
			$this -> Session -> setFlash(__('Order deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Order was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for order', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Order -> read(null, $id);
		$oldData["Order"]["active"] = false;
		if ($this -> Order -> save($oldData)) {
			$this -> Session -> setFlash(__('Order archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Order was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for order', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Order -> read(null, $id);
		$oldData["Order"]["active"] = true;
		if ($this -> Order -> save($oldData)) {
			$this -> Session -> setFlash(__('Order archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Order was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> Order -> find($type, $findParams);
		} else {
			return null;
		}
	}

	function admin_index() {
		$this -> Order -> recursive = 0;
		$this -> set('orders', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid order', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('order', $this -> Order -> read(null, $id));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> Order -> create();
			if ($this -> Order -> save($this -> data)) {
				$this -> Session -> setFlash(__('The order has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The order could not be saved. Please, try again.', true));
			}
		}
		$users = $this -> Order -> User -> find('list');
		$orderStates = $this -> Order -> OrderState -> find('list');
		$this -> set(compact('users', 'orderStates'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid order', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Order -> save($this -> data)) {
				$this -> Session -> setFlash(__('The order has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The order could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Order -> read(null, $id);
		}
		$users = $this -> Order -> User -> find('list');
		$orderStates = $this -> Order -> OrderState -> find('list');
		$this -> set(compact('users', 'orderStates'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for order', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Order -> delete($id)) {
			$this -> Session -> setFlash(__('Order deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Order was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for order', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Order -> read(null, $id);
		$oldData["Order"]["active"] = false;
		if ($this -> Order -> save($oldData)) {
			$this -> Session -> setFlash(__('Order archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Order was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for order', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Order -> read(null, $id);
		$oldData["Order"]["active"] = true;
		if ($this -> Order -> save($oldData)) {
			$this -> Session -> setFlash(__('Order archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Order was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> Order -> find($type, $findParams);
		} else {
			return null;
		}
	}

}