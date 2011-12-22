<?php
class OrdersController extends AppController {

	var $name = 'Orders';

	function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> allow(
			'confirmarPagosOnline', 'callBackPagosOnline', 'mailingMethod', 'getAddressInfo', 'seguimiento'
		);
	}

	/**
	 * ----------------------------------------------------------------------------------------------------
	 * 											PAGOS ONLINE
	 *
	 * 							METODOS DE CONFIRMACIÓN DE PAGO Y CALLBACK
	 * ----------------------------------------------------------------------------------------------------
	 */

	function confirmarPagosOnline() {
		$extra1 = $_REQUEST['extra1']; // id del carrito respectivo
		$llave="132f4e12b03";
		$usuario_id=$_REQUEST['usuario_id'];
		$descripcion=$_REQUEST['descripcion'];
		$ref_venta=$_REQUEST['ref_venta'];
		$valor=$_REQUEST['valor'];
		$moneda=$_REQUEST['moneda'];
		$estado_pol=$_REQUEST['estado_pol'];
		$codigo_respuesta_pol=$_REQUEST['codigo_respuesta_pol'];
		$firma_cadena= "$llave~$usuario_id~$ref_venta~$valor~$moneda~$estado_pol";
		$firmacreada = md5($firma_cadena);//firma que generaron ustedes
		$firma =$_REQUEST['firma'];//firma que envía nuestro sistema
		$ref_venta=$_REQUEST['ref_venta'];
		$fecha_procesamiento=$_REQUEST['fecha_procesamiento'];
		$ref_pol=$_REQUEST['ref_pol'];
		$cus=$_REQUEST['cus'];
		$banco_pse=$_REQUEST['banco_pse'];
		$this->loadModel('Order');
		$order = $this -> Order -> findByCode($ref_venta);
		$this -> Order -> read(null, $order['Order']['id']);
		if(strtoupper($firma)!=strtoupper($firmacreada)){
			$this -> Order -> saveField('order_state_id', 7);
			$this -> autoRender = false;
			exit(0);
			return;
		}
		if($estado_pol == 6 && $codigo_respuesta_pol == 5) {
			//"Transacción fallida"
			$this -> Order -> saveField('order_state_id', 4);
		} else if($_REQUEST['estado_pol'] == 6 && $_REQUEST['codigo_respuesta_pol'] == 4) {
			//"Transacción rechazada"
			$this -> Order -> saveField('order_state_id', 5);
		} else if($_REQUEST['estado_pol'] == 12 && $_REQUEST['codigo_respuesta_pol'] == 9994) {
			//"Pendiente, Por favor revisar si el débito fue realizado en el Banco"
			$this -> Order -> saveField('order_state_id', 6);
		} else if($_REQUEST['estado_pol'] == 4 && $_REQUEST['codigo_respuesta_pol'] == 1) {
			//"Transacción aprobada"
			$this -> Order -> saveField('order_state_id', 2);
			if(!empty($order['Order']['coupon_id'])) {
				// Se utilizó un cupon, marcarlo como redimido
				$this->loadModel('Coupon');
				$this->Coupon->read(null, $order['Order']['coupon_id']);
				$this->Coupon->saveField('is_redeemed', 1);
			}
			// Eliminar el carrito porque ya se pago
			$this->loadModel('ShopCart');
			$this->ShopCart->delete($extra1);
			// Reducir de inventario la cantidad de items comprados
			$this->loadModel('Inventory');
			foreach($order['OrderItem'] as $item) {
				$inventario = $this->Inventory->find(
					'first',
					array(
						'conditions'=>array(
							'Inventory.product_id'=>$item['foreign_key']
						)
					)
				);
				$inventario['Inventory']['quantity']-=$item['quantity'];
				$this->Inventory->save($inventario);
			}
		} else {
			//"Otro, revisar con P.O."
			$this -> Order -> saveField('order_state_id', 7);
		}
		$this -> autoRender = false;
		exit(0);
		return;
	}

	function callBackPagosOnline() {
		$user_id = $_REQUEST['extra2']; 
		if ($user_id) {
			$this -> loadModel('User');
			$user = $this -> User -> read(null, $user_id);
			$this -> Auth -> login($user);
		}
		$llave="132f4e12b03";/////llave de usuario de pruebas 2
		$usuario_id=$_REQUEST['usuario_id'];
		$descripcion=$_REQUEST['descripcion'];
		$ref_venta=$_REQUEST['ref_venta'];
		$valor=$_REQUEST['valor'];
		$moneda=$_REQUEST['moneda'];
		$estado_pol=$_REQUEST['estado_pol'];
		$firma_cadena= "$llave~$usuario_id~$ref_venta~$valor~$moneda~$estado_pol";
		$firmacreada = md5($firma_cadena);//firma que generaron ustedes
		$firma =$_REQUEST['firma'];//firma que envía nuestro sistema
		$ref_venta=$_REQUEST['ref_venta'];
		$fecha_procesamiento=$_REQUEST['fecha_procesamiento'];
		$ref_pol=$_REQUEST['ref_pol'];
		$cus=$_REQUEST['cus'];
		$banco_pse=$_REQUEST['banco_pse'];
		if($_REQUEST['estado_pol'] == 6 && $_REQUEST['codigo_respuesta_pol'] == 5) {
			$estadoTx = "Transacci&oacute;n fallida";
		} else if($_REQUEST['estado_pol'] == 6 && $_REQUEST['codigo_respuesta_pol'] == 4) {
			$estadoTx = "Transacci&oacute;n rechazada";
		} else if($_REQUEST['estado_pol'] == 12 && $_REQUEST['codigo_respuesta_pol'] == 9994) {
			$estadoTx = "Pendiente, Por favor revisar si el d&eacute;bito fue realizado en el Banco";
		} else if($_REQUEST['estado_pol'] == 4 && $_REQUEST['codigo_respuesta_pol'] == 1) {
			$estadoTx = "Transacci&oacute;n aprobada";
		} else {
			$estadoTx=$_REQUEST['mensaje'];
		}
		$this->set(
			compact(
				'firma', 'firmacreada', 'fecha_procesamiento', 'estadoTx',
				'ref_venta', 'ref_pol', 'banco_pse', 'cus', 'valor', 'moneda', 'descripcion'
			)
		);
		$this->layout="callback";
	}

	/**
	 * ----------------------------------------------------------------------------------------------------
	 * 									METODOS PARA MANEJO DE ORDENES
	 * ----------------------------------------------------------------------------------------------------
	 */

	/**
	 * Generar la orden como tal
	 */
	function mailingMethod() {
		$this -> layout = "carrito";
		$shop_cart = $this -> requestAction('/bcart/shop_carts/getCart');

		if ($shop_cart) {
			/**
			 * El carrito existe, pasar a recolectar/generar la
			 * información necesaria para crear la orden
			 * Primero revisar que hayan ítems en el carrito!
			 */
			// Revisar si hay ítems en el carrito y que ya haya un valor total de pago
			if ((count($shop_cart['ShopCartItem']) >= 1) && (!empty($shop_cart['ShopCart']['total']))) {
				/**
				 * Ultima validación de inventario para proceder a pagar
				 */
				$this->loadModel('Inventory');
				$inventario_existente = true;
				for ($i = 0; $i < count($shop_cart['ShopCartItem']); $i++) {
					$shop_cart_item = $this -> Order -> User-> ShopCart -> ShopCartItem -> read(null, $shop_cart['ShopCartItem'][$i]['id']);
					$aInventory = $this->Inventory->find(
						'first',
						array(
							'conditions' => array(
								'Inventory.product_id'=>$shop_cart_item['ShopCartItem']['foreign_key']
							)
						)
					);
					if($aInventory['Inventory']['quantity'] < $shop_cart_item['ShopCartItem']['quantity']) {
						$inventario_existente = false;
						$shop_cart_item['ShopCartItem']['quantity'] = $aInventory['Inventory']['quantity'];
						$this -> Order -> User-> ShopCart -> ShopCartItem ->save($shop_cart_item);
					}
				}
				/**
				 * Fin validación de inventario existente
				 */
				
				if($inventario_existente) {
					// El carrito tiene al menos un ítem y ya tiene un total asignado con inventario existente, proceder
					// Crear una orden
					$this -> Order -> create();
	
					// Generar el código de la orden
					$order_code = $this -> Order -> find('first', array('fields' => array('MAX(Order.code) as max_code')));
					if ($order_code[0]['max_code']) {
						$order_code = $order_code[0]['max_code'] + 1;
					} else {
						$order_code = "000000001";
					}
					$longitud = strlen($order_code);
					for ($i = (9 - $longitud); $i > 0; $i--) {
						$order_code = "0" . $order_code;
					}
	
					//Asignar el codigo de orden y su status inicial
					$this -> Order -> set('code', $order_code);
					$this -> Order -> set('order_state_id', 1);
	
					// Description
					$descripcion = "Pago de compra en www.excelenter.com - Referencia $order_code";
	
					// Valor
					$valor = $shop_cart['ShopCart']['total'];
	
					// Moneda
					$moneda = "COP";
	
					// Nombre
					$nombre = $shop_cart['ShopCart']['nombre'] . " " . $shop_cart['ShopCart']['apellido'];
	
					// Email
					$email = $shop_cart['ShopCart']['email'];
	
					// Firma :: 132f4e12b03 <-- llave
					// formato firma --> "llaveEncripcion~usuarioId~refVenta~valor~moneda"
					$firma = md5("132f4e12b03~76075~$order_code~$valor~$moneda");
	
					/**
					 * Organizar la información en el carrito de compras
					 * y asignarla de una vez a la orden
					 */
					$this -> Order -> set('user_id', $shop_cart['ShopCart']['user_id']);
					$this -> Order -> set('user_agent', $shop_cart['ShopCart']['user_agent']);
					$this -> Order -> set('coupon_id', $shop_cart['ShopCart']['coupon_id']);
					$this -> Order -> set('nombre', $shop_cart['ShopCart']['nombre']);
					$this -> Order -> set('apellido', $shop_cart['ShopCart']['apellido']);
					$this -> Order -> set('pais', $shop_cart['ShopCart']['pais']);
					$this -> Order -> set('estado', $shop_cart['ShopCart']['estado']);
					$this -> Order -> set('ciudad', $shop_cart['ShopCart']['ciudad']);
					$this -> Order -> set('direccion', $shop_cart['ShopCart']['direccion']);
					$this -> Order -> set('telefono', $shop_cart['ShopCart']['telefono']);
					$this -> Order -> set('celular', $shop_cart['ShopCart']['celular']);
					$this -> Order -> set('email', $shop_cart['ShopCart']['email']);
					$this -> Order -> set('subtotal', $shop_cart['ShopCart']['subtotal']);
					$this -> Order -> set('descuento', $shop_cart['ShopCart']['descuento']);
					$this -> Order -> set('total', $shop_cart['ShopCart']['total']);
	
					if ($this -> Order -> save()) {
						$order_id = $this -> Order -> id;
						for ($i = 0; $i < count($shop_cart['ShopCartItem']); $i++) {
							$shop_cart_item = $this -> Order -> User-> ShopCart -> ShopCartItem -> read(null, $shop_cart['ShopCartItem'][$i]['id']);
							$this -> Order -> OrderItem -> create();
							$this -> Order -> OrderItem -> set('order_id', $order_id);
							$this -> Order -> OrderItem -> set('model_name', $shop_cart_item['ShopCartItem']['model_name']);
							$this -> Order -> OrderItem -> set('foreign_key', $shop_cart_item['ShopCartItem']['foreign_key']);
							$this -> Order -> OrderItem -> set('is_gift', $shop_cart_item['ShopCartItem']['is_gift']);
							$this -> Order -> OrderItem -> set('quantity', $shop_cart_item['ShopCartItem']['quantity']);
							$product = $this->requestAction('/products/getProduct/'.$shop_cart_item['ShopCartItem']['foreign_key']);
							$this -> Order -> OrderItem -> set('price_item', $product['Product']['price']);
							$this -> Order -> OrderItem -> set('price_total', ($product['Product']['price']*$shop_cart_item['ShopCartItem']['quantity']));
							$this -> Order -> OrderItem -> save();
							if ($shop_cart['ShopCartItem'][$i]['is_gift']) {
								$this -> Order -> OrderItem -> read(null, $this -> Order -> OrderItem -> id);
								$this -> Order -> OrderItem -> saveField('nombre', $shop_cart_item['ShopCartItem']['nombre']);
								$this -> Order -> OrderItem -> saveField('apellido', $shop_cart_item['ShopCartItem']['apellido']);
								$this -> Order -> OrderItem -> saveField('address_id', $shop_cart_item['ShopCartItem']['address_id']);
							}
						}
	
						/**
						 * Asignar los datos requeridos en el formulario!
						 */
						//urlencode("$order_code~$descripcion~$valor~$firma~$email~$moneda~$nombre")
						$this -> set('refVenta', $order_code);
						$this -> set('descripcion', $descripcion);
						$this -> set('valor', $valor);
						$this -> set('firma', $firma);
						$this -> set('email', $email);
						$this -> set('moneda', $moneda);
						$this -> set('nombre', $nombre);
						$this -> set('extra1', $shop_cart['ShopCart']['id']);
						$this -> set('order', $this->Order->read(null, $order_id));
						$user_id = $this -> Session -> read('Auth.User.id');
						$user = null;
						if ($user_id)
							$user = $this -> Order -> User -> read(null, $user_id);
						$this -> set('user', $user);
	
					} else {
						// No se pudo crear la orden, hacer algo?
					}
				} else {
					//Qué hacer si no hay inventario de los items?
					$this->redirect(array('controller'=>'shop_carts', 'action'=>'viewCart'));
				}
			} else {
				// El carrito no tiene ítems, hacer algo?
			}
		}

	}

	/**
	 * Obtener información de envío
	 */
	function getAddressInfo() {
		$this -> layout = "bcart";

		// Obtener el carrito
		$shop_cart = $this -> requestAction('/bcart/shop_carts/getCart');
		
		if (!empty($this -> data)) {
			if ($shop_cart) {
				// Manejar la direccion
				$this -> loadModel('Address');
				if($this -> data['Envio']['address_id'] == -1) {
					$this->Address->create();
					$address = array();
					$address['Address']['user_id'] = $this->Session->read('Auth.User.id');
					$address['Address']['name'] = $this->data['Envio']['name'];
					$address['Address']['country'] = $this->data['Envio']['country'];
					$address['Address']['state'] = $this->data['Envio']['state'];
					$address['Address']['city'] = $this->data['Envio']['city'];
					$address['Address']['address_line_1'] = $this->data['Envio']['address_line_1'];
					$address['Address']['address_line_2'] = $this->data['Envio']['address_line_2'];
					$address['Address']['phone'] = $this->data['Envio']['phone'];
					if($this->Address->save($address)) {
						$shop_cart['ShopCart']['address_id'] = $this -> Address -> id;
					}
				} else {
					$shop_cart['ShopCart']['address_id'] = $this -> data['Envio']['address_id'];
				}
				/**
				 * El carrito existe, primero revisar que hayan ítems en el carrito!
				 */
				// Revisar si hay ítems en el carrito
				if (count($shop_cart['ShopCartItem']) >= 1) {
					// El carrito tiene al menos un ítem, proceder

					/**
					 * Organizar la información en el carrito de compras
					 */
					$this -> loadModel('Bcart.ShopCart');
					$shop_cart['ShopCart']['nombre'] = $this -> data['Envio']['name'];
					$shop_cart['ShopCart']['apellido'] = $this -> data['Envio']['surname'];
					$shop_cart['ShopCart']['email'] = $this -> data['Envio']['email'];
					$shop_cart['ShopCart']['subtotal'] = $this -> data['Order']['subtotal'];
					$shop_cart['ShopCart']['descuento'] = $this -> data['Order']['subtotal'] - $this -> data['Order']['total'];
					$shop_cart['ShopCart']['total'] = $this -> data['Order']['total'];

					for ($i = 0; $i < count($shop_cart['ShopCartItem']); $i++) {
						$shop_cart_item = $this -> ShopCart -> ShopCartItem -> read(null, $shop_cart['ShopCartItem'][$i]['id']);
						if ($shop_cart['ShopCartItem'][$i]['is_gift']) {
							$this -> ShopCart -> ShopCartItem -> read(null, $shop_cart['ShopCartItem'][$i]['id']);
							$this -> ShopCart -> ShopCartItem -> saveField('nombre', $this -> data['Gift']['name']);
							$this -> ShopCart -> ShopCartItem -> saveField('apellido', $this -> data['Gift']['surname']);
							$this -> ShopCart -> ShopCartItem -> saveField('pais', $this -> data['Gift']['country']);
							$this -> ShopCart -> ShopCartItem -> saveField('estado', $this -> data['Gift']['state']);
							$this -> ShopCart -> ShopCartItem -> saveField('ciudad', $this -> data['Gift']['city']);
							$this -> ShopCart -> ShopCartItem -> saveField('direccion', $this -> data['Gift']['address']);
							$this -> ShopCart -> ShopCartItem -> saveField('telefono', $this -> data['Gift']['phone']);
						}
					}

					if ($this -> ShopCart -> save($shop_cart)) {
						// Redireccionar a la información final de envío
						// Parametros :: referencia de venta, descripción, valor, firma, email, moneda
						$this -> redirect(array('action' => 'mailingMethod'));
					}
				} else {
					/**
					 * No hay ítems en el carrito, por ende se hace nada.
					 */
				}
			} else {
				// El usuario no tiene carrito asignado
			}
		}
		$user_id = $this -> Session -> read('Auth.User.id');
		$user = $this -> Order -> User -> read(null, $user_id);
		$this -> loadModel('Address');
		$result = $this -> Address -> find('list', array('order'=>array('Address.default'=>'DESC'), 'fields'=>array('Address.id', 'Address.address_line_1'), 'conditions'=>array('Address.user_id'=>$this -> Session -> read('Auth.User.id'))));
		$addresses = array();
		foreach($result as $key=>$address) {
			$addresses[$key] = $address;
		}
		$addresses[-1]='Otro destino...';
		$this -> set('addresses', $addresses);
		$this -> set('user', $user);
		$this -> set('shop_cart', $shop_cart);
	}
	function view($id){
		$this->layout='callback';
		$this->set('order',$this->Order->findById($id));
	}
	function seguimiento($code){
		$this->layout='ajax';
		$this->set('order',$this->Order->findByCode($code));
	}
	function getOrders(){
		$userId=$this->Auth->user('id');
		if($userId){
			return $this->Order->find('all',array('conditions'=>array('user_id'=>$userId)));
		}else{
			return null;
		}	
	}
	
	/**
	 * ----------------------------------------------------------------------------------------------------
	 * 										METODOS CRUD
	 *
	 * 						REVISAR QUE METODOS QUEDAN PARA EL FINAL
	 * ----------------------------------------------------------------------------------------------------
	 */

	function admin_index() {
		$this->paginate=array(
			'recursive'=>1,
			'conditions'=>array(
				'Order.code >'=>'000000100'
			)
		);
		$orders = $this->paginate('Order');
		$this -> set('orders', $orders);
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid order', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('order', $this -> Order -> read(null, $id));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid order', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Order -> save($this -> data)) {
				$this -> Session -> setFlash(__('The order has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The order could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Order -> read(null, $id);
		}
		$users = $this -> Order -> User -> find('list');
		$orderStates = $this -> Order -> OrderState -> find('list');
		$this -> set(compact('users', 'orderStates'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for order', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Order -> delete($id)) {
			$this -> Session -> setFlash(__('Order deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Order was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

}