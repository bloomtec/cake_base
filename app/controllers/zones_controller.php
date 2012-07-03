<?php
class ZonesController extends AppController {

	var $name = 'Zones';

	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}
	
	function getZoneCity($zone_id = null) {
		$zone = $this -> Zone -> read(null, $zone_id);
		echo json_encode(
			array(
				$zone['City']['id'] => $zone['City']['name']
			)
		);
		Configure::write('debug', 0);
		$this -> autoRender = false;
		exit(0);
	}
	
	function getZones($city_id = null) {
		$this -> autoRender = false;
		return json_encode($this -> Zone -> find('all', array('conditions' => array('Zone.city_id' => $city_id))));
		exit(0);
	}

	function admin_index() {
		$this -> Zone -> recursive = 0;
		$this -> paginate = array(
			'order' => array(
				'City.name' => 'ASC',
				'Zone.name' => 'ASC'
			)
		);
		$this -> set('zones', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Barrio no válido', true));
			$this -> redirect(array('action' => 'index'));
		}
		$zone = $this -> Zone -> find(
			'first',
			array(
				'conditions' => array('Zone.id' => $id),
				'recursive' => 1
			)
		);
		$this -> set('zone', $zone);
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> Zone -> create();
			if ($this -> Zone -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se registró el barrio', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se puedo guardar el barrio. Por favor, intente de nuevo', true));
			}
		}
		$countries = $this -> Zone -> City -> Country -> find('list');
		$this -> set(compact('countries'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Barrio no válido', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Zone -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se registró el barrio', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se puedo guardar el barrio. Por favor, intente de nuevo', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Zone -> read(null, $id);
		}
		$countries = $this -> Zone -> City -> Country -> find('list');
		$cities = $this -> Zone -> City -> find('list', array('conditions' => array('country_id' => $this -> data['City']['country_id'])));
		$this -> set(compact('countries', 'cities'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('ID de barrio no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Zone -> delete($id)) {
			$this -> Session -> setFlash(__('Barrio eliminado', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('No se eliminó el barrio', true));
		$this -> redirect(array('action' => 'index'));
	}

	function manager_index() {
		$this -> Zone -> recursive = 0;
		$this -> paginate = array(
			'order' => array(
				'City.name' => 'ASC',
				'Zone.name' => 'ASC'
			)
		);
		$this -> set('zones', $this -> paginate());
	}

	function manager_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Barrio no válido', true));
			$this -> redirect(array('action' => 'index'));
		}
		$zone = $this -> Zone -> find(
			'first',
			array(
				'conditions' => array('Zone.id' => $id),
				'recursive' => 1
			)
		);
		$this -> set('zone', $zone);
	}

	function manager_add() {
		if (!empty($this -> data)) {
			$this -> Zone -> create();
			if ($this -> Zone -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se registró el barrio', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se puedo guardar el barrio. Por favor, intente de nuevo', true));
			}
		}
		$countries = $this -> Zone -> City -> Country -> find('list');
		$this -> set(compact('countries'));
	}

	function manager_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Barrio no válido', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Zone -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se registró el barrio', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se puedo guardar el barrio. Por favor, intente de nuevo', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Zone -> read(null, $id);
		}
		$countries = $this -> Zone -> City -> Country -> find('list');
		$cities = $this -> Zone -> City -> find('list', array('conditions' => array('country_id' => $this -> data['City']['country_id'])));
		$this -> set(compact('countries', 'cities'));
	}

	function manager_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('ID de barrio no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Zone -> delete($id)) {
			$this -> Session -> setFlash(__('Barrio eliminado', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('No se eliminó el barrio', true));
		$this -> redirect(array('action' => 'index'));
	}

}
