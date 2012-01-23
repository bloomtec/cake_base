<?php
class DealsController extends AppController {

	var $name = 'Deals';

	function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> allow('getDeals');
	}

	function getDeals() {
		return $this -> Deal -> find('all');
	}

	private function getRestaurants() {
		return $this -> Deal -> Restaurant -> find('list', array('fields' => array('Restaurant.id'), 'conditions' => array('Restaurant.manager_id' => $this -> Session -> read('Auth.User.id'))));
	}
	
	private function getALargeImage() {
		$this->recursive=-1;
		$deal = $this->Deal->find('all', array('order'=>'rand()', 'conditions'=>array('Deal.image_large <>'=>null,'Deal.image_large <>'=>'')));
		return $deal; 
	}

	function index() {
		$this -> Deal -> recursive = 0;
		$cities = $this -> requestAction('/cities/getList');

		$city = $price = $zone = $cuisine = null;
		if (isset($this -> params['named']['city']) && !empty($this -> params['named']['city'])) {
			$city = $this -> params['named']['city'];
		} else {
			$city = key($cities);
		}

		if (isset($this -> params['named']['zone']) && !empty($this -> params['named']['zone'])) {
			$zone = $this -> params['named']['zone'];
		}
		if (isset($this -> params['named']['cuisine']) && !empty($this -> params['named']['cuisine'])) {
			$cuisine = $this -> params['named']['cuisine'];
		}
		if (isset($this -> params['named']['price']) && !empty($this -> params['named']['price'])) {
			$price = $this -> params['named']['price'];
		}
		$this -> paginate = $this -> Deal -> filter($city, $zone, $cuisine, $price);

		$this -> set('deals', $this -> paginate());

		$this->set('large_images', $this->getALargeImage());
		$zones = $this -> Deal -> Restaurant -> Zone -> find('list', array('conditions' => array('Zone.city_id' => $city)));
		$cuisines = $this -> requestAction('/cuisines/getList');
		$prices = array('ASC' => __('lowest to highest', true), 'DESC' => __('highest to lowest', true));
		$this -> set(compact('cities', 'zones', 'cuisines', 'prices'));
	}

	function view($slug = null) {
		if (!$slug) {
			$this -> Session -> setFlash(__('Invalid deal', true));
			$this -> redirect(array('action' => 'index'));
			$this -> layout = "default";
		}
		$deal = $this -> Deal -> find('first', array('recursive' => 2, array('conditions' => array('Deal.slug' => $slug))));
		$city = $this -> Deal -> Restaurant -> Zone -> City -> findById($deal['Restaurant']['Zone']['city_id']);
		$this -> set('deal', $deal);
		$this -> set('city', $city);
	}

	function admin_index() {
		$this -> Deal -> recursive = 0;
		$this -> set('deals', $this -> paginate());
	}

	function admin_view($slug = null) {
		if (!$slug) {
			$this -> Session -> setFlash(__('Invalid deal', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('deal', $this -> Deal -> findBySlug($slug));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> Deal -> create();
			if ($this -> Deal -> save($this -> data)) {
				$this -> Session -> setFlash(__('The deal has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The deal could not be saved. Please, try again. Image is required. Also, check if the restaurant is being promoted. The large image is required if so.', true));
			}
		}
		$restaurants = $this -> Deal -> Restaurant -> find('list');
		$cuisines = $this -> Deal -> Cuisine -> find('list');
		$this -> set(compact('restaurants', 'cuisines'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid deal', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Deal -> save($this -> data)) {
				$this -> Session -> setFlash(__('The deal has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The deal could not be saved. Please, try again. Image is required. Also, check if the restaurant is being promoted. The large image is required if so.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Deal -> read(null, $id);
		}
		$restaurants = $this -> Deal -> Restaurant -> find('list');
		$cuisines = $this -> Deal -> Cuisine -> find('list');
		$this -> set(compact('restaurants', 'cuisines'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for deal', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Deal -> delete($id)) {
			$this -> Session -> setFlash(__('Deal deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Deal was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function manager_index() {
		$this -> Deal -> recursive = 0;
		$this -> paginate = array('conditions' => array('Deal.restaurant_id' => $this -> getRestaurants()));
		$this -> set('deals', $this -> paginate());
	}

	function manager_view($slug = null) {
		if (!$slug) {
			$this -> Session -> setFlash(__('Invalid deal', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('deal', $this -> Deal -> findBySlug($slug));
	}

	function manager_add() {
		if (!empty($this -> data)) {
			$this -> Deal -> create();
			if ($this -> Deal -> save($this -> data)) {
				$this -> Session -> setFlash(__('The deal has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The deal could not be saved. Please, try again. Image is required. Also, check if the restaurant is being promoted. The large image is required if so.', true));
			}
		}
		$restaurants = $this -> Deal -> Restaurant -> find('list', array('conditions' => array('Restaurant.manager_id' => $this -> Session -> read('Auth.User.id'))));
		$cuisines = $this -> Deal -> Cuisine -> find('list');
		$this -> set(compact('restaurants', 'cuisines'));
	}

	function manager_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid deal', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Deal -> save($this -> data)) {
				$this -> Session -> setFlash(__('The deal has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The deal could not be saved. Please, try again. Image is required. Also, check if the restaurant is being promoted. The large image is required if so.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Deal -> read(null, $id);
		}
		$restaurants = $this -> Deal -> Restaurant -> find('list');
		$cuisines = $this -> Deal -> Cuisine -> find('list');
		$this -> set(compact('restaurants', 'cuisines'));
	}

	function manager_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for deal', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Deal -> delete($id)) {
			$this -> Session -> setFlash(__('Deal deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Deal was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

}
