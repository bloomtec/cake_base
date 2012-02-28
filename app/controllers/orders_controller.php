<?php
class OrdersController extends AppController {

	var $name = 'Orders';

	function beforeFilter() {
		parent::beforeFilter();
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid order', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('order', $this -> Order -> read(null, $id));
	}
	
	function add($slug = null) {
		if (!empty($this -> data)) {
			/**
			 * TODO : revisar el maximo de compras de la promocion vs la cantidad comprada por el usuario
			 */
			// Generar el código a asignar a la órden antes de guardar
			$max_id = $this -> Order -> query('SELECT MAX(`id`) FROM `orders`');
			$max_id = $max_id[0][0]['MAX(`id`)'];
			if(!$max_id) {
				$max_id = 1;
			} else {
				$max_id += 1;
			}
			$this -> data['Order']['code'] = 1000000 + $max_id;
			$this -> data['Order']['order_state_id'] = 1; // En espera de pago
			// debug($this -> data);
			/**
			 * 
			 */
			if(isset($this -> data['User'])) {
				// No estaba registrado el usuario
				debug('Creando desde cero para poder generar la orden');
			} elseif(!isset($this -> data['Order']['address_id']) && isset($this -> data['Address'])) {
				// Está registrado el usuario pero no tiene registrada una dirección
				// debug('Caso en el que hay usuario pero no hay dirección registrada');
				$this -> Order -> User -> Address -> create();
				$address = array();
				$address['Address'] = $this -> data['Address'];
				if($this -> Order -> User -> Address -> save($address)) {
					$this -> Order -> create();
					$this -> data['Order']['address_id'] = $this -> Order -> User -> Address -> id;
					$order = array();
					$order['Order'] = $this -> data['Order'];
					if($this -> Order -> save($order)) {
						$this -> Session -> setFlash(__('Se ha generado el pedido.', true));
						$this -> redirect('/deals');
					} else {
						$this -> Session -> setFlash(__('Ha ocurrido un error al generar el pedido en la creación de la órden.', true));
						// debug($order);
						// debug($this -> Order -> invalidFields());
					}
				} else {
					$this -> Session -> setFlash(__('Ha ocurrido un error al generar el pedido en la creación de la dirección.', true));
					// debug($address);
					// debug($this -> Order -> User -> Address -> invalidFields());
				}
			}
		} elseif(!$slug) {
			$this -> redirect('/deals');
		}
		$deal = $this -> Order -> Deal -> find('first', array('conditions' => array('Deal.slug' => $slug)));
		$user = $this -> Order -> User -> read(null, $this -> Auth -> user('id'));
		if($user) {
			unset($user['Restaurant']);
			unset($user['Order']);
			unset($user['Role']);
		}
		$this -> set(compact('deal', 'user'));
		
	}

	function admin_index() {
		$this -> Order -> recursive = 0;
		$this -> set('orders', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid order', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('order', $this -> Order -> read(null, $id));
	}
	
	function manager_index() {
		$this -> Order -> recursive = 0;
		
		$zones = $this -> Order -> Deal -> Restaurant -> Zone -> find('list', array('fields' => array('Zone.id'), 'conditions' => array('Zone.city_id' => $this -> Auth -> user('city_id'))));
		$restaurants = $this -> Order -> Deal -> Restaurant -> find('list', array('conditions' => array('Restaurant.zone_id' => $zones), 'fields' => array('Restaurant.id')));
		$deals = $this -> Order -> Deal -> find('list', array('conditions' => array('Deal.restaurant_id' => $restaurants), 'fields' => array('Deal.id')));
		
		$this -> paginate = array('conditions' => array('Order.deal_id' => $deals));
		
		$this -> set('orders', $this -> paginate());
	}

	function manager_view($id = null) {
		if (!$id || !$this -> isManager($id)) {
			$this -> Session -> setFlash(__('Invalid order', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('order', $this -> Order -> read(null, $id));
	}
	
	function owner_index() {
		$this -> Order -> recursive = 0;
		
		$restaurants = $this -> Order -> Deal -> Restaurant -> find('list', array('conditions' => array('Restaurant.owner_id' => $this -> Auth -> user('id')), 'fields' => array('Restaurant.id')));
		$deals = $this -> Order -> Deal -> find('list', array('conditions' => array('Deal.restaurant_id' => $restaurants), 'fields' => array('Deal.id')));
		
		$this -> paginate = array('conditions' => array('Order.deal_id' => $deals));
		
		$this -> set('orders', $this -> paginate());
	}

	function owner_view($id = null) {
		if (!$id || !$this -> isOwner($id)) {
			$this -> Session -> setFlash(__('Invalid order', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('order', $this -> Order -> read(null, $id));
	}
	
	function owner_edit($id = null) {
		if ((!$id && empty($this -> data)) || !$this -> isOwner($id)) {
			$this -> Session -> setFlash(__('Invalid order', true));
			$this -> redirect(array('action' => 'index'));
		}

		if (!empty($this -> data)) {
			if ($this -> Order -> save($this -> data)) {
				$this -> Session -> setFlash(__('La orden se ha guardado', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar la orden', true));
			}
		}

		if (empty($this -> data)) {
			$this -> data = $this -> Order -> read(null, $id);
		}
		$orderStates = $this -> Order -> OrderState -> find('list');
		$this -> set(compact('orderStates'));
	}
	
	private function isManager($order_id = null) {
		if ($order_id) {
			$order = $this -> Order -> read(null, $order_id);
			$deal = $this -> Order -> Deal -> read(null, $order['Order']['deal_id']);
			$zones = $this -> Order -> Deal -> Restaurant -> Zone -> find('list', array('fields' => array('Zone.id'), 'conditions' => array('Zone.city_id' => $this -> Auth -> user('city_id'))));
			$restaurant = $this -> Order -> Deal -> Restaurant -> find('first', array('conditions' => array('Restaurant.id' => $deal['Deal']['restaurant_id'], 'Restaurant.zone_id' => $zones)));
			if(!empty($restaurant)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	private function isOwner($order_id = null) {
		if ($order_id) {
			$order = $this -> Order -> read(null, $order_id);
			$deal = $this -> Order -> Deal -> read(null, $order['Order']['deal_id']);
			$restaurant = $this -> Order -> Deal -> Restaurant -> find('first', array('conditions' => array('Restaurant.id' => $deal['Deal']['restaurant_id'], 'Restaurant.owner_id' => $this -> Auth -> user('id'))));
			if(!empty($restaurant)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

}
