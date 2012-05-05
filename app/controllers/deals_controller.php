<?php
class DealsController extends AppController {

	var $name = 'Deals';

	function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> allow('getDeals', 'addVisitCount', 'filterData');
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
		$filterData = $this -> Session -> read('filterData');
		if(!empty($filterData)) {
			$filterData = explode(';', $filterData);
			$city = $filterData[0];
			$zone = $filterData[1];
			$cuisine = $filterData[2];
			$price = $filterData[3];
			
			// Crear condiciones
			$conditions = array();
			$conditions['Deal.image_large <>'] = null;
			$conditions['Deal.image_large <>'] = '';
			
			// Si se seleccionó una ciudad
			if($city != 0) {
				// Manejar si se selecciona una zona
				$zones = null;
				if($zone == 0) {
					$zones = $this -> Deal -> Restaurant -> Zone -> find(
						'list',
						array(
							'conditions' => array(
								'Zone.city_id' => $city
							),
							'fields' => array(
								'Zone.id'
							),
							'recursive' => -1
						)
					);
				} else {
					$zones = array();
				}
				
				$restaurants = array();
				if(!empty($zones)) {
					$restaurants = $this -> Deal -> Restaurant -> find(
						'list',
						array(
							'conditions' => array(
								'Restaurant.zone_id' => $zones
							),
							'fields' => array(
								'Restaurant.id'
							),
							'recursive' => -1
						)
					);
				} elseif($zone != 0) {
					$restaurants = $this -> Deal -> Restaurant -> find(
						'list',
						array(
							'conditions' => array(
								'Restaurant.zone_id' => $zone
							),
							'fields' => array(
								'Restaurant.id'
							),
							'recursive' => -1
						)
					);
				} else {
					$restaurants = $this -> Deal -> Restaurant -> find(
						'list',
						array(
							'fields' => array(
								'Restaurant.id'
							),
							'recursive' => -1
						)
					);
				}
				
				if(!empty($restaurants)) {
					$conditions['Deal.restaurant_id'] = $restaurants;
				}
				
				// Manejar si se selecciona una cocina
				if($cuisine != 0) {
					$deals = $this -> Deal -> CuisinesDeal -> find(
						'list',
						array(
							'conditions' => array(
								'CuisinesDeal.cuisine_id' => $cuisine
							),
							'fields' => array(
								'CuisinesDeal.deal_id'
							),
							'recursive' => -1
						)
					);
					if(!empty($deals)) {
						$conditions['Deal.id'] = $deals;
					}
				}
				
				// Manejar si se selecciona un precio
				if($price != 0) {
					$price = explode('-', $price);
					$min = $price[0];
					$max = $price[1];
					$conditions['Deal.price BETWEEN ? AND ?'] = array(
						$min,
						$max
					);
				}
			}
			
			$deal = $this -> Deal -> find(
				'all',
				array(
					'order' => 'rand()',
					'conditions' => $conditions
				)
			);
			if(empty($deal)) {
				unset($conditions['Deal.price BETWEEN ? AND ?']);
				$deal = $this -> Deal -> find(
					'all',
					array(
						'order' => 'rand()',
						'conditions' => $conditions
					)
				);
			}
			if(empty($deal)) {
				unset($conditions['Deal.id']);
				$deal = $this -> Deal -> find(
					'all',
					array(
						'order' => 'rand()',
						'conditions' => $conditions
					)
				);
			}
			if(empty($deal)) {
				unset($conditions['Deal.restaurant_id']);
				$deal = $this -> Deal -> find(
					'all',
					array(
						'order' => 'rand()',
						'conditions' => $conditions
					)
				);
			}
		} else {
			$deal = $this -> Deal -> find(
				'all',
				array(
					'order' => 'rand()',
					'conditions' => array(
						'Deal.image_large <>' => null,
						'Deal.image_large <>' => ''
					),
					'recursive' => -1
				)
			);
		}
		return $deal;
	}
	
	function addVisitCount($id) {
		if($id) {
			$deal = $this -> Deal -> read(null, $id);
			$deal['Deal']['visits'] += 1;
			$this -> Deal -> save($deal);
		}
	}
	
	function filterDataCities() {
		
		$this -> Deal -> recursive = 0;
		
		$city = null;

		$cities = array();
		
		
		$cities[0] = __('Ciudades...', true);
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
		
		return $cities;
				
	}
	
	function filterDataZonesRA($city_id = null) {
		$zones = array();
		if(!$city_id) {
			/**
			 * No hay ciudad seleccionada, ajustar filtros de ciudad y zona acorde
			 */
			$zones[0] = __('Escoja su zona...', true);
		} else {
			/**
			 * Hay ciudad seleccionada, ajustar filtros de ciudad y zona acorde
			 */
			$zones[0] = __('Todos...', true);
			$zones_tmp = $this -> Deal -> Restaurant -> Zone -> find('list', array('conditions' => array('Zone.city_id' => $city_id)));
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
		
		return $zones;
	}
	
	function filterDataZones($city_id = null) {
		$this -> autoRender = false;
		$zones = array();
		if(!$city_id) {
			/**
			 * No hay ciudad seleccionada, ajustar filtros de ciudad y zona acorde
			 */
			$zones[0] = __('Escoja su zona...', true);
		} else {
			/**
			 * Hay ciudad seleccionada, ajustar filtros de ciudad y zona acorde
			 */
			$zones[0] = __('Todos...', true);
			$zones_tmp = $this -> Deal -> Restaurant -> Zone -> find('list', array('conditions' => array('Zone.city_id' => $city_id)));
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
		
		echo json_encode($zones);
		
		exit(0);
	}
	
	function filterDataCuisinesRA($city_id = null, $zone_id = null) {
		$cuisines = array();
		$cuisines[0] = __('Todas...', true);
		$cuisines_tmp = $this -> requestAction('/cuisines/getList');
		foreach($cuisines_tmp as $key => $cuisine_tmp) {
			$cuisines[$key] = $cuisine_tmp;
		}
		
		// Ajustar para que solamente salgan aquellas "cocinas" que tengan promos
		$promos = $this -> Deal -> find('list', array('fields' => 'Deal.id'));
		if($city_id && !$zone_id) {
			$zonas = $this -> Deal -> Restaurant -> Zone -> find('list', array('fields' => array('Zone.id'), 'conditions' => array('Zone.city_id' => $city_id)));
			$restaurantes = $this -> Deal -> Restaurant -> find('list', array('fields' => array('Restaurant.id'), 'conditions' => array('Restaurant.zone_id' => $zonas)));
			$promos = $this -> Deal -> find('list', array('fields' => 'Deal.id', 'conditions' => array('Deal.restaurant_id' => $restaurantes)));
		} elseif($city_id && $zone_id) {
			$restaurantes = $this -> Deal -> Restaurant -> find('list', array('fields' => array('Restaurant.id'), 'conditions' => array('Restaurant.zone_id' => $zone_id)));
			$promos = $this -> Deal -> find('list', array('fields' => 'Deal.id', 'conditions' => array('Deal.restaurant_id' => $restaurantes)));
		}
		$cocinas_con_promos = $this -> Deal -> CuisinesDeal -> find('list', array('conditions' => array('CuisinesDeal.deal_id' => $promos), 'fields' => array('CuisinesDeal.cuisine_id')));
		foreach($cuisines as $key => $data) {
			if($key && !in_array($key, $cocinas_con_promos)) {
				unset($cuisines[$key]);
			}
		}
		
		return $cuisines;
	}
	
	function filterDataCuisines($city_id = null, $zone_id = null) {
		$this -> autoRender = false;
		
		$cuisines = array();
		$cuisines[0] = __('Todas...', true);
		$cuisines_tmp = $this -> requestAction('/cuisines/getList');
		foreach($cuisines_tmp as $key => $cuisine_tmp) {
			$cuisines[$key] = $cuisine_tmp;
		}
		
		// Ajustar para que solamente salgan aquellas "cocinas" que tengan promos
		$promos = $this -> Deal -> find('list', array('fields' => 'Deal.id'));
		if($city_id && !$zone_id) {
			$zonas = $this -> Deal -> Restaurant -> Zone -> find('list', array('fields' => array('Zone.id'), 'conditions' => array('Zone.city_id' => $city_id)));
			$restaurantes = $this -> Deal -> Restaurant -> find('list', array('fields' => array('Restaurant.id'), 'conditions' => array('Restaurant.zone_id' => $zonas)));
			$promos = $this -> Deal -> find('list', array('fields' => 'Deal.id', 'conditions' => array('Deal.restaurant_id' => $restaurantes)));
		} elseif($city_id && $zone_id) {
			$restaurantes = $this -> Deal -> Restaurant -> find('list', array('fields' => array('Restaurant.id'), 'conditions' => array('Restaurant.zone_id' => $zone_id)));
			$promos = $this -> Deal -> find('list', array('fields' => 'Deal.id', 'conditions' => array('Deal.restaurant_id' => $restaurantes)));
		}
		$cocinas_con_promos = $this -> Deal -> CuisinesDeal -> find('list', array('conditions' => array('CuisinesDeal.deal_id' => $promos), 'fields' => array('CuisinesDeal.cuisine_id')));
		foreach($cuisines as $key => $data) {
			if($key && !in_array($key, $cocinas_con_promos)) {
				unset($cuisines[$key]);
			}
		}
		
		echo json_encode($cuisines);
		
		exit(0);
	}
	
	function filterDataPricesRA($city_id = null) {
		$prices = null;
		if($city_id == 0) {
			$prices = array(0 => __('Todos...', true));
		} else {
			$prices = array(0 => __('Todos...', true));
			$this -> Deal -> Restaurant -> Zone -> City -> recursive = -1;
			$tmp_city = $this -> Deal -> Restaurant -> Zone -> City -> findById($city_id);
			$this -> Deal -> Restaurant -> Zone -> City -> Country -> recursive = -1;
			$country = $this -> Deal -> Restaurant -> Zone -> City -> Country -> findById($tmp_city['City']['country_id']);
			$price_ranges = $country['Country']['price_ranges'];
			$price_ranges = explode(':', $price_ranges);
			foreach($price_ranges as $key => $price_range) {
				$min_max_range = explode('-', $price_range);
				$prices[$price_range] = $country['Country']['money_symbol'] . $min_max_range[0] . ' - ' . $country['Country']['money_symbol'] . $min_max_range[1];
			}
		}
		return $prices;
	}
	
	function filterDataPrices($city_id = null) {
		$prices = null;
		if($city_id == 0) {
			$prices = array(0 => __('Todos...', true));
		} else {
			$prices = array(0 => __('Todos...', true));
			$this -> Deal -> Restaurant -> Zone -> City -> recursive = -1;
			$tmp_city = $this -> Deal -> Restaurant -> Zone -> City -> findById($city_id);
			$this -> Deal -> Restaurant -> Zone -> City -> Country -> recursive = -1;
			$country = $this -> Deal -> Restaurant -> Zone -> City -> Country -> findById($tmp_city['City']['country_id']);
			$price_ranges = $country['Country']['price_ranges'];
			$price_ranges = explode(':', $price_ranges);
			foreach($price_ranges as $key => $price_range) {
				$min_max_range = explode('-', $price_range);
				$prices[$price_range] = $country['Country']['money_symbol'] . $min_max_range[0] . ' - ' . $country['Country']['money_symbol'] . $min_max_range[1];
			}
		}
		echo json_encode($prices);
		exit(0);
	}

	function index() {
		
		if(
			isset($this -> params['named']['city']) &&
			isset($this -> params['named']['zone']) && 
			isset($this -> params['named']['cuisine']) &&
			isset($this -> params['named']['price'])
		) {
			$filterData =
				$this -> params['named']['city'] . ';'
				. $this -> params['named']['zone'] . ';'
				. $this -> params['named']['cuisine'] . ';'
				. $this -> params['named']['price'];
			$this -> Session -> write('filterData', $filterData);
		}
		
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
		
		$cities[0] = __('Ciudades...', true);
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
			$zones[0] = __('Escoja ciudad...', true);
		} else {
			/**
			 * Hay ciudad seleccionada, ajustar filtros de ciudad y zona acorde
			 */
			$zones[0] = __('Todos...', true);
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
		$cuisines[0] = __('Todas...', true);
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
			$prices = array(0 => __('Escoja ciudad...', true));
		} else {
			$prices = array(0 => __('Escoja un rango...', true));
			$this -> Deal -> Restaurant -> Zone -> City -> recursive = -1;
			$tmp_city = $this -> Deal -> Restaurant -> Zone -> City -> findById($city);
			$this -> Deal -> Restaurant -> Zone -> City -> Country -> recursive = -1;
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
		
		$this -> paginate = array('conditions' => $conditions, 'order' => $order, 'limit'=>4);
		
		$this -> set('large_images', $this -> getALargeImage());
		$this -> set('deals', $this -> paginate());
		$this -> set(compact('cities', 'zones', 'cuisines', 'prices'));
	}

	function getCities() {
		return $this -> Deal -> Restaurant -> Zone -> City -> find('list');
	}
	
	function view($slug = null) {
		if (!$slug) {
			$this -> Session -> setFlash(__('Promo no válida', true));
			$this -> redirect(array('action' => 'index'));
			$this -> layout = "default";
		}
		$this -> Deal -> recursive = 1;
		$deal = $this -> Deal -> find('first', array('conditions' => array('Deal.slug' => urldecode($slug))));
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
			$this -> Session -> setFlash(__('Promo no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Deal -> recursive = 1;
		$deal = $this -> Deal -> findBySlug($slug);
		$this -> Deal -> Order -> User -> recursive = -1;
		//debug($deal);
		$users = array();
		$addresses = array();
		foreach($deal['Order'] as $key => $value) {
			$users[$key] = $this -> Deal -> Order -> User -> findById($value['user_id']);
			$addresses[$key] = $this -> Deal -> Order -> Address -> findById($value['address_id']);
		}
		//debug($users);
		$this -> set('deal', $deal);
		$this -> set('users', $users);
		$this -> set('addresses', $addresses);
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> Deal -> create();
			if ($this -> Deal -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se guardó la promo', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				//$this -> Session -> setFlash(__('The deal could not be saved. Please, try again. Image is required. Also, check if the restaurant is being promoted. The large image is required if so.', true));
				$this -> Session -> setFlash(__('No se pudo guardar la promo. Por favor, intente de nuevo. La imagen es requerida. Se requiere la imagen grande en caso de que la promo sea promocionada.', true));
			}
		}
		$restaurants = $this -> Deal -> Restaurant -> find('list');
		$cuisines = $this -> Deal -> Cuisine -> find('list');
		$this -> set(compact('restaurants', 'cuisines'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Promo no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Deal -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se guardó la promo', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				//$this -> Session -> setFlash(__('The deal could not be saved. Please, try again. Image is required. Also, check if the restaurant is being promoted. The large image is required if so.', true));
				$this -> Session -> setFlash(__('No se pudo guardar la promo. Por favor, intente de nuevo. La imagen es requerida. Se requiere la imagen grande en caso de que la promo sea promocionada.', true));
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
			$this -> Session -> setFlash(__('ID de promo no válido', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Deal -> delete($id)) {
			$this -> Session -> setFlash(__('Promo eliminada', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('No se eliminó la promo', true));
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
			$this -> Session -> setFlash(__('Promo no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Deal -> recursive = 1;
		$deal = $this -> Deal -> findBySlug($slug);
		$this -> Deal -> Order -> User -> recursive = -1;
		//debug($deal);
		$users = array();
		$addresses = array();
		foreach($deal['Order'] as $key => $value) {
			$users[$key] = $this -> Deal -> Order -> User -> findById($value['user_id']);
			$addresses[$key] = $this -> Deal -> Order -> Address -> findById($value['address_id']);
		}
		//debug($users);
		$this -> set('deal', $deal);
		$this -> set('users', $users);
		$this -> set('addresses', $addresses);
	}
	
	function owner_view($slug = null) {
		if (!$slug) {
			$this -> Session -> setFlash(__('Promo no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Deal -> recursive = 1;
		$deal = $this -> Deal -> findBySlug($slug);
		$this -> Deal -> Order -> User -> recursive = -1;
		//debug($deal);
		$users = array();
		$addresses = array();
		foreach($deal['Order'] as $key => $value) {
			$users[$key] = $this -> Deal -> Order -> User -> findById($value['user_id']);
			$addresses[$key] = $this -> Deal -> Order -> Address -> findById($value['address_id']);
		}
		//debug($users);
		$this -> set('deal', $deal);
		$this -> set('users', $users);
		$this -> set('addresses', $addresses);
	}

	function manager_add() {
		if (!empty($this -> data)) {
			$this -> Deal -> create();
			if ($this -> Deal -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se guardó la promo', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				//$this -> Session -> setFlash(__('The deal could not be saved. Please, try again. Image is required. Also, check if the restaurant is being promoted. The large image is required if so.', true));
				$this -> Session -> setFlash(__('No se pudo guardar la promo. Por favor, intente de nuevo. La imagen es requerida. Se requiere la imagen grande en caso de que la promo sea promocionada.', true));
			}
		}
		$restaurants = $this -> Deal -> Restaurant -> find('list');
		$cuisines = $this -> Deal -> Cuisine -> find('list');
		$this -> set(compact('restaurants', 'cuisines'));
	}

	function manager_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Promo no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Deal -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se guardó la promo', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				//$this -> Session -> setFlash(__('The deal could not be saved. Please, try again. Image is required. Also, check if the restaurant is being promoted. The large image is required if so.', true));
				$this -> Session -> setFlash(__('No se pudo guardar la promo. Por favor, intente de nuevo. La imagen es requerida. Se requiere la imagen grande en caso de que la promo sea promocionada.', true));
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
			$this -> Session -> setFlash(__('ID de promo no válido', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Deal -> delete($id)) {
			$this -> Session -> setFlash(__('Promo eliminada', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('No se eliminó la promo', true));
		$this -> redirect(array('action' => 'index'));
	}

}
