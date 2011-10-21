<?php
class OrderItemsController extends AppController {

	var $name = 'OrderItems';

	function index() {
		$this -> OrderItem -> recursive = 0;
		$this -> set('orderItems', $this -> paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid order item', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('orderItem', $this -> OrderItem -> read(null, $id));
	}

	function add() {
		if (!empty($this -> data)) {
			$this -> OrderItem -> create();
			if ($this -> OrderItem -> save($this -> data)) {
				$this -> Session -> setFlash(__('The order item has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The order item could not be saved. Please, try again.', true));
			}
		}
		$orders = $this -> OrderItem -> Order -> find('list');
		$this -> set(compact('orders'));
	}

	function edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid order item', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> OrderItem -> save($this -> data)) {
				$this -> Session -> setFlash(__('The order item has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The order item could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> OrderItem -> read(null, $id);
		}
		$orders = $this -> OrderItem -> Order -> find('list');
		$this -> set(compact('orders'));
	}

	function delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for order item', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> OrderItem -> delete($id)) {
			$this -> Session -> setFlash(__('Order item deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Order item was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for order item', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> OrderItem -> read(null, $id);
		$oldData["OrderItem"]["active"] = false;
		if ($this -> OrderItem -> save($oldData)) {
			$this -> Session -> setFlash(__('Order item archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Order item was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for order item', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> OrderItem -> read(null, $id);
		$oldData["OrderItem"]["active"] = true;
		if ($this -> OrderItem -> save($oldData)) {
			$this -> Session -> setFlash(__('Order item archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Order item was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> OrderItem -> find($type, $findParams);
		} else {
			return null;
		}
	}

	function admin_index() {
		$this -> OrderItem -> recursive = 0;
		$this -> set('orderItems', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid order item', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('orderItem', $this -> OrderItem -> read(null, $id));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> OrderItem -> create();
			if ($this -> OrderItem -> save($this -> data)) {
				$this -> Session -> setFlash(__('The order item has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The order item could not be saved. Please, try again.', true));
			}
		}
		$orders = $this -> OrderItem -> Order -> find('list');
		$this -> set(compact('orders'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid order item', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> OrderItem -> save($this -> data)) {
				$this -> Session -> setFlash(__('The order item has been saved', true));
				$this -> redirect(array('controller'=>'orders', 'action' => 'view', $this->data['OrderItem']['order_id']));
			} else {
				$this -> Session -> setFlash(__('The order item could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> OrderItem -> read(null, $id);
		}
		$orders = $this -> OrderItem -> Order -> find('list', array('conditions'=>array('Order.id'=>$this->data['OrderItem']['order_id'])));
		$this -> set(compact('orders'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for order item', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> OrderItem -> delete($id)) {
			$this -> Session -> setFlash(__('Order item deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Order item was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for order item', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> OrderItem -> read(null, $id);
		$oldData["OrderItem"]["active"] = false;
		if ($this -> OrderItem -> save($oldData)) {
			$this -> Session -> setFlash(__('Order item archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Order item was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for order item', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> OrderItem -> read(null, $id);
		$oldData["OrderItem"]["active"] = true;
		if ($this -> OrderItem -> save($oldData)) {
			$this -> Session -> setFlash(__('Order item archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Order item was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> OrderItem -> find($type, $findParams);
		} else {
			return null;
		}
	}

}
