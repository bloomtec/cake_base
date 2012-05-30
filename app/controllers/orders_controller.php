<?php
class OrdersController extends AppController {

	var $name = 'Orders';

	function beforeFilter() {
		parent::beforeFilter();
	}
	
	function changeStatus($id,$newState){
		// debe validar tambien que la persona autenticada es la duela del restaurante de la orden de la promocion
		//devuelve true o false
		if($this -> isOwner($id)) {
			$order = $this -> Order -> read(null,$id);
			$order['Order']['order_state_id']=$newState;
			if($this -> Order -> save($order)){
				if($newState==5){//APROBO LA PROMOCION
					$this -> approve($id);
				}
				if($newState==4){//ENTREGO LA PROMOCION
					// Verificar con que medio se pago para ver si se suma o no la bonificacion
					if($order['Order']['is_paid_with_cash']) {
						$user_id = $order['User']['id'];
						$price = $order['Deal']['price'];
						$quantity = $order['Order']['quantity'];
						$total = $price * $quantity;
						$this -> requestAction('/users/addUserScoreForBuying/' . $user_id . '/' . $total);
					}
				}
				echo json_encode(true);
			}else{
				echo json_encode(false);
			}
			exit(0);
		} else {
			// TODO : ?
		}
	}
	
	function orderStatus($lastOrderId){
		$object=false;
		switch ($this -> Auth -> user('role_id')) {
			case '1': //ADMIN
				$lastOrder = $this -> Order -> find('first',array('conditions'=>array('Order.id >'=>$lastOrderId),'contain' => array('Deal', 'Deal.Restaurant','User','Address','OrderState')));
				if($lastOrder){
					$object=array('event'=>'newOrder','value'=>$lastOrder);
				}
				break;
				
			case '2': //Manager
				$lastOrder = $this -> Order -> find('first',array('conditions'=>array('Order.id >'=>$lastOrderId),'contain' => array('Deal', 'Deal.Restaurant','User','Address','OrderState')));
				if($lastOrder && $this -> isManager($lastOrder['Order']['id'])){
					$object=array('event'=>'newOrder','value'=>$lastOrder);
				}
				break;
				
			case '4': //OWNER
				$lastOrder = $this -> Order -> find('first',array('conditions'=>array('Order.id >'=>$lastOrderId)));
				if($lastOrder && $this -> isOwner($lastOrder['Order']['id'])){
					$object=array('event'=>'newOrder','value'=>$lastOrder);
				}
				break;
			
			default:
				
				break;
		}	
		echo json_encode($object);
		exit(0);
	}
	
	private function approve($id) {
		//$this -> autoRender = false;
		$this -> Order -> read(null, $id);
		$this -> Order -> set('is_approved', true);
		$this -> Order -> set('is_viewed', true);
		$this -> Order -> save();
		$this -> orderApprovedEmail($id);
		//$this -> redirect(array('action' => 'index'));
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
			$this -> Session -> setFlash(__('Orden no válida', true));
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
			//$current_quantity = $this -> getUserDealCount($deal['Deal']['id'], $this -> data['Order']['user_id']);
			if($deal['Deal']['amount'] >= $this -> data['Order']['quantity']) {
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
				if(isset($this -> data['Order']['comprar_con_bono'])) {
					if($this -> data['Order']['comprar_con_bono']) {
						// Revisar que si se puede comprar con puntos
						if($this -> data['Order']['quantity'] * $this -> data['Deal']['price'] >= $this -> data['User']['user_score']) {
							$this -> data['Order']['is_paid_with_cash'] = true;
						} else {
							$this -> data['Order']['is_paid_with_cash'] = false;
						}
					}
				}
				
				if(isset($this -> data['User']['email'])) {
					if($this -> Order -> User -> findByEmail(trim($this -> data['User']['email']))) {
						$this -> Session -> setFlash(__('Este correo ya está registrado. Por favor inicia sesión', true));
						$this -> redirect('/deals');
					} else {
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
							//$this -> data['Address']['country_id'] = $user['User']['country_id'];
							//$this -> data['Address']['city_id'] = $user['User']['city_id'];
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
									$deal['Deal']['amount'] = $deal['Deal']['amount'] - $order['Order']['quantity']; 
									if(($this -> Order -> Deal -> save($deal)) && ($deal['Deal']['amount'] == 0)) {
										$this -> dealsFinishedEmail($deal['Deal']['id']);
									}
									$this -> Session -> setFlash(__('Se ha generado el pedido.', true));
									$this -> redirect('/orders/orderInfo/'.$this -> Order ->id);
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
								$deal['Deal']['amount'] = $deal['Deal']['amount'] - $order['Order']['quantity']; 
								if(($this -> Order -> Deal -> save($deal)) && ($deal['Deal']['amount'] == 0)) {
									$this -> dealsFinishedEmail($deal['Deal']['id']);
								}
								$this -> Session -> setFlash(__('Se ha generado el pedido.', true));
								$this -> redirect('/orders/orderInfo/'.$this -> Order ->id);
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
							$deal['Deal']['amount'] = $deal['Deal']['amount'] - $this -> data['Order']['quantity']; 
							if(($this -> Order -> Deal -> save($deal)) && ($deal['Deal']['amount'] == 0)) {
								$this -> dealsFinishedEmail($deal['Deal']['id']);
							}
							$this -> Session -> setFlash(__('Se ha generado el pedido.', true));
							$this -> redirect('/orders/orderInfo/'.$this -> Order ->id);
						} else {
							$this -> Session -> setFlash(__('Ha ocurrido un error al generar el pedido en la creación del pedido.', true));
							debug($order);
							debug($this -> Order -> invalidFields());
						}
					}
				}
			} else {
				// No hay la cantidad requerida
				$this -> Session -> setFlash(__('No hay suficientes promos para satisfacer la cantidad ingresada.', true));
				$this -> redirect('/deals');
			}
		} else {
			if(!$slug) {
				$this -> redirect('/deals');
			}
		}

		$deal = $this -> Order -> Deal -> find('first', array('conditions' => array('Deal.slug' => $slug)));
		$restaurant = $this -> Order -> Deal -> Restaurant -> findById($deal['Deal']['restaurant_id']);
		$zones = $this -> Order -> Deal -> Restaurant -> RestaurantsZone -> find('list', array('conditions' => array('RestaurantsZone.restaurant_id' => $restaurant['Restaurant']['id']), 'fields' => array('RestaurantsZone.zone_id')));
		$user = $this -> Order -> User -> read(null, $this -> Auth -> user('id'));
		$countries = $this -> Order -> User -> Address -> Country -> find('list', array('conditions' => array('is_present' => true)));
		if($user) {
			unset($user['Restaurant']);
			unset($user['Order']);
			unset($user['Role']);
			//$addresses = $this -> Order -> User -> Address -> find('list', array('conditions' => array('Address.zone_id' => $zones, 'Address.user_id' => $user['User']['id'])));
			$addresses = $this -> Order -> User -> Address -> find('list', array('conditions'=>array('Address.user_id' => $user['User']['id'])));
			$this -> set('addresses', $addresses);
		}
		$zones = $this -> Order -> Deal -> Restaurant -> Zone -> find('list', array('conditions' => array('Zone.id' => $zones)));
		$this -> set(compact('deal', 'user', 'countries', 'zones'));
	}

	function admin_index() {
		if(!empty($this -> data)) {
			//debug($this -> data);
			$conditions = array();
			if(!empty($this -> data['Filtros']['restaurante'])) {
				$restaurants = $this -> Order -> Deal -> Restaurant -> find(
					'list',
					array(
						'conditions' => array('Restaurant.name LIKE' => '%' . $this -> data['Filtros']['restaurante'] . '%'),
						'fields' => array('Restaurant.id'),
						'recursive' => -1
					)
				);
				$conditions['Deal.restaurant_id'] = $restaurants;
			}
			if(!empty($this -> data['Filtros']['usuario'])) {
				$users = $this -> Order -> User -> find(
					'list',
					array(
						'conditions' => array('User.email LIKE' => '%' . $this -> data['Filtros']['usuario'] . '%'),
						'fields' => array('User.id'),
						'recursive' => -1
					)
				);
				$conditions['Order.user_id'] = $users;
			}
			if(!empty($this -> data['Filtros']['pago_efectivo'])) {
				if($this -> data['Filtros']['pago_efectivo'] == 'si') {
					$conditions['Order.is_paid_with_cash'] = 1;
				} elseif($this -> data['Filtros']['pago_efectivo'] == 'no') {
					$conditions['Order.is_paid_with_cash'] = 0;
				}
			}
			if(!empty($this -> data['Filtros']['fecha_inicio']) && !empty($this -> data['Filtros']['fecha_fin'])) {
				$fechaInicio = $this -> data['Filtros']['fecha_inicio'];
				$fechaInicio = $fechaInicio['year'] . '-' . $fechaInicio['month'] . '-' . $fechaInicio['day'] . ' 00:00:00';
				$fechaFin = $this -> data['Filtros']['fecha_fin'];
				$fechaFin = $fechaFin['year'] . '-' . $fechaFin['month'] . '-' . $fechaFin['day'] . ' 23:59:59';
				$conditions['Order.created BETWEEN ? AND ?'] = array(
					$fechaInicio,
					$fechaFin
				);
			}
			$this->paginate = array(
				'contain' => array('Deal', 'Deal.Restaurant','User','Address','OrderState'),
				'order'=> 'Order.id DESC',
				'conditions' => $conditions
			);
			$this -> set('orders', $this -> paginate());
		} else {
			$this->paginate = array(
				'contain' => array('Deal', 'Deal.Restaurant','User','Address','OrderState'),
				'order'=> 'Order.id DESC',
			);
			$this -> set('orders', $this -> paginate());
		}
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Orden no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('order', $this -> Order -> read(null, $id));
	}
	
	function manager_index() {
		$this -> Order -> recursive = 0;
		$zones = $this -> Order -> Deal -> Restaurant -> Zone -> find('list', array('fields' => array('Zone.id'), 'conditions' => array('Zone.city_id' => $this -> Auth -> user('city_id'))));
		$restaurants = $this -> Order -> Deal -> Restaurant -> find('list', array('conditions' => array('Restaurant.zone_id' => $zones), 'fields' => array('Restaurant.id')));
		$deals = $this -> Order -> Deal -> find('list', array('conditions' => array('Deal.restaurant_id' => $restaurants), 'fields' => array('Deal.id')));
		$this -> set('orderStates', $this -> Order -> OrderState -> find('list'));
		if(!empty($this -> data)) {
			//debug($this -> data);
			$conditions = array();
			if(!empty($this -> data['Filtros']['restaurante'])) {
				$restaurants = $this -> Order -> Deal -> Restaurant -> find(
					'list',
					array(
						'conditions' => array('Restaurant.name LIKE' => '%' . $this -> data['Filtros']['restaurante'] . '%'),
						'fields' => array('Restaurant.id'),
						'recursive' => -1
					)
				);
				$conditions['Deal.restaurant_id'] = $restaurants;
			}
			if(!empty($this -> data['Filtros']['usuario'])) {
				$users = $this -> Order -> User -> find(
					'list',
					array(
						'conditions' => array('User.email LIKE' => '%' . $this -> data['Filtros']['usuario'] . '%'),
						'fields' => array('User.id'),
						'recursive' => -1
					)
				);
				$conditions['Order.user_id'] = $users;
			}
			if(!empty($this -> data['Filtros']['pago_efectivo'])) {
				if($this -> data['Filtros']['pago_efectivo'] == 'si') {
					$conditions['Order.is_paid_with_cash'] = 1;
				} elseif($this -> data['Filtros']['pago_efectivo'] == 'no') {
					$conditions['Order.is_paid_with_cash'] = 0;
				}
			}
			if(!empty($this -> data['Filtros']['fecha_inicio']) && !empty($this -> data['Filtros']['fecha_fin'])) {
				$fechaInicio = $this -> data['Filtros']['fecha_inicio'];
				$fechaInicio = $fechaInicio['year'] . '-' . $fechaInicio['month'] . '-' . $fechaInicio['day'] . ' 00:00:00';
				$fechaFin = $this -> data['Filtros']['fecha_fin'];
				$fechaFin = $fechaFin['year'] . '-' . $fechaFin['month'] . '-' . $fechaFin['day'] . ' 23:59:59';
				$conditions['Order.created BETWEEN ? AND ?'] = array(
					$fechaInicio,
					$fechaFin
				);
			}
			$conditions['Order.deal_id'] = $deals; 
			$this->paginate = array(
				'contain' => array('Deal', 'Deal.Restaurant','User','Address','OrderState'),
				'order'=> 'Order.id DESC',
				'conditions' => $conditions
			);
			$this -> set('orders', $this -> paginate());
		} else {			
			$this -> paginate = array(
				'contain' => array('Deal', 'Deal.Restaurant','User','Address','OrderState'),
				'conditions' => array('Order.deal_id' => $deals)
			);			
			$this -> set('orders', $this -> paginate());
		}
	}

	function manager_view($id = null) {
		if (!$id || !$this -> isManager($id)) {
			$this -> Session -> setFlash(__('Orden no válida', true));
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
		$this -> set('orderStates', $this -> Order -> OrderState -> find('list'));
	}

	function owner_view($id = null) {
		if (!$id || !$this -> isOwner($id)) {
			$this -> Session -> setFlash(__('Orden no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		$order=$this -> Order -> read(null,$id);
		$this -> Order -> saveField('is_viewed',true);
		$this -> set('order', $order);
	}
	
	function owner_edit($id = null) {
		if ((!$id && empty($this -> data)) || !$this -> isOwner($id)) {
			$this -> Session -> setFlash(__('Orden no válida', true));
			$this -> redirect(array('action' => 'index'));
		}

		if (!empty($this -> data)) {
			if ($this -> Order -> save($this -> data)) {
				/*if($this -> data['Order']['order_state_id'] == 2) {
					$this -> requestAction('/users/addUserScoreForBuying/' . $this -> data['User']['id']);
				}*/
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
	
	public function orderInfo($order_id = null) {
		if($order_id) {
			$order = $this -> Order -> read(null, $order_id);
			$userId = $this -> Auth -> user('id');
			if($order['Order']['user_id'] == $userId) {
				$deal = $this -> Order -> Deal -> read(null, $order['Order']['deal_id']);
				$restaurant = $this -> Order -> Deal -> Restaurant -> read(null, $deal['Deal']['restaurant_id']);
				$zone = $this -> Order -> Deal -> Restaurant -> Zone -> read(null, $restaurant['Restaurant']['zone_id']);
				$city = $this -> Order -> Deal -> Restaurant -> Zone -> City -> read(null, $zone['Zone']['city_id']);
				$this -> set(compact('order', 'deal', 'city'));
			} else {
				$this -> redirect('/');
			}
		}
	}
	
	public function orderApprovedEmail($order_id = null) {
		/**
		 * Asignar las variables del componente Email
		 */
		if ($order_id) {
			// Obtener los datos de la promo
			$order = $this -> Order -> read(null, $order_id);
			$client = $this -> Order -> User -> read(null, $order['Order']['user_id']);
			$deal = $this -> Order -> Deal -> read(null, $order['Order']['deal_id']);
			$restaurant = $this -> Order -> Deal -> Restaurant -> read(null, $deal['Deal']['restaurant_id']);
			
			// Address the message is going to (string). Separate the addresses with a comma if you want to send the email to more than one recipient.
			$this -> Email -> to = $client['User']['email'];
			// array of addresses to cc the message to
			$this -> Email -> cc = '';
			// array of addresses to bcc (blind carbon copy) the message to
			$this -> Email -> bcc = '';
			// reply to address (string)
			$this -> Email -> replyTo = Configure::read('info_mail');
			// Return mail address that will be used in case of any errors(string) (for mail-daemon/errors)
			$this -> Email -> return = Configure::read('reply_info_mail');
			// from address (string)
			$this -> Email -> from = Configure::read('info_mail');
			// subject for the message (string)
			$this -> Email -> subject = Configure::read('site_name') . __(' orden aprobada', true);
			// The email element to use for the message (located in app/views/elements/email/html/ and app/views/elements/email/text/)
			$this -> Email -> template = 'order_approved_email';
			// The layout used for the email (located in app/views/layouts/email/html/ and app/views/layouts/email/text/)
			//$this -> Email -> layout = '';
			// Length at which lines should be wrapped. Defaults to 70. (integer)
			//$this -> Email -> lineLength = '';
			// how do you want message sent string values of text, html or both
			$this -> Email -> sendAs = 'html';
			// array of files to send (absolute and relative paths)
			//$this -> Email -> attachments = '';
			// how to send the message (mail, smtp [would require smtpOptions set below] and debug)
			$this -> Email -> delivery = 'smtp';
			// associative array of options for smtp mailer (port, host, timeout, username, password, client)
			$this -> Email -> smtpOptions = array('port' => '465', 'timeout' => '30', 'host' => 'ssl://smtp.gmail.com', 'username' => Configure::read('info_mail'), 'password' => Configure::read('password_info_mail'), 'client' => 'smtp_helo_comopromos.com');

			/**
			 * Asignar cosas al template
			 */
			$this -> set('deal', $deal);
			$this -> set('restaurant', $restaurant);
			$this -> set('client', $client);
			$this -> set('order', $order);

			/**
			 * Enviar el correo
			 */
			Configure::write('debug', 0);
			$this -> Email -> send();
			$this -> set('smtp_errors', $this -> Email -> smtpError);
			$this -> Email -> reset();
		}

	}
	
	public function dealsFinishedEmail($deal_id = null) {
		/**
		 * Asignar las variables del componente Email
		 */
		if ($deal_id) {
			// Obtener los datos de la promo
			$deal = $this -> Order -> Deal -> read(null, $deal_id);
			$restaurant = $this -> Order -> Deal -> Restaurant -> read(null, $deal['Deal']['restaurant_id']);
			$owner = $this -> Order -> Deal -> Restaurant -> Owner -> read(null, $restaurant['Restaurant']['owner_id']);
			
			// Address the message is going to (string). Separate the addresses with a comma if you want to send the email to more than one recipient.
			$this -> Email -> to = $owner['User']['email'];
			// array of addresses to cc the message to
			$this -> Email -> cc = '';
			// array of addresses to bcc (blind carbon copy) the message to
			$this -> Email -> bcc = '';
			// reply to address (string)
			$this -> Email -> replyTo = Configure::read('info_mail');
			// Return mail address that will be used in case of any errors(string) (for mail-daemon/errors)
			$this -> Email -> return = Configure::read('reply_info_mail');
			// from address (string)
			$this -> Email -> from = Configure::read('info_mail');
			// subject for the message (string)
			$this -> Email -> subject = __('La promo: ', true) . $deal['Deal']['name'] . __(' ha terminado', true);
			// The email element to use for the message (located in app/views/elements/email/html/ and app/views/elements/email/text/)
			$this -> Email -> template = 'deals_finished_email';
			// The layout used for the email (located in app/views/layouts/email/html/ and app/views/layouts/email/text/)
			//$this -> Email -> layout = '';
			// Length at which lines should be wrapped. Defaults to 70. (integer)
			//$this -> Email -> lineLength = '';
			// how do you want message sent string values of text, html or both
			$this -> Email -> sendAs = 'html';
			// array of files to send (absolute and relative paths)
			//$this -> Email -> attachments = '';
			// how to send the message (mail, smtp [would require smtpOptions set below] and debug)
			$this -> Email -> delivery = 'smtp';
			// associative array of options for smtp mailer (port, host, timeout, username, password, client)
			$this -> Email -> smtpOptions = array('port' => '465', 'timeout' => '30', 'host' => 'ssl://smtp.gmail.com', 'username' => Configure::read('info_mail'), 'password' => Configure::read('password_info_mail'), 'client' => 'smtp_helo_comopromos.com');

			/**
			 * Asignar cosas al template
			 */
			$this -> set('deal', $deal);
			$this -> set('restaurant', $restaurant);
			$this -> set('owner', $owner);

			/**
			 * Enviar el correo
			 */
			Configure::write('debug', 0);
			$this -> Email -> send();
			$this -> set('smtp_errors', $this -> Email -> smtpError);
			$this -> Email -> reset();
		}

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
