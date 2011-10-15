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
		/**
		 * [url] => orders/callBackPagosOnline
		 * [usuario_id] => 76075
		 * [estado] => 2
		 * [mensaje] => transaccion aprobada
		 * [ref_venta] => 000000011
		 * [ref_pol] => 1377233
		 * [descripcion] => Pago de compra en www.colorstennis.com - Referencia 000000011
		 * [extra1] => 4
		 * [extra2] =>
		 * [estado_pol] => 4
		 * [firma] => EA628EEA1EE1D469604FE1838539AF26
		 * [codigo_respuesta_pol] => 1
		 * [riesgo] => .00
		 * [medio_pago] => 10
		 * [tipo_medio_pago] => 2
		 * [cuotas] => 12
		 * [valor] => 124900.00
		 * [valorPesos] => 124900.00
		 * [iva] => .00
		 * [valorAdicional] => .00
		 * [moneda] => COP
		 * [idioma] => es
		 * [cus] => 20111015
		 * [ciclo_pse] => null
		 * [emailComprador] => juliodominguez@gmail.com
		 * [banco_pse] =>
		 * [pse_referencia1] =>
		 * [pse_referencia2] =>
		 * [pse_referencia3] =>
		 * [codigo_autorizacion] => 909352
		 * [fecha_procesamiento] => 2011-10-15
		 */
		$usuario_id = null;
		$estado = null;
		$mensaje = null;
		$ref_venta = null;
		$ref_pol = null;
		$descripcion = null;
		$extra1 = null; // id del carrito respectivo
		$extra2 = null; // id del usuario si habia sesión
		$estado_pol = null;
		$firma = null;
		$codigo_respuesta_pol = null;
		$riesgo = null;
		$medio_pago = null;
		$tipo_medio_pago = null;
		$cuotas = null;
		$valor = null;
		$valorPesos = null;
		$iva = null;
		$valorAdicional = null;
		$moneda = null;
		$idioma = null;
		$cus = null;
		$ciclo_pse = null;
		$emailComprador = null;
		$banco_pse = null;
		$pse_referencia1 = null;
		$pse_referencia2 = null;
		$pse_referencia3 = null;
		$codigo_autorizacion = null;
		$fecha_procesamiento = null;

		if (!empty($_GET)) {
			$usuario_id = $_GET['usuario_id'];
			$estado = $_GET['estado'];
			$mensaje = $_GET['mensaje'];
			$ref_venta = $_GET['ref_venta'];
			$ref_pol = $_GET['ref_pol'];
			$descripcion = $_GET['descripcion'];
			$extra1 = $_GET['extra1'];
			$extra2 = $_GET['extra2'];
			$estado_pol = $_GET['estado_pol'];
			$firma = $_GET['firma'];
			$codigo_respuesta_pol = $_GET['codigo_respuesta_pol'];
			$riesgo = $_GET['riesgo'];
			$medio_pago = $_GET['medio_pago'];
			$tipo_medio_pago = $_GET['tipo_medio_pago '];
			$cuotas = $_GET['cuotas'];
			$valor = $_GET['valor'];
			$valorPesos = $_GET['valorPesos'];
			$iva = $_GET['iva'];
			$valorAdicional = $_GET['valorAdicional'];
			$moneda = $_GET['moneda'];
			$idioma = $_GET['idioma'];
			$cus = $_GET['cus'];
			$ciclo_pse = $_GET['ciclo_pse'];
			$emailComprador = $_GET['emailComprador'];
			$banco_pse = $_GET['banco_pse'];
			$pse_referencia1 = $_GET['pse_referencia1'];
			$pse_referencia2 = $_GET['pse_referencia2'];
			$pse_referencia3 = $_GET['pse_referencia3'];
			$codigo_autorizacion = $_GET['codigo_autorizacion'];
			$fecha_procesamiento = $_GET['fecha_procesamiento'];
		} else {
			if (!empty($_POST)) {
				$usuario_id = $_POST['usuario_id'];
				$estado = $_POST['estado'];
				$mensaje = $_POST['mensaje'];
				$ref_venta = $_POST['ref_venta'];
				$ref_pol = $_POST['ref_pol'];
				$descripcion = $_POST['descripcion'];
				$extra1 = $_POST['extra1'];
				$extra2 = $_POST['extra2'];
				$estado_pol = $_POST['estado_pol'];
				$firma = $_POST['firma'];
				$codigo_respuesta_pol = $_POST['codigo_respuesta_pol'];
				$riesgo = $_POST['riesgo'];
				$medio_pago = $_POST['medio_pago'];
				$tipo_medio_pago = $_POST['tipo_medio_pago '];
				$cuotas = $_POST['cuotas'];
				$valor = $_POST['valor'];
				$valorPesos = $_POST['valorPesos'];
				$iva = $_POST['iva'];
				$valorAdicional = $_POST['valorAdicional'];
				$moneda = $_POST['moneda'];
				$idioma = $_POST['idioma'];
				$cus = $_POST['cus'];
				$ciclo_pse = $_POST['ciclo_pse'];
				$emailComprador = $_POST['emailComprador'];
				$banco_pse = $_POST['banco_pse'];
				$pse_referencia1 = $_POST['pse_referencia1'];
				$pse_referencia2 = $_POST['pse_referencia2'];
				$pse_referencia3 = $_POST['pse_referencia3'];
				$codigo_autorizacion = $_POST['codigo_autorizacion'];
				$fecha_procesamiento = $_POST['fecha_procesamiento'];
			}
		}

		if ($codigo_respuesta_pol == 1) {
			// Transacción Aprobada
			$this->loadModel('Order');
			$order = $this -> Order -> find('first', array('conditions' => array('Order.code' => $ref_venta)));
			$this -> Order -> read(null, $order['Order']['id']);
			$this -> Order -> saveField('order_state_id', 2);
			// Remover los items del carrito
			$this -> requestAction('/shop_carts/removeAllFromCart/' . $extra1);
		} else {
			// Transaccion no aprobada, hacer algo?
		}

		/**
		 * fin recibir datos pagos online
		 */
		$this -> autoRender = false;
		exit(0);
		return;
	}

	function callBackPagosOnline() {
		if (!empty($_GET)) {
			if (!empty($_GET['extra2'])) {
				$this -> loadModel('User');
				$user = $this -> User -> read(null, $_GET["extra2"]);
				$this -> Auth -> login($user);
			}
		} else {
			if (!empty($_POST)) {
				if (!empty($_POST['extra2'])) {
					$this -> loadModel('User');
					$user = $this -> User -> read(null, $_POST["extra2"]);
					$this -> Auth -> login($user);
				}
			}
		}

		$this -> redirect('/');
		$this -> autoRender = false;
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
	function mailingMethod() {
		$this -> layout = "carrito";
		$shop_cart = $this -> requestAction('/shop_carts/getCart');

		if ($shop_cart) {
			/**
			 * El carrito existe, pasar a recolectar/generar la
			 * información necesaria para crear la orden
			 * Primero revisar que hayan ítems en el carrito!
			 */
			// Revisar si hay ítems en el carrito y que ya haya un valor total de pago
			if ((count($shop_cart['ShopCartItem']) >= 1) && (!empty($shop_cart['ShopCart']['total']))) {
				// El carrito tiene al menos un ítem y ya tiene un total asignado, proceder

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
				$descripcion = "Pago de compra en www.colorstennis.com - Referencia $order_code";

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
						$this -> Order -> OrderItem -> set('size_id', $shop_cart_item['ShopCartItem']['size_id']);
						$this -> Order -> OrderItem -> set('is_gift', $shop_cart_item['ShopCartItem']['is_gift']);
						$this -> Order -> OrderItem -> set('quantity', $shop_cart_item['ShopCartItem']['quantity']);
						$this -> Order -> OrderItem -> save();
						if ($shop_cart['ShopCartItem'][$i]['is_gift']) {
							$this -> Order -> OrderItem -> read(null, $this -> Order -> OrderItem -> id);
							$this -> Order -> OrderItem -> saveField('nombre', $shop_cart_item['ShopCartItem']['nombre']);
							$this -> Order -> OrderItem -> saveField('apellido', $shop_cart_item['ShopCartItem']['apellido']);
							$this -> Order -> OrderItem -> saveField('pais', $shop_cart_item['ShopCartItem']['pais']);
							$this -> Order -> OrderItem -> saveField('estado', $shop_cart_item['ShopCartItem']['estado']);
							$this -> Order -> OrderItem -> saveField('ciudad', $shop_cart_item['ShopCartItem']['ciudad']);
							$this -> Order -> OrderItem -> saveField('direccion', $shop_cart_item['ShopCartItem']['direccion']);
							$this -> Order -> OrderItem -> saveField('telefono', $shop_cart_item['ShopCartItem']['telefono']);
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
					$this -> set('shop_cart', $shop_cart);
					$user_id = $this -> Session -> read('Auth.User.id');
					$user = null;
					if ($user_id)
						$user = $this -> Order -> User -> read(null, $user_id);
					$this -> set('user', $user);

				} else {
					// No se pudo crear la orden, hacer algo?
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
		$this -> layout = "carrito";

		// Obtener el carrito
		$shop_cart = $this -> requestAction('/shop_carts/getCart');
		if (!empty($this -> data)) {
			if ($shop_cart) {
				/**
				 * El carrito existe, primero revisar que hayan ítems en el carrito!
				 */
				// Revisar si hay ítems en el carrito
				if (count($shop_cart['ShopCartItem']) >= 1) {
					// El carrito tiene al menos un ítem, proceder

					/**
					 * Organizar la información en el carrito de compras
					 */
					$this -> loadModel('ShopCart');
					$shop_cart['ShopCart']['nombre'] = $this -> data['Envio']['name'];
					$shop_cart['ShopCart']['apellido'] = $this -> data['Envio']['surname'];
					$shop_cart['ShopCart']['pais'] = $this -> data['Envio']['country'];
					$shop_cart['ShopCart']['estado'] = $this -> data['Envio']['state'];
					$shop_cart['ShopCart']['ciudad'] = $this -> data['Envio']['city'];
					$shop_cart['ShopCart']['direccion'] = $this -> data['Envio']['address'];
					$shop_cart['ShopCart']['telefono'] = $this -> data['Envio']['phone'];
					$shop_cart['ShopCart']['celular'] = $this -> data['Envio']['mobile'];
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
		$this -> set('user', $user);
		$this -> set('shop_cart', $shop_cart);
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
