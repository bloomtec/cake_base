<?php
class InventoriesController extends AppController {

	var $name = 'Inventories';

	function listProductIDs($size_id) {
		return $this -> Inventory -> find('list', array('fields' => array('Inventory.product_id'), 'conditions' => array('Inventory.quantity >' => 0, 'Inventory.size_id' => $size_id)));
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

	function admin_listProductInventory($product_id = null) {
		if ($product_id) {
			if (!empty($this -> data)) {
				if ($this->params['named']['update']) {
					/**
					 * Actualizar Inventario
					 */
					foreach($this->data['Inventory'] as $key=>$data) {
						if($data) {
							$prod_id_size_id = split(",", $key);
							$inventory = $this->Inventory->find('first', array('recursive'=>-1, 'conditions'=>array('Inventory.product_id'=>$prod_id_size_id[0], 'Inventory.size_id'=>$prod_id_size_id[1])));
							$value = (int)($data);
							$old_value = (int)$inventory['Inventory']['quantity'];
							if(($new_value = $old_value + $value) >= 0) {
								$inventory['Inventory']['quantity']=$new_value;
								if($this->Inventory->save($inventory)){
									$inventory = $this -> Inventory -> read(null, $this -> Inventory -> id);
									$this -> Inventory -> InventoryAudit -> create();
									$this -> Inventory -> InventoryAudit -> set('user_id', $this -> Session -> read('Auth.User.id'));
									$this -> Inventory -> InventoryAudit -> set('inventory_id', $inventory['Inventory']['id']);
									$this -> Inventory -> InventoryAudit -> set('old_value', $old_value);
									$this -> Inventory -> InventoryAudit -> set('new_value', $new_value);
									$this -> Inventory -> InventoryAudit -> save();
									$this -> Session -> setFlash(__('Se modificó el inventario.', true));
								}
							} else {
								$this -> Session -> setFlash(__('Está intentando restar más ítems de los que actualmente hay en uno o más campos. Revise cuidadosamente los datos e intente de nuevo.', true));
							}
						}
					}					
				} else {
					/**
					 * Añadir Inventario
					 * 1. Verificar que no exista ya el inventario
					 * 2. Guardar
					 */
					$inventory = $this->Inventory->find('first', array('conditions'=>array('Inventory.product_id'=>$product_id, 'Inventory.size_id'=>$this->data['Inventory']['size_id'])));
					if(empty($inventory)) {
						/**
						 * No existe el inventario, crearlo
						 */
						$this -> Inventory -> create();
						if ($this -> Inventory -> save($this -> data)) {
							$inventory = $this -> Inventory -> read(null, $this -> Inventory -> id);
							$this -> Inventory -> InventoryAudit -> create();
							$this -> Inventory -> InventoryAudit -> set('user_id', $this -> Session -> read('Auth.User.id'));
							$this -> Inventory -> InventoryAudit -> set('inventory_id', $inventory['Inventory']['id']);
							$this -> Inventory -> InventoryAudit -> set('old_value', 0);
							$this -> Inventory -> InventoryAudit -> set('new_value', $inventory['Inventory']['quantity']);
							$this -> Inventory -> InventoryAudit -> save();
							$this -> Session -> setFlash(__('Se añadió el inventario.', true));
						} else {
							$this -> Session -> setFlash(__('Error al añadir el inventario, intente de nuevo', true));
						}
					} else {
						/**
						 * Existe el inventario
						 */
						$this -> Session -> setFlash(__('Esta talla ya existe en inventario para el producto. Intente agregar otra talla o modifique la cantidad de producto para esta talla.', true));
					}
				}
			}
			$this -> paginate = array('recursive' => 0, 'limit' => 20, 'conditions' => array('Inventory.product_id' => $product_id));
			$inventory = $this -> paginate('Inventory');
			$product = $this -> Inventory -> Product -> findById($product_id);
			$size_id = $this -> Inventory -> Size -> find('list');
			foreach ($size_id as $key => $val) {
				$size_id[$key] = $this -> requestAction('/size_references/getSize/' . $val);
			}
			$this -> set(compact('product', 'inventory', 'size_id'));
		} else {
			// TODO : ¿Qué hacer en caso de que se entre aquí?
			$this->redirect('/');
		}
	}

	function admin_addInventory($product_id) {
		if (!empty($this -> data)) {
			$this -> Inventory -> create();
			if ($this -> Inventory -> save($this -> data)) {
				$inventory = $this -> Inventory -> read(null, $this -> Inventory -> id);
				$this -> Inventory -> InventoryAudit -> create();
				$this -> Inventory -> InventoryAudit -> set('user_id', $this -> Session -> read('Auth.User.id'));
				$this -> Inventory -> InventoryAudit -> set('inventory_id', $inventory['Inventory']['id']);
				$this -> Inventory -> InventoryAudit -> set('old_value', 0);
				$this -> Inventory -> InventoryAudit -> set('new_value', $inventory['Inventory']['quantity']);
				$this -> Inventory -> InventoryAudit -> save();
				$this -> Session -> setFlash(__('Se añadió el inventario.', true));
				$this -> redirect(array('action' => 'listProductInventory'));
			} else {
				$this -> Session -> setFlash(__('No se pudo añadir el inventario, intente de nuevo.', true));
			}
		}
		$products = $this -> Inventory -> Product -> find('list');
		$sizes = $this -> Inventory -> Size -> find('list');
		$this -> set(compact('products', 'sizes'));
		$this -> set('product', $this -> Inventory -> Product -> findById($product_id));
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
