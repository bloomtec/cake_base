<?php
class MenusController extends AppController {

	var $name = 'Menus';
	
	/**
	 * Método de Auth component.
	 * Se declara para permitir el acceso a métodos necesarios
	 * para la correcta funcionalidad del plugin cuando se
	 * utiliza Auth component.
	 */
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('getMenu');
	}
	
	/**
	 * Métdodo para devolver un menu luego de buscarlo por su nombre
	 */
	function getMenu($menu_name = null) {
		if($menu_name) {
			// Obtener el menu con el nombre dado
			$menu = $this->Menu->find('first', array('conditions' => array('Menu.name' => $menu_name), 'recursive' => 0));
			if(!empty($menu)) {
				// Se encontró el menú
				return $menu;
			} else {
				// Manejar cuando no se encuentre un menu con el nombre dado
				return array();
			}
		} else {
			// Manejar cuando no se ingrese un nombre de menu
			return array();
		}
	}

	function admin_index() {
		$this->Menu->recursive = 0;
		$this->set('menus', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid menu', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('menu', $this->Menu->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Menu->create();
			if ($this->Menu->save($this->data)) {
				$this->Session->setFlash(__('The menu has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid menu', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Menu->save($this->data)) {
				$this->Session->setFlash(__('The menu has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Menu->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for menu', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Menu->delete($id)) {
			$this->Session->setFlash(__('Menu deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Menu was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
