<?php
class InventoriesController extends AppController {

	var $name = 'Inventories';

	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
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
				$this -> Session -> setFlash(__('The inventory has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The inventory could not be saved. Please, try again.', true));
			}
		}
		$products = $this -> Inventory -> Product -> find('list');
		$this -> set(compact('products'));
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
		$this -> set(compact('products'));
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
	
	function admin_listProductInventory($product_id = null) {
		if ($product_id) {
			if (!empty($this -> data)) {
				/**
				 * Actualizar Inventario
				 */
				foreach($this->data['Inventory'] as $product_id=>$value) {
					// Encontrar el inventario
					$inventory = $this->Inventory->find(
						'first',
						array(
							'recursive'=>-1,
							'conditions'=>array('Inventory.product_id' => $product_id)
						)
					);
					// Revisar si se encontro el inventario
					if(!empty($inventory)) {
						$old_value = (int) $inventory['Inventory']['quantity'];
						$change = (int) $value;
						// Hacer la suma con la nueva cantidad y validar que no sea menor a 0 el resultado
						if(($new_value = $old_value + $change) >= 0) {
							$inventory['Inventory']['quantity']=$new_value;
							// Si se salva el inventario crear el seguimiento
							if($this->Inventory->save($inventory)){
								$this -> Inventory -> InventoryMovement -> create();
								$this -> Inventory -> InventoryMovement -> set('user_id', $this -> Session -> read('Auth.User.id'));
								$this -> Inventory -> InventoryMovement -> set('inventory_id', $inventory['Inventory']['id']);
								$this -> Inventory -> InventoryMovement -> set('old_quantity', $old_value);
								$this -> Inventory -> InventoryMovement -> set('new_quantity', $new_value);
								$this -> Inventory -> InventoryMovement -> set('user_id', $this->Session->read('Auth.User.id'));
								$this -> Inventory -> InventoryMovement -> set('comment', $this->data['Inventory']['comment']);
								$this -> Inventory -> InventoryMovement -> save();
								$this -> Session -> setFlash(__('The inventory has been updated.', true));
								
							} else {
								$this -> Session -> setFlash(__("There was an error updating the inventory. Please, try again", true));
							}
						} else {
							$this -> Session -> setFlash(__("The new quantity can't be less than 0. Please, try again.", true));
						}
					}
				}
			}
			$this -> paginate = array('recursive' => 0, 'limit' => 20, 'conditions' => array('Inventory.product_id' => $product_id));
			$inventory = $this -> paginate('Inventory');
			$product = $this -> Inventory -> Product -> findById($product_id);
			$this -> set(compact('product', 'inventory'));
		} else {
			// TODO : ¿Qué hacer en caso de que se entre aquí?
			$this->redirect('/');
		}
	}

}
