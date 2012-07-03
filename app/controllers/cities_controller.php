<?php
class CitiesController extends AppController {

	var $name = 'Cities';
	
	function getCityCountry($city_id = null) {
		$city = $this -> City -> read(null, $city_id);
		echo json_encode(
			array(
				$city['Country']['id'] => $city['Country']['name']
			)
		);
		Configure::write('debug', 0);
		$this -> autoRender = false;
		exit(0);
	}

	function getZones($id=null) {
		if($id){
			// corrección de bug
			$zones = $this -> City -> Zone -> find('all', array('recursive' => -1, 'conditions' => array('city_id' => $id)));
			$list = array();
			foreach ($zones as $key => $zone) {
				$list[$zone['Zone']['id']] = $zone['Zone']['name'];
			}
			echo json_encode($list);
		}else{
			echo json_encode(false);
		}
			
		Configure::write('debug', 0);
		$this -> autoRender = false;
		exit(0);
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
