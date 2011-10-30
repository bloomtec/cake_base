<?php
class ShopCartItemsController extends BcartAppController {

	var $name = 'ShopCartItems';

	function index() {
		$this -> ShopCartItem -> recursive = 0;
		$this -> set('shopCartItems', $this -> paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid shop cart item', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('shopCartItem', $this -> ShopCartItem -> read(null, $id));
	}

	function add() {
		if (!empty($this -> data)) {
			$this -> ShopCartItem -> create();
			if ($this -> ShopCartItem -> save($this -> data)) {
				$this -> Session -> setFlash(__('The shop cart item has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The shop cart item could not be saved. Please, try again.', true));
			}
		}
		$shopCarts = $this -> ShopCartItem -> ShopCart -> find('list');
		$this -> set(compact('shopCarts'));
	}

	function edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid shop cart item', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> ShopCartItem -> save($this -> data)) {
				$this -> Session -> setFlash(__('The shop cart item has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The shop cart item could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> ShopCartItem -> read(null, $id);
		}
		$shopCarts = $this -> ShopCartItem -> ShopCart -> find('list');
		$this -> set(compact('shopCarts'));
	}

	function delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for shop cart item', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> ShopCartItem -> delete($id)) {
			$this -> Session -> setFlash(__('Shop cart item deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Shop cart item was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for shop cart item', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> ShopCartItem -> read(null, $id);
		$oldData["ShopCartItem"]["active"] = false;
		if ($this -> ShopCartItem -> save($oldData)) {
			$this -> Session -> setFlash(__('Shop cart item archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Shop cart item was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for shop cart item', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> ShopCartItem -> read(null, $id);
		$oldData["ShopCartItem"]["active"] = true;
		if ($this -> ShopCartItem -> save($oldData)) {
			$this -> Session -> setFlash(__('Shop cart item archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Shop cart item was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> ShopCartItem -> find($type, $findParams);
		} else {
			return null;
		}
	}

	function admin_index() {
		$this -> ShopCartItem -> recursive = 0;
		$this -> set('shopCartItems', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid shop cart item', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('shopCartItem', $this -> ShopCartItem -> read(null, $id));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> ShopCartItem -> create();
			if ($this -> ShopCartItem -> save($this -> data)) {
				$this -> Session -> setFlash(__('The shop cart item has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The shop cart item could not be saved. Please, try again.', true));
			}
		}
		$shopCarts = $this -> ShopCartItem -> ShopCart -> find('list');
		$this -> set(compact('shopCarts'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid shop cart item', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> ShopCartItem -> save($this -> data)) {
				$this -> Session -> setFlash(__('The shop cart item has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The shop cart item could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> ShopCartItem -> read(null, $id);
		}
		$shopCarts = $this -> ShopCartItem -> ShopCart -> find('list');
		$this -> set(compact('shopCarts'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for shop cart item', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> ShopCartItem -> delete($id)) {
			$this -> Session -> setFlash(__('Shop cart item deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Shop cart item was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for shop cart item', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> ShopCartItem -> read(null, $id);
		$oldData["ShopCartItem"]["active"] = false;
		if ($this -> ShopCartItem -> save($oldData)) {
			$this -> Session -> setFlash(__('Shop cart item archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Shop cart item was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for shop cart item', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> ShopCartItem -> read(null, $id);
		$oldData["ShopCartItem"]["active"] = true;
		if ($this -> ShopCartItem -> save($oldData)) {
			$this -> Session -> setFlash(__('Shop cart item archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Shop cart item was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> ShopCartItem -> find($type, $findParams);
		} else {
			return null;
		}
	}

}
