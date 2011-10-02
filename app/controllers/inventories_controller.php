<?php
class InventoriesController extends AppController {

	var $name = 'Inventories';
	
	function admin_listInventory() {
		$this -> Inventory -> recursive = 0;
		$this -> set('inventories', $this -> paginate());
	}

	function index() {
		$this -> Inventory -> recursive = 0;
		$this -> set('inventories', $this -> paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid inventory', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('inventory', $this -> Inventory -> read(null, $id));
	}

	function add() {
		if (!empty($this -> data)) {
			$this -> Inventory -> create();
			if ($this -> Inventory -> save($this -> data)) {
				$this -> Session -> setFlash(__('The inventory has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The inventory could not be saved. Please, try again.', true));
			}
		}
		$products = $this -> Inventory -> Product -> find('list');
		$sizes = $this -> Inventory -> Size -> find('list');
		$this -> set(compact('products', 'sizes'));
	}

	function edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid inventory', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Inventory -> save($this -> data)) {
				$this -> Session -> setFlash(__('The inventory has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The inventory could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Inventory -> read(null, $id);
		}
		$products = $this -> Inventory -> Product -> find('list');
		$sizes = $this -> Inventory -> Size -> find('list');
		$this -> set(compact('products', 'sizes'));
	}

	function delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for inventory', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Inventory -> delete($id)) {
			$this -> Session -> setFlash(__('Inventory deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Inventory was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for inventory', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Inventory -> read(null, $id);
		$oldData["Inventory"]["active"] = false;
		if ($this -> Inventory -> save($oldData)) {
			$this -> Session -> setFlash(__('Inventory archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Inventory was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for inventory', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Inventory -> read(null, $id);
		$oldData["Inventory"]["active"] = true;
		if ($this -> Inventory -> save($oldData)) {
			$this -> Session -> setFlash(__('Inventory archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Inventory was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> Inventory -> find($type, $findParams);
		} else {
			return null;
		}
	}

	function admin_index() {
		$this -> Inventory -> recursive = 0;
		$this -> set('inventories', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid inventory', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('inventory', $this -> Inventory -> read(null, $id));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> Inventory -> create();
			if ($this -> Inventory -> save($this -> data)) {
				$inventory = $this->Inventory->read(null, $this->Inventory->id);
				$this->Inventory->InventoryAudit->create();
				$this->Inventory->InventoryAudit->set('user_id', $this->Session->read('Auth.User.id'));
				$this->Inventory->InventoryAudit->set('inventory_id', $inventory['Inventory']['id']);
				$this->Inventory->InventoryAudit->set('new_value', $inventory['Inventory']['quantity']);
				$this->Inventory->InventoryAudit->set('value_change', $inventory['Inventory']['quantity']);
				$this->Inventory->InventoryAudit->save();
				$this -> Session -> setFlash(__('The inventory has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The inventory could not be saved. Please, try again.', true));
			}
		}
		$products = $this -> Inventory -> Product -> find('list');
		$sizes = $this -> Inventory -> Size -> find('list');
		$this -> set(compact('products', 'sizes'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid inventory', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Inventory -> save($this -> data)) {
				$this -> Session -> setFlash(__('The inventory has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The inventory could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Inventory -> read(null, $id);
		}
		$products = $this -> Inventory -> Product -> find('list');
		$sizes = $this -> Inventory -> Size -> find('list');
		$this -> set(compact('products', 'sizes'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for inventory', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Inventory -> delete($id)) {
			$this -> Session -> setFlash(__('Inventory deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Inventory was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for inventory', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Inventory -> read(null, $id);
		$oldData["Inventory"]["active"] = false;
		if ($this -> Inventory -> save($oldData)) {
			$this -> Session -> setFlash(__('Inventory archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Inventory was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for inventory', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Inventory -> read(null, $id);
		$oldData["Inventory"]["active"] = true;
		if ($this -> Inventory -> save($oldData)) {
			$this -> Session -> setFlash(__('Inventory archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Inventory was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> Inventory -> find($type, $findParams);
		} else {
			return null;
		}
	}

}
