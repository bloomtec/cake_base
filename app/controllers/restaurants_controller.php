<?php
class RestaurantsController extends AppController {

	var $name = 'Restaurants';

	private function isManager($restaurant_id = null) {
		if ($restaurant_id) {
			$zones = $this -> Restaurant -> Zone -> find('list', array('fields' => array('Zone.id'), 'conditions' => array('Zone.city_id' => $this -> Auth -> user('city_id'))));
			$restaurant = $this -> Restaurant -> find('first', array('conditions' => array('Restaurant.id' => $restaurant_id, 'Restaurant.zone_id' => $zones)));
			if(!empty($restaurant)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	private function isOwner($restaurant_id = null) {
		if ($restaurant_id) {
			$restaurant = $this -> Restaurant -> find('first', array('conditions' => array('Restaurant.id' => $restaurant_id, 'Restaurant.owner_id' => $this -> Auth -> user('id'))));
			if(!empty($restaurant)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function index() {
		$this -> Restaurant -> recursive = 0;
		$this -> set('restaurants', $this -> paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Restaurante no válido', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('restaurant', $this -> Restaurant -> read(null, $id));
	}

	function admin_index() {
		$this -> Restaurant -> recursive = 0;
		$this -> set('restaurants', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Restaurante no válido', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('restaurant', $this -> Restaurant -> read(null, $id));
	}
	
	function zonesByCity($city_id = null, $restaurant_id = null) {
		$this -> layout = 'ajax';
		
		$zones = $this -> Restaurant -> Zone -> find('list', array('conditions' => array('Zone.city_id' => $city_id)));
		
		if($restaurant_id) {
			$restaurant_zones = $this -> Restaurant -> RestaurantsZone -> find('list', array('fields' => array('RestaurantsZone.zone_id'), 'conditions' => array('RestaurantsZone.restaurant_id' => $restaurant_id)));
			$this -> set('restaurant_zones', $restaurant_zones);
		}
		
		$this -> set('zones',$zones);
	}

	function admin_add() {
		if (!empty($this -> data)) {
			if(isset($this -> data['Owner']['password'])) {
				$this -> data['Owner']['password'] = $this -> Auth -> password($this -> data['Owner']['password']);
			}
			if(isset($this -> data['Owner']['id']) && !empty($this -> data['Owner']['id'])) {
				$this -> data['Restaurant']['owner_id'] = $this -> data['Owner']['id'];
				unset($this -> data['Owner']);
			}
			if($this -> Restaurant -> saveAll($this -> data)) {
				$this -> Session -> setFlash(__('Se registró el restaurante', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo registrar el restaurante. Por favor, intente de nuevo.', true));
			}
		}
		$countries = $this -> Restaurant -> Zone -> City -> Country -> find('list', array('conditions' => array('is_present' => true)));
		// $cities = $this->Restaurant->Zone->City->find('list');
		// $zones = $this -> Restaurant -> Zone -> find('list');
		$this -> set(compact('countries'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Restaurante no válido', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Restaurant -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se registró el restaurante', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo registrar el restaurante. Por favor, intente de nuevo.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Restaurant -> read(null, $id);
		}
		$city = $this -> Restaurant -> Zone -> City -> read(null, $this -> data['Zone']['city_id']);
		$cities = $this -> Restaurant -> Zone -> City -> find('list', array('conditions' => array('is_present' => true, 'country_id' => $city['Country']['id'])));
		$zones = $this -> Restaurant -> Zone -> find('list', array('conditions' => array('city_id' => $city['City']['id'])));
		$countries = $this -> Restaurant -> Zone -> City -> Country -> find('list', array('conditions' => array('is_present' => true)));
		$this -> set(compact('zones', 'cities', 'countries', 'city'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('ID de restaurante no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Restaurant -> delete($id)) {
			$this -> Session -> setFlash(__('Se eliminó el restaurante', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('No se eliminó el restaurante', true));
		$this -> redirect(array('action' => 'index'));
	}

	function manager_index() {
		$this -> Restaurant -> recursive = 0;
		$zones = $this -> Restaurant -> Zone -> find('list', array('fields' => array('Zone.id'), 'conditions' => array('Zone.city_id' => $this -> Auth -> user('city_id'))));
		$this -> paginate = array('conditions' => array('Restaurant.zone_id' => $zones));
		$this -> set('restaurants', $this -> paginate());
	}

	function manager_view($id = null) {
		if (!$id || !$this -> isManager($id)) {
			$this -> Session -> setFlash(__('Restaurante no válido', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('restaurant', $this -> Restaurant -> read(null, $id));
	}

	function manager_add() {
		if (!empty($this -> data)) {
			if(isset($this -> data['Owner']['password'])) {
				$this -> data['Owner']['password'] = $this -> Auth -> password($this -> data['Owner']['password']);
			}
			if(isset($this -> data['Owner']['id'])) {
				$this -> data['Restaurant']['owner_id'] = $this -> data['Owner']['id'];
				unset($this -> data['Owner']);
			}
			if($this -> Restaurant -> saveAll($this -> data)) {
				$this -> Session -> setFlash(__('Se registró el restaurante', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo registrar el restaurante. Por favor, intente de nuevo.', true));
			}
		}
		$zones = $this -> Restaurant -> Zone -> find('list', array('conditions' => array('Zone.city_id' => $this -> Auth -> user('city_id'))));
		$this -> set(compact('zones'));
	}

	function manager_edit($id = null) {
		if ((!$id && empty($this -> data)) || !$this -> isManager($id)) {
			$this -> Session -> setFlash(__('Restaurante no válido', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data) && $this -> isManager($this -> data['Restaurant']['id'])) {
			if ($this -> Restaurant -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se registró el restaurante', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo registrar el restaurante. Por favor, intente de nuevo.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Restaurant -> read(null, $id);
		}
		$zones = $this -> Restaurant -> Zone -> find('list', array('conditions' => array('Zone.city_id' => $this -> Auth -> user('city_id'))));
		$this -> set(compact('zones'));
	}

	function manager_delete($id = null) {
		if (!$id || !$this -> isManager($id)) {
			$this -> Session -> setFlash(__('ID de restaurante no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Restaurant -> delete($id)) {
			$this -> Session -> setFlash(__('Se eliminó el restaurante', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('No se eliminó el restaurante', true));
		$this -> redirect(array('action' => 'index'));
	}
	
	function owner_index() {
		$this -> Restaurant -> recursive = 0;
		$restaurants = $this -> Restaurant -> find('list', array('conditions' => array('Restaurant.owner_id' => $this -> Auth -> user('id')), 'fields' => array('Restaurant.id')));
		$this -> paginate = array('conditions' => array('Restaurant.id' => $restaurants));
		$this -> set('restaurants', $this -> paginate());
	}
	
	function owner_view($id = null) {
		if (!$id || !$this -> isOwner($id)) {
			$this -> Session -> setFlash(__('Restaurante no válido', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('restaurant', $this -> Restaurant -> read(null, $id));
	}
	
	function owner_edit($id = null) {
		if ((!$id && empty($this -> data)) || !$this -> isOwner($id)) {
			$this -> Session -> setFlash(__('Restaurante no válido', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data) && $this -> isOwner($this -> data['Restaurant']['id'])) {
			if ($this -> Restaurant -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se registró el restaurante', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo registrar el restaurante. Por favor, intente de nuevo.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Restaurant -> read(null, $id);
		}
	}

}
