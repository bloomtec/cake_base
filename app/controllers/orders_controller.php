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
		//Extra 1 es el id del usuario y la cantidad id:cantidad
		//Extra 2 es la cadena de ids de los productos de la venta
		//debug($_POST);
		/*
		$productox=$this->Product->read(null,1);
		$pdocutox["Product"]["descripcion"]=print_r($_POST,false);
		$this->Product->save($pdocutox);
		$usuario_id=$_POST["usuario_id"];
		$estado_pol=$_POST["estado_pol"];
		$riesgo=$_POST["riesgo"];
		$codigo_respuesta_pol=$_POST["codigo_respuesta_pol"];
		$ref_venta=$_POST["ref_venta"];
		$ref_pol=$_POST["ref_pol"];
		$firma=$_POST["firma"];
		$extra1=$_POST["extra1"];
		$extra2=$_POST["extra2"];
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
		$productos=explode(",",$extra2);
		$errors="";
		if($estado_pol==4){
			foreach($productos as $id_cantidad){
				$datoProducto=explode(":",$id_cantidad);
				$this->OnlineSale->create();
				$producto=null;
				$this->Product->recursive=-1;
				$producto=$this->Product->read(null,$datoProducto[0]);
				$OnlineSale=array(
					"OnlineSale"=>array(
						"user_id"=>$extra1,
						"product_id"=>$producto["Product"]["id"],
						"category_id"=>$producto["Product"]["category_id"],
						"codigo_venta"=>$ref_venta,
						"cantidad"=>$datoProducto[1],//cantidad
						"valor_unit"=>$producto["Product"]["valor_venta"],
						"subtotal"=>$producto["Product"]["valor_venta"]-$producto["Product"]["valor_iva"],
						"valor_iva"=>$producto["Product"]["valor_iva"],
						"valor_total"=>$producto["Product"]["valor_venta"]*$datoProducto[1]//cantidad
					)
				);
				$this->OnlineSale->save($OnlineSale);
				$this->OnlineSale->id=0;
				$user=$this->User->read(null, $extra1);
				if($user["User"]["role_id"]==4){
					$user["User"]["role_id"]=5;
					$this->User->save($user);
				}
			}
		} else {
			
		}
		*/
		/*
		 // Crear la orden
				$this->Order->create();
				$this->Order->set('code', $order_code); // Asignar el código de la orden
				if(!empty($shop_cart['ShopCart']['user_id'])) {
					// Si hay sesión de usuario entonces asignar el id del usuario
					$this->Order->set('user_id', $shop_cart['ShopCart']['user_id']);
				} else {
					// Si no hay sesión asignar el user_agent
					$this->Order->set('user_agent', $shop_cart['ShopCart']['user_agent']);
				}
				$this->Order->set('order_state', 1); // Asignar el estado de la orden
				if(!empty($shop_cart['ShopCart']['coupon_id'])) {
					$this->Order->set('coupon_id', $shop_cart['ShopCart']['coupon_id']);
				}
				if($this->Order->save()) {
					foreach ($shop_cart['ShopCart']['ShopCartItem'] as $key => $cart_item) {
						
					}
				}*/
		
		/**
		 * fin recibir datos pagos online
		 */
		exit(0);
		return;
	}

	function callBackPagosOnline() {
		$this->autoRender=false;
		debug($_POST);
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
					 */
					$this->loadModel('ShopCart');
					$shop_cart['ShopCart']['nombre'] = $this->data['Envio']['name'];
					$shop_cart['ShopCart']['apellido'] = $this->data['Envio']['surname'];
					$shop_cart['ShopCart']['pais'] = $this->data['Envio']['country'];
					$shop_cart['ShopCart']['estado'] = $this->data['Envio']['state'];
					$shop_cart['ShopCart']['ciudad'] = $this->data['Envio']['city'];
					$shop_cart['ShopCart']['direccion'] = $this->data['Envio']['address'];
					$shop_cart['ShopCart']['telefono'] = $this->data['Envio']['phone'];
					$shop_cart['ShopCart']['celular'] = $this->data['Envio']['mobile'];
					$shop_cart['ShopCart']['email'] = $this->data['Envio']['email'];
					$shop_cart['ShopCart']['subtotal'] = $this->data['Order']['subtotal'];
					$shop_cart['ShopCart']['descuento'] = $this->data['Order']['subtotal'] - $this->data['Order']['total'];
					$shop_cart['ShopCart']['total'] = $this->data['Order']['total'];
					
					for ($i=0; $i < count($shop_cart['ShopCartItem']); $i++) {
						if($shop_cart['ShopCartItem'][$i]['is_gift']) {
							$this->ShopCart->ShopCartItem->read(null, $shop_cart['ShopCartItem'][$i]['id']);
							$this->ShopCart->ShopCartItem->saveField('nombre', $this->data['Gift']['name']);
							$this->ShopCart->ShopCartItem->saveField('apellido', $this->data['Gift']['surname']);
							$this->ShopCart->ShopCartItem->saveField('pais', $this->data['Gift']['country']);
							$this->ShopCart->ShopCartItem->saveField('estado', $this->data['Gift']['state']);
							$this->ShopCart->ShopCartItem->saveField('ciudad', $this->data['Gift']['city']);
							$this->ShopCart->ShopCartItem->saveField('direccion', $this->data['Gift']['address']);
							$this->ShopCart->ShopCartItem->saveField('telefono', $this->data['Gift']['phone']);
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
