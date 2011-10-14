<?php
class OrdersController extends AppController {

	var $name = 'Orders';

	function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> allow(
			'confirmarPagosOnline', 'callBackPagosOnline', 'mailingMethod', 'getAddressInfo'
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
		$this->autoRender = false;
		//Extra 1 es el id del carrito
		//Extra 2 no lo estoy usando
		$usuario_id=$_POST["usuario_id"];
		$estado_pol=$_POST["estado_pol"];
		$riesgo=$_POST["riesgo"];
		$codigo_respuesta_pol=$_POST["codigo_respuesta_pol"];
		$ref_venta=$_POST["ref_venta"];
		$ref_pol=$_POST["ref_pol"];
		$firma=$_POST["firma"];
		$extra1=$_POST["extra1"];
		//$extra2=$_POST["extra2"];
		$medio_pago=$_POST["medio_pago"];
		$tipo_medio_pago=$_POST["tipo_medio_pago"];
		$cuotas=$_POST["cuotas"];
		$iva=$_POST["iva"];
		$valorAdicional=$_POST["valorAdicional"];
		$moneda=$_POST["moneda"];
		$fecha_transaccion=$_POST["fecha_transaccion"];
		$codigo_autorizacion=$_POST["codigo_autorizacion"];
		$cus=$_POST["cus"];
		$banco_pse=$_POST["banco_pse"];
		$email_comprador=$_POST["email_comprador"];
		
		if($codigo_respuesta_pol == 1) {
			// Transacción Aprobada
			$order = $this->Order->findByCode($ref_venta);
			$this->Order->read(null, $order['Order']['id']);
			$this->Order->saveField('order_status_id', 2); // Estado orden pagada
		} else {
			
		}
		
		/**
		 * fin recibir datos pagos online
		 */
		exit(0);
		return;
	}

	function callBackPagosOnline() {
		$post = $_POST;
		$get = $_GET;
		debug($post);
		debug($get);
		$this->autoRender=false;
		exit(0);
		return;
	}

	/**
	 * ----------------------------------------------------------------------------------------------------
	 * 									METODOS PARA MANEJO DE ORDENES
	 * ----------------------------------------------------------------------------------------------------
	 */
	
	/**
	 * Generar la orden como tal
	 */
	function mailingMethod($data) {
		$this->layout="carrito";
		$shop_cart = $this->requestAction('/shop_carts/getCart');
		$data = split("~", urldecode($data));
		$this->set('refVenta', $data[0]);
		$this->set('descripcion', $data[1]);
		$this->set('valor', $data[2]);
		$this->set('firma', $data[3]);
		$this->set('email', $data[4]);
		$this->set('moneda', $data[5]);
		$this->set('nombre', $data[6]);
		$this->set('extra1', $shop_cart['ShopCart']['id']);
		$this->set('shop_cart', $shop_cart);
		$this->loadModel('User');
		$user_id = $this->Session->read('Auth.User.id');
		$user = null;
		if($user_id) $user = $this->User->read(null, $user_id);
		$this->set('user', $user);
	}
	
	/**
	 * Obtener información de envío
	 */
	function getAddressInfo() {
		$this->layout="carrito";
		
		// Obtener el carrito
		$shop_cart = $this->requestAction('/shop_carts/getCart');
		if(!empty($this->data)) {
			if($shop_cart) {
				/**
				 * El carrito existe, pasar a recolectar/generar la
				 * información necesaria para crear la orden
				 * Primero revisar que hayan ítems en el carrito!
				 */
				// Revisar si hay ítems en el carrito
				if(count($shop_cart['ShopCartItem']) >= 1) {
					// El carrito tiene al menos un ítem, proceder
					
					// Crear una orden
					$this->Order->create();
					
					// Generar el código de la orden
					$order_code = $this->Order->find('first', array('fields' => array('MAX(Order.code) as max_code')));
					if($order_code[0]['max_code']) {
						$order_code = $order_code[0]['max_code'] + 1;
					} else {
						$order_code = "000000001";
					}
					$longitud = strlen($order_code);
					for ($i = (9 - $longitud); $i > 0; $i--) {
						$order_code = "0" . $order_code;
					}
					
					//Asignar el codigo de orden y su status inicial
					$this->Order->set('code', $order_code);
					$this->Order->set('order_state_id', 1);
					
					// Description
					$descripcion = "Pago de compra en www.colorstennis.com - Referencia $order_code";
					
					// Valor
					$valor = $this->data['Order']['total'];
					
					// Moneda
					$moneda = "COP";
					
					// Nombre
					$nombre = $this->data['Envio']['name'] . " " . $this->data['Envio']['surname'];
					
					// Email
					$email = $this->data['Envio']['email'];
					
					// Firma :: 132f4e12b03 <-- llave
					// formato firma --> "llaveEncripcion~usuarioId~refVenta~valor~moneda"
					$firma = "132f4e12b03~76075~$order_code~$valor~$moneda";
					$firma = md5($firma);
					
					/**
					 * Organizar la información en el carrito de compras
					 * y asignarla de una vez a la orden
					 */
					$this->loadModel('ShopCart');
					$shop_cart['ShopCart']['nombre'] = $this->data['Envio']['name'];
					$this->Order->set('nombre', $this->data['Envio']['name']);
					$shop_cart['ShopCart']['apellido'] = $this->data['Envio']['surname'];
					$this->Order->set('apellido', $this->data['Envio']['surname']);
					$shop_cart['ShopCart']['pais'] = $this->data['Envio']['country'];
					$this->Order->set('pais', $this->data['Envio']['country']);
					$shop_cart['ShopCart']['estado'] = $this->data['Envio']['state'];
					$this->Order->set('estado', $this->data['Envio']['state']);
					$shop_cart['ShopCart']['ciudad'] = $this->data['Envio']['city'];
					$this->Order->set('ciudad', $this->data['Envio']['city']);
					$shop_cart['ShopCart']['direccion'] = $this->data['Envio']['address'];
					$this->Order->set('direccion', $this->data['Envio']['address']);
					$shop_cart['ShopCart']['telefono'] = $this->data['Envio']['phone'];
					$this->Order->set('telefono', $this->data['Envio']['phone']);
					$shop_cart['ShopCart']['celular'] = $this->data['Envio']['mobile'];
					$this->Order->set('celular', $this->data['Envio']['mobile']);
					$shop_cart['ShopCart']['email'] = $this->data['Envio']['email'];
					$this->Order->set('email', $this->data['Envio']['email']);
					$shop_cart['ShopCart']['subtotal'] = $this->data['Order']['subtotal'];
					$this->Order->set('subtotal', $this->data['Order']['subtotal']);
					$shop_cart['ShopCart']['descuento'] = $this->data['Order']['subtotal'] - $this->data['Order']['total'];
					$this->Order->set('descuento', $this->data['Order']['subtotal'] - $this->data['Order']['total']);
					$shop_cart['ShopCart']['total'] = $this->data['Order']['total'];
					$this->Order->set('total', $this->data['Order']['total']);
					
					$this->Order->save();
					$order_id = $this->Order->id;
					for ($i=0; $i < count($shop_cart['ShopCartItem']); $i++) {
						$shop_cart_item = $this->ShopCart->ShopCartItem->read(null, $shop_cart['ShopCartItem'][$i]['id']);
						$this->Order->OrderItem->create();
						$this->Order->OrderItem->set('order_id', $order_id);
						$this->Order->OrderItem->set('model_name', $shop_cart_item['ShopCartItem']['model_name']);
						$this->Order->OrderItem->set('foreign_key', $shop_cart_item['ShopCartItem']['foreign_key']);
						$this->Order->OrderItem->set('size_id', $shop_cart_item['ShopCartItem']['size_id']);
						$this->Order->OrderItem->set('is_gift', $shop_cart_item['ShopCartItem']['is_gift']);
						$this->Order->OrderItem->set('quantity', $shop_cart_item['ShopCartItem']['quantity']);
						$this->Order->OrderItem->save();
						if($shop_cart['ShopCartItem'][$i]['is_gift']) {
							$this->Order->OrderItem->read(null, $this->Order->OrderItem->id);
							$this->ShopCart->ShopCartItem->read(null, $shop_cart['ShopCartItem'][$i]['id']);
							$this->ShopCart->ShopCartItem->saveField('nombre', $this->data['Gift']['name']);
							$this->Order->OrderItem->saveField('nombre', $this->data['Gift']['name']);
							$this->ShopCart->ShopCartItem->saveField('apellido', $this->data['Gift']['surname']);
							$this->Order->OrderItem->saveField('apellido', $this->data['Gift']['surname']);
							$this->ShopCart->ShopCartItem->saveField('pais', $this->data['Gift']['country']);
							$this->Order->OrderItem->saveField('pais', $this->data['Gift']['country']);
							$this->ShopCart->ShopCartItem->saveField('estado', $this->data['Gift']['state']);
							$this->Order->OrderItem->saveField('estado', $this->data['Gift']['state']);
							$this->ShopCart->ShopCartItem->saveField('ciudad', $this->data['Gift']['city']);
							$this->Order->OrderItem->saveField('ciudad', $this->data['Gift']['city']);
							$this->ShopCart->ShopCartItem->saveField('direccion', $this->data['Gift']['address']);
							$this->Order->OrderItem->saveField('direccion', $this->data['Gift']['address']);
							$this->ShopCart->ShopCartItem->saveField('telefono', $this->data['Gift']['phone']);
							$this->Order->OrderItem->saveField('telefono', $this->data['Gift']['phone']);
						}
					}
					
					if($this->ShopCart->save($shop_cart)) {
						// Redireccionar a la información final de envío
						// Parametros :: referencia de venta, descripción, valor, firma, email, moneda
						$this->redirect(array('action'=>'mailingMethod', urlencode("$order_code~$descripcion~$valor~$firma~$email~$moneda~$nombre")));
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
		$user_id = $this->Session->read('Auth.User.id');
		$user = $this->Order->User->read(null, $user_id);
		$this->set('user', $user);
		$this->set('shop_cart', $shop_cart);
	}

	/**
	 * ----------------------------------------------------------------------------------------------------
	 * 										METODOS CRUD
	 *
	 * 						REVISAR QUE METODOS QUEDAN PARA EL FINAL
	 * ----------------------------------------------------------------------------------------------------
	 */
	function index() {
		$this -> Order -> recursive = 0;
		$this -> set('orders', $this -> paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid order', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('order', $this -> Order -> read(null, $id));
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

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> Order -> create();
			if ($this -> Order -> save($this -> data)) {
				$this -> Session -> setFlash(__('The order has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The order could not be saved. Please, try again.', true));
			}
		}
		$users = $this -> Order -> User -> find('list');
		$orderStates = $this -> Order -> OrderState -> find('list');
		$this -> set(compact('users', 'orderStates'));
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
