<?php
class DealsController extends AppController {

	var $name = 'Deals';

	function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> allow('getDeals', 'addVisitCount');
	}

	function getDeals() {
		return $this -> Deal -> find('all');
	}

	private function getRestaurantsByManager() {
		$zones = $this -> Deal -> Restaurant -> Zone -> find('list', array('fields' => array('Zone.id'), 'conditions' => array('Zone.city_id' => $this -> Auth -> user('city_id'))));
		return $this -> Deal -> Restaurant -> find('list', array('fields' => array('Restaurant.id'), 'conditions' => array('Restaurant.zone_id' => $zones)));
	}

	private function getRestaurantsByOwner() {
		return $this -> Deal -> Restaurant -> find('list', array('fields' => array('Restaurant.id'), 'conditions' => array('Restaurant.owner_id' => $this -> Session -> read('Auth.User.id'))));
	}

	private function getALargeImage() {
		$this -> recursive = -1;
		$deal = $this -> Deal -> find('all', array('order' => 'rand()', 'conditions' => array('Deal.image_large <>' => null, 'Deal.image_large <>' => '')));
		return $deal;
	}
	
	function addVisitCount($id) {
		if($id) {
			$deal = $this -> Deal -> read(null, $id);
			$deal['Deal']['visits'] += 1;
			$this -> Deal -> save($deal);
		}
	}

	function index() {
		
		$this -> Deal -> recursive = 0;
		
		$city = $zone = $cuisine = null;
		
		/**
		 * Armar el filtro de ciudades
		 */
		// Ajuste del filtro de zonas acorde la ciudad
		if(isset($this -> params['named']['city']) && !empty($this -> params['named']['city'])) {
			$city = $this -> params['named']['city'];
		}

		$cities = array();
		$zones = array();
		
		$cities[0] = __('All cities...', true);
		$cities_tmp = $this -> requestAction('/cities/getList');
		foreach($cities_tmp as $key => $city_tmp) {
			$cities[$key] = $city_tmp;
		}
		
		// Ajustar las ciudades para que solamente salgan las que tienen deals
		foreach($cities as $key => $data) {
			if($key) {
				$zonas = $this -> Deal -> Restaurant -> Zone -> find('list', array('fields' => array('Zone.id'), 'conditions' => array('Zone.city_id' => $key)));
				$restaurantes = $this -> Deal -> Restaurant -> find('list', array('fields' => array('Restaurant.id'), 'conditions' => array('Restaurant.zone_id' => $zonas)));
				$promos = $this -> Deal -> find('all', array('conditions' => array('Deal.restaurant_id' => $restaurantes), 'recursive' => -1));
				if(!$promos) unset($cities[$key]);
			}
		}
		
		if(!$city) {
			/**
			 * No hay ciudad seleccionada, ajustar filtros de ciudad y zona acorde
			 */
			$zones[0] = __('All districts...', true);
		} else {
			/**
			 * Hay ciudad seleccionada, ajustar filtros de ciudad y zona acorde
			 */
			$zones[0] = __('All districts...', true);
			$zones_tmp = $this -> Deal -> Restaurant -> Zone -> find('list', array('conditions' => array('Zone.city_id' => $city)));
			foreach($zones_tmp as $key => $data) {
				$zones[$key] = $data;
			}
		}
		
		// Ajustar zonas para que solamente salgan las que tienen deals
		foreach($zones as $key => $data) {
			if($key) {
				$restaurantes = $this -> Deal -> Restaurant -> find('list', array('fields' => array('Restaurant.id'), 'conditions' => array('Restaurant.zone_id' => $key)));
				$promos = $this -> Deal -> find('all', array('conditions' => array('Deal.restaurant_id' => $restaurantes), 'recursive' => -1));
				if(!$promos) unset($zones[$key]);
			}
		}
		
		// Ajuste del filtro de zonas
		if(isset($this -> params['named']['zone']) && !empty($this -> params['named']['zone'])) {
			$zone = $this -> params['named']['zone'];
		}
		
		/**
		 * Armar el filtro de cuisines
		 */
		$cuisines = array();
		$cuisines[0] = __('All cuisines...', true);
		$cuisines_tmp = $this -> requestAction('/cuisines/getList');
		foreach($cuisines_tmp as $key => $cuisine_tmp) {
			$cuisines[$key] = $cuisine_tmp;
		}
		
		// Ajuste del filtro de tipo de comida
		if(isset($this -> params['named']['cuisine']) && !empty($this -> params['named']['cuisine'])) {
			$cuisine = $this -> params['named']['cuisine'];
		} else {
			$cuisine = 0;
		}
		
		// Ajustar para que solamente salgan aquellas "cocinas" que tengan promos
		$promos = $this -> Deal -> find('list', array('fields' => 'Deal.id'));
		if($city && !$zone) {
			$zonas = $this -> Deal -> Restaurant -> Zone -> find('list', array('fields' => array('Zone.id'), 'conditions' => array('Zone.city_id' => $city)));
			$restaurantes = $this -> Deal -> Restaurant -> find('list', array('fields' => array('Restaurant.id'), 'conditions' => array('Restaurant.zone_id' => $zonas)));
			$promos = $this -> Deal -> find('list', array('fields' => 'Deal.id', 'conditions' => array('Deal.restaurant_id' => $restaurantes)));
		} elseif($city && $zone) {
			$restaurantes = $this -> Deal -> Restaurant -> find('list', array('fields' => array('Restaurant.id'), 'conditions' => array('Restaurant.zone_id' => $zone)));
			$promos = $this -> Deal -> find('list', array('fields' => 'Deal.id', 'conditions' => array('Deal.restaurant_id' => $restaurantes)));
		}
		$cocinas_con_promos = $this -> Deal -> CuisinesDeal -> find('list', array('conditions' => array('CuisinesDeal.deal_id' => $promos), 'fields' => array('CuisinesDeal.cuisine_id')));
		foreach($cuisines as $key => $data) {
			if($key && !in_array($key, $cocinas_con_promos)) {
				unset($cuisines[$key]);
			}
		}
		
		/**
		 * Filtro de orden de precios
		 */
		if(!isset($this -> params['named']['city']) || (isset($this -> params['named']['city']) && $this -> params['named']['city'] == 0)) {
			$prices = array(0 => __('No city selected...', true));
		} else {
			$prices = array(0 => __('No range selected...', true));
			$tmp_city = $this -> Deal -> Restaurant -> Zone -> City -> findById($city);
			$country = $this -> Deal -> Restaurant -> Zone -> City -> Country -> findById($tmp_city['City']['country_id']);
			$price_ranges = $country['Country']['price_ranges'];
			$price_ranges = explode(':', $price_ranges);
			foreach($price_ranges as $key => $price_range) {
				$min_max_range = explode('-', $price_range);
				$prices[$price_range] = $country['Country']['money_symbol'] . $min_max_range[0] . ' - ' . $country['Country']['money_symbol'] . $min_max_range[1];
			}
		}
		
		/**
		 * Armar las condiciones para mostrar los deals
		 */
		$conditions = array();
		
		/**
		 * Como condición genérica, solo se deben mostrar aquellas promos que no hayan llegado a su fin de tiempo
		 */
		$now = new DateTime('now');
		$conditions['Deal.expires >'] = $now -> format('Y-m-d H:i:s');
		
		if($city && !$zone) {
			/**
			 * Solo se ha seleccionado ciudad
			 * Mostrar solamente los restaurantes acorde a la ciudad seleccionada
			 */
			$search_zones = $this -> Deal -> Restaurant -> Zone -> find('list', array('fields' => array('Zone.id'), 'conditions' => array('Zone.city_id' => $city)));
			$restaurants = $this -> Deal -> Restaurant -> find(
				'list',
				array(
					'fields' => array('Restaurant.id'),
					'conditions' => array(
						'Restaurant.zone_id' => $search_zones
					)
				)
			);
			$conditions['Deal.restaurant_id'] = $restaurants;
		} elseif($city && $zone) {
			/**
			 * Se seleccionó ciudad y zona
			 * Mostrar acorde la zona seleccionada
			 */
			$restaurants = $this -> Deal -> Restaurant -> find(
				'list',
				array(
					'fields' => array('Restaurant.id'),
					'conditions' => array(
						'Restaurant.zone_id' => $zone
					)
				)
			);
			$conditions['Deal.restaurant_id'] = $restaurants;
		}
		
		if($cuisine) {
			$deals = $this -> Deal -> CuisinesDeal -> find('list', array(
					'fields' => array('CuisinesDeal.deal_id'),
					'conditions' => array('CuisinesDeal.cuisine_id' => $cuisine)
				)
			);
			$conditions['Deal.id'] = $deals;
		}
		
		// Ajuste del filtro acorde orden de precio
		$order = array();
		if(isset($this -> params['named']['price']) && !empty($this -> params['named']['price'])) {
			$price = $this -> params['named']['price'];
			if($price) {
				$min_max_price = explode('-', $price);
				$conditions['Deal.price BETWEEN ? AND ?'] = array($min_max_price[0], $min_max_price[1]);
			}
		}
		
		$this -> paginate = array('conditions' => $conditions, 'order' => $order);
		
		$this -> set('large_images', $this -> getALargeImage());
		$this -> set('deals', $this -> paginate());
		$this -> set(compact('cities', 'zones', 'cuisines', 'prices'));
	}

	function view($slug = null) {
		if (!$slug) {
			$this -> Session -> setFlash(__('Invalid deal', true));
			$this -> redirect(array('action' => 'index'));
			$this -> layout = "default";
		}
		$this -> Deal -> recursive = 1;
		$deal = $this -> Deal -> find('first', array('conditions' => array('Deal.slug' => $slug)));
		$zone = $this -> Deal -> Restaurant -> Zone -> findById($deal['Restaurant']['zone_id']);
		$city = $this -> Deal -> Restaurant -> Zone -> City -> findById($zone['Zone']['city_id']);
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
		$this -> Deal -> recursive = 2;
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
		$this -> paginate = array('conditions' => array('Deal.restaurant_id' => $this -> getRestaurantsByManager()));
		$this -> set('deals', $this -> paginate());
	}

	function owner_index() {
		$this -> Deal -> recursive = 0;
		$this -> paginate = array('conditions' => array('Deal.restaurant_id' => $this -> getRestaurantsByOwner()));
		$this -> set('deals', $this -> paginate());
	}

	function manager_view($slug = null) {
		if (!$slug) {
			$this -> Session -> setFlash(__('Invalid deal', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Deal -> recursive = 2;
		$this -> set('deal', $this -> Deal -> findBySlug($slug));
	}
	
	function owner_view($slug = null) {
		if (!$slug) {
			$this -> Session -> setFlash(__('Invalid deal', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Deal -> recursive = 2;
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
