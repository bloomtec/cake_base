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
		/**
		 * Se debe verificar si hay o no sesión de usuario.
		 */
	}
	/**
	 * Remover ítems del carrito
	 */
	function removeFromCart() {
		
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
		$this -> set('shopCart', $this -> ShopCart -> read(null, $id));
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

	function add() {
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

}
