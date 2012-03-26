<?php
class CitiesController extends AppController {

	var $name = 'Cities';

	function getZones($id) {
		echo json_encode($this -> City -> Zone -> find('list', array('conditions' => array('city_id' => $id))));
		Configure::write('debug', 0);
		$this -> autoRender = false;
		exit(0);
	}

	function index() {
		$this -> City -> recursive = 0;
		$this -> set('cities', $this -> paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Ciudad no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('city', $this -> City -> read(null, $id));
	}

	function admin_index() {
		$this -> City -> recursive = 0;
		$this -> set('cities', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Ciudad no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		$city = $this -> City -> find('first', array('recursive' => 2, 'conditions' => array('City.id' => $id)));
		$this -> set('city', $city);
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> City -> create();
			if ($this -> City -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se guardó la ciudad', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar la ciudad. Por favor, intente de nuevo.', true));
			}
		}
		$countries = $this -> City -> Country -> find('list');
		$this -> set(compact('countries'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Ciudad no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> City -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se guardó la ciudad', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar la ciudad. Por favor, intente de nuevo.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> City -> read(null, $id);
		}
		$countries = $this -> City -> Country -> find('list');
		$this -> set(compact('countries'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('ID de ciudad no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> City -> delete($id)) {
			$this -> Session -> setFlash(__('Ciudad eliminada', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('No se eliminó la ciudad', true));
		$this -> redirect(array('action' => 'index'));
	}

	function manager_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Ciudad no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		$city = $this -> City -> find('first', array('recursive' => 2, 'conditions' => array('City.id' => $id)));
		$this -> set('city', $city);
	}

}
