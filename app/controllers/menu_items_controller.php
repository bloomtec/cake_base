<?php
class MenuItemsController extends AppController {

	var $name = 'MenuItems';

	function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> allow('getMenuItems');
	}

	function getMenuItems($menu_id = null) {
		if ($menu_id) {
			$menu_items = $this -> MenuItem -> find('all', array('conditions' => array('MenuItem.menu_id' => $menu_id)));
			if (!empty($menu_items)) {
				// Organizar y retornar la estructura
				return $this -> constructMenu($menu_items);
			} else {
				// Manejar cuando no hayan menu items
				return array();
			}
		} else {
			// Manejar cuando no haya un id ingresado
			return array();
		}
	}

	private function constructMenu($menu_items) {
		// El menú a retornar
		$menu = array();

		// Crear un arreglo dentro de cada item en donde asignar los hijos
		foreach ($menu_items as $key => $menu_item) {
			$menu_items[$key]['MenuItem']['children'] = array();
		}

		// Manejar los items que no tienen padre
		foreach ($menu_items as $key => $menu_item) {
			// Ver si el MenuItem tiene padre
			if ($menu_item['MenuItem']['parent_id'] == 0) {
				$menu[count($menu)] = $menu_item;
				unset($menu_items[$key]);
			}
		}

		// Manejar los items restantes
		if (!empty($menu_items)) {
			return $this -> _constructMenu($menu_items, $menu);
		} else {
			return $menu;
		}
	}

	private function _constructMenu($menu_items, $menu) {
		foreach ($menu_items as $key => $menu_item) {
			//Buscar relación con el nivel 0 del menú
			$relacion_encontrada = false;
			foreach ($menu as $key0 => $lvl0_menuItem) {
				if (!$relacion_encontrada && $lvl0_menuItem['MenuItem']['id'] == $menu_item['MenuItem']['parent_id']) {
					$menu[$key0]['MenuItem']['children'][count($menu[$key0]['MenuItem']['children'])] = $menu_item;
					$relacion_encontrada = true;
					break;
				} else {
					// No se encontró relación directa, buscar relación con los hijos si los hay
					if (!empty($lvl0_menuItem['MenuItem']['children'])) {
						foreach ($lvl0_menuItem['MenuItem']['children'] as $key1 => $lvl1_menuItem) {
							if (!$relacion_encontrada && $lvl1_menuItem['MenuItem']['id'] == $menu_item['MenuItem']['parent_id']) {
								$menu[$key0]['MenuItem']['children'][$key1]['MenuItem']['children'][count($menu[$key0]['MenuItem']['children'][$key1]['MenuItem']['children'])] = $menu_item;
								$relacion_encontrada = true;
								break;
							} else {
								if (!empty($lvl1_menuItem['MenuItem']['children'])) {
									foreach ($lvl1_menuItem['MenuItem']['children'] as $key2 => $lvl2_menuItem) {
										if (!$relacion_encontrada && $lvl2_menuItem['MenuItem']['id'] == $menu_item['MenuItem']['parent_id']) {
											$menu[$key0]['MenuItem']['children'][$key1]['MenuItem']['children'][$key2]['MenuItem']['children'][count($menu[$key0]['MenuItem']['children'][$key1]['MenuItem']['children'][$key2]['MenuItem']['children'])] = $menu_item;
											$relacion_encontrada = true;
											break;
										}
									}
								}
							}
						}
					}
				}
			}
			if ($relacion_encontrada) {
				unset($menu_items[$key]);
				break;
			}
		}

		// Manejar los items restantes
		if (!empty($menu_items)) {
			return $this -> _constructMenu($menu_items, $menu);
		} else {
			return $menu;
		}
	}

	function admin_index() {
		$this -> MenuItem -> recursive = 0;
		$this -> set('menuItems', $this -> paginate());

		// Acorde un ejemplo en la web
		$nodelist = $this -> MenuItem -> generatetreelist(null, null, null, " - ");
		$this -> set(compact('nodelist'));
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid menu item', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('menuItem', $this -> MenuItem -> read(null, $id));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> MenuItem -> create();
			if ($this -> MenuItem -> save($this -> data)) {
				$this -> Session -> setFlash(__('The menu item has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The menu item could not be saved. Please, try again.', true));
			}
		}
		$menus = $this -> MenuItem -> Menu -> find('list');
		$this -> set(compact('menus'));
		$parents[0] = "[ No Parent ]";
		$nodelist = $this -> MenuItem -> generatetreelist(null, null, null, " - ");
		if ($nodelist) {
			foreach ($nodelist as $key => $value)
				$parents[$key] = $value;
		}
		$this -> set(compact('parents'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid menu item', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> MenuItem -> save($this -> data)) {
				$this -> Session -> setFlash(__('The menu item has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The menu item could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> MenuItem -> read(null, $id);
		}
		$menus = $this -> MenuItem -> Menu -> find('list');
		$this -> set(compact('menus'));
		$parents[0] = "[ No Parent ]";
		$nodelist = $this -> MenuItem -> generatetreelist(null, null, null, " - ");
		if ($nodelist) {
			foreach ($nodelist as $key => $value)
				$parents[$key] = $value;
		}
		$this -> set(compact('parents'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for menu item', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> MenuItem -> delete($id)) {
			$this -> Session -> setFlash(__('Menu item deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Menu item was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for menu item', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> MenuItem -> read(null, $id);
		$oldData["MenuItem"]["active"] = false;
		if ($this -> MenuItem -> save($oldData)) {
			$this -> Session -> setFlash(__('Menu item archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Menu item was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for menu item', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> MenuItem -> read(null, $id);
		$oldData["MenuItem"]["active"] = true;
		if ($this -> MenuItem -> save($oldData)) {
			$this -> Session -> setFlash(__('Menu item archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Menu item was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> MenuItem -> find($type, $findParams);
		} else {
			return null;
		}
	}

}
