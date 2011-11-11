<?php
class OrderStatesController extends BcartAppController {

	var $name = 'OrderStates';

	function index() {
		$this -> OrderState -> recursive = 0;
		$this -> set('orderStates', $this -> paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid order state', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('orderState', $this -> OrderState -> read(null, $id));
	}

	function add() {
		if (!empty($this -> data)) {
			$this -> OrderState -> create();
			if ($this -> OrderState -> save($this -> data)) {
				$this -> Session -> setFlash(__('The order state has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The order state could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid order state', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> OrderState -> save($this -> data)) {
				$this -> Session -> setFlash(__('The order state has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The order state could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> OrderState -> read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for order state', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> OrderState -> delete($id)) {
			$this -> Session -> setFlash(__('Order state deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Order state was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for order state', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> OrderState -> read(null, $id);
		$oldData["OrderState"]["active"] = false;
		if ($this -> OrderState -> save($oldData)) {
			$this -> Session -> setFlash(__('Order state archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Order state was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for order state', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> OrderState -> read(null, $id);
		$oldData["OrderState"]["active"] = true;
		if ($this -> OrderState -> save($oldData)) {
			$this -> Session -> setFlash(__('Order state archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Order state was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> OrderState -> find($type, $findParams);
		} else {
			return null;
		}
	}

	function admin_index() {
		$this -> OrderState -> recursive = 0;
		$this -> set('orderStates', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid order state', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('orderState', $this -> OrderState -> read(null, $id));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> OrderState -> create();
			if ($this -> OrderState -> save($this -> data)) {
				$this -> Session -> setFlash(__('The order state has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The order state could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid order state', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> OrderState -> save($this -> data)) {
				$this -> Session -> setFlash(__('The order state has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The order state could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> OrderState -> read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for order state', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> OrderState -> delete($id)) {
			$this -> Session -> setFlash(__('Order state deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Order state was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for order state', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> OrderState -> read(null, $id);
		$oldData["OrderState"]["active"] = false;
		if ($this -> OrderState -> save($oldData)) {
			$this -> Session -> setFlash(__('Order state archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Order state was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for order state', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> OrderState -> read(null, $id);
		$oldData["OrderState"]["active"] = true;
		if ($this -> OrderState -> save($oldData)) {
			$this -> Session -> setFlash(__('Order state archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Order state was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> OrderState -> find($type, $findParams);
		} else {
			return null;
		}
	}

}
