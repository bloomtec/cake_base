<?php
class RestaurantsController extends AppController {

	var $name = 'Restaurants';

	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}

	private function isManager($restaurant_id = null) {
		if ($restaurant_id) {
			$restaurant = $this -> Restaurant -> read(null, $restaurant_id);
			return ($this -> Session -> read('Auth.User.id') == $restaurant['Restaurant']['manager_id']);
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
			$this -> Session -> setFlash(__('Invalid restaurant', true));
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
			$this -> Session -> setFlash(__('Invalid restaurant', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('restaurant', $this -> Restaurant -> read(null, $id));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> data['Owner']['password'] = $this -> Auth -> password($this -> data['Owner']['password']);
			// $this -> Restaurant -> create();
			// if ($this -> Restaurant -> save($this -> data)) {
			if($this -> Restaurant -> saveAll($this -> data)) {
				$this -> Session -> setFlash(__('The restaurant has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The restaurant could not be saved. Please, try again.', true));
			}
		}
		//$zones = $this->Restaurant->Zone->find('list');
		//$cities = $this->Restaurant->Zone->City->find('list');
		$countries = $this -> Restaurant -> Zone -> City -> Country -> find('list', array('conditions' => array('is_present' => true)));
		$this -> set(compact('countries'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid restaurant', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Restaurant -> save($this -> data)) {
				$this -> Session -> setFlash(__('The restaurant has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The restaurant could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Restaurant -> read(null, $id);
		}
		$city = $this -> Restaurant -> Zone -> City -> read(null, $this -> data['Zone']['city_id']);
		$cities = $this -> Restaurant -> Zone -> City -> find('list', array('conditions' => array('country_id' => $city['Country']['id'])));
		$zones = $this -> Restaurant -> Zone -> find('list', array('conditions' => array('city_id' => $city['City']['id'])));
		$countries = $this -> Restaurant -> Zone -> City -> Country -> find('list');
		$this -> set(compact('zones', 'cities', 'countries', 'city'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for restaurant', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Restaurant -> delete($id)) {
			$this -> Session -> setFlash(__('Restaurant deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Restaurant was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function manager_index() {
		$this -> Restaurant -> recursive = 0;
		$this -> paginate = array('conditions' => array('Restaurant.manager_id' => $this -> Session -> read('Auth.User.id')));
		$this -> set('restaurants', $this -> paginate());
	}

	function manager_view($id = null) {
		if (!$id || !$this -> isManager($id)) {
			$this -> Session -> setFlash(__('Invalid restaurant', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('restaurant', $this -> Restaurant -> read(null, $id));
	}

	function manager_add() {
		if (!empty($this -> data)) {
			$this -> Restaurant -> create();
			$this -> data['Restaurant']['manager_id'] = $this -> Auth -> user('id');
			if ($this -> Restaurant -> save($this -> data)) {
				$this -> Session -> setFlash(__('The restaurant has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The restaurant could not be saved. Please, try again.', true));
			}
		}
		$this -> loadModel('User');
		$manager = $this -> User -> read(null, $this -> Session -> read('Auth.User.id'));
		$zones = $this -> Restaurant -> Zone -> find('list', array('City.id' => $manager['User']['city_id']));
		$this -> set(compact('zones'));
	}

	function manager_edit($id = null) {
		if ((!$id && empty($this -> data)) || !$this -> isManager($id)) {
			$this -> Session -> setFlash(__('Invalid restaurant', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data) && $this -> isManager($this -> data['Restaurant']['id'])) {
			if ($this -> Restaurant -> save($this -> data)) {
				$this -> Session -> setFlash(__('The restaurant has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The restaurant could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Restaurant -> read(null, $id);
		}
		$this -> loadModel('User');
		$manager = $this -> User -> read(null, $this -> Session -> read('Auth.User.id'));
		$zones = $this -> Restaurant -> Zone -> find('list', array('City.id' => $manager['User']['city_id']));
		$this -> set(compact('zones'));
	}

	function manager_delete($id = null) {
		if (!$id || !$this -> isManager($id)) {
			$this -> Session -> setFlash(__('Invalid id for restaurant', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Restaurant -> delete($id)) {
			$this -> Session -> setFlash(__('Restaurant deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Restaurant was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

}
