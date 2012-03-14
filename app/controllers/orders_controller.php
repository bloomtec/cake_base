<?php
class OrdersController extends AppController {

	var $name = 'Orders';

	function beforeFilter() {
		parent::beforeFilter();
	}
	
	private function getUserDealCount($deal_id = null, $user_id = null) {
		//$deal = $this -> Order -> Deal -> read(null, $deal_id);
		$orders = $this -> Order -> find('all', array('conditions' => array('Order.deal_id' => $deal_id, 'Order.user_id' => $user_id)));
		$quantity = 0;
		foreach ($orders as $key => $order) {
			$quantity += $order['Order']['quantity'];
		}
		return $quantity;
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
			$deal = $this -> Order -> Deal -> read(null, $this -> data['Deal']['id']);
			$current_quantity = $this -> getUserDealCount($deal['Deal']['id'], $this -> data['Order']['user_id']);
			if($current_quantity + $this -> data['Order']['quantity'] <= $deal['Deal']['max_buys']) {
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
				
				if(isset($this -> data['User'])) {
					if($this -> Order -> User -> findByEmail(trim($this -> data['User']['email']))) {
						$this -> Session -> setFlash(__('Este correo ya está registrado. Por favor inicia sesión', true));
						$this -> redirect('/deals');
					} else {
						/**
						 * No estaba registrado el usuario
						 * Crear el usuario
						 * Crear la dirección
						 * Crear la orden
						 */
						// Crear el usuario
						$this -> data['User']['role_id'] = 3;
						$this -> data['User']['active'] = 1;
						$this -> Order -> User -> create();
						$user = array();
						$user['User'] = $this -> data['User'];
						if ($this -> Order -> User -> save($user)) {
							// Generar el codigo para el correo de registro
							$code = $this -> requestAction('/users/encrypt/' . $this -> Order -> User -> id . '/' . "\xc8\xd9\xb9\x06\xd9\xe8\xc9\xd2");
							$code = urlencode($code);
							// Enviar el correo con el codigo
							$this -> requestAction('/users/registrationEmail/' . $user['User']['email'] . '/' . $code);
							
							// Crear la dirección, en este caso asignar user_id, country_id y city_id
							$this -> data['Address']['user_id'] = $this -> Order -> User -> id;
							$this -> data['Address']['country_id'] = $user['User']['country_id'];
							$this -> data['Address']['city_id'] = $user['User']['city_id'];
							$this -> Order -> User -> Address -> create();
							$address = array();
							$address['Address'] = $this -> data['Address'];
							if($this -> Order -> User -> Address -> save($address)) {
								$this -> Order -> create();
								$this -> data['Order']['address_id'] = $this -> Order -> User -> Address -> id;
								$this -> data['Order']['user_id'] = $this -> Order -> User -> id;
								$order = array();
								$order['Order'] = $this -> data['Order'];
								if($this -> Order -> save($order)) {
									$this -> Session -> setFlash(__('Se ha generado el pedido.', true));
									$this -> redirect('/deals');
								} else {
									$this -> Session -> setFlash(__('Ha ocurrido un error al generar el pedido en la creación del pedido.', true));
									debug($order);
									debug($this -> Order -> invalidFields());
								}
							} else {
								$this -> Session -> setFlash(__('Ha ocurrido un error al generar el pedido en la creación de la dirección.', true));
								debug($address);
								debug($this -> Order -> User -> Address -> invalidFields());
							}
						} else {
							$this -> Session -> setFlash(__('Ha ocurrido un error al registrar el usuario.', true));
							debug($user);
							debug($this -> Order -> User -> invalidFields());
						}
					}			
				} else {
					if(!isset($this -> data['Order']['address_id']) && isset($this -> data['Address'])) {
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
								$this -> Session -> setFlash(__('Ha ocurrido un error al generar el pedido en la creación del pedido.', true));
								debug($order);
								debug($this -> Order -> invalidFields());
							}
						} else {
							$this -> Session -> setFlash(__('Ha ocurrido un error al generar el pedido en la creación de la dirección.', true));
							debug($address);
							debug($this -> Order -> User -> Address -> invalidFields());
						}
					} else {
						if($this -> Order -> save($this -> data)) {
							$this -> Session -> setFlash(__('Se ha generado el pedido.', true));
							$this -> redirect('/deals');
						} else {
							$this -> Session -> setFlash(__('Ha ocurrido un error al generar el pedido en la creación del pedido.', true));
							debug($order);
							debug($this -> Order -> invalidFields());
						}
					}
				}
			} else {
				$this -> Session -> setFlash('The quantity selected exceeds the maximum allowed');
				$this -> redirect(array('action' => 'add', $deal['Deal']['slug']));
			}			
		} else {
			if(!$slug) {
				$this -> redirect('/deals');
			}
		}

		$deal = $this -> Order -> Deal -> find('first', array('conditions' => array('Deal.slug' => $slug)));
		$user = $this -> Order -> User -> read(null, $this -> Auth -> user('id'));
		$countries = $this -> Order -> User -> Address -> Country -> find('list', array('conditions' => array('is_present' => true)));
		if($user) {
			unset($user['Restaurant']);
			unset($user['Order']);
			unset($user['Role']);
			$addresses = $this -> Order -> User -> Address -> find('list', array('conditions' => array('Address.user_id' => $user['User']['id'])));
			$this -> set('addresses', $addresses);
		}
		$this -> set(compact('deal', 'user', 'countries'));		
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
