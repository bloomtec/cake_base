<?php
//echo $this -> element("menu-shop-cart");
$pais = "";
$nombre = "";
$appelido = "";
$email = "";
if ($user) {
	$pais = $user['User']['country'];
	$nombre = $user['User']['name'];
	$appelido = $user['User']['last_name'];
	$direccion = $user['User']['address'];
	$telefono = $user['User']['phone'];
	//$celular = $user['User']['mobile'];
	$departamento = $user['User']['state'];
	$ciudad = $user['User']['city'];
	$email = $user['User']['email'];
}
$foundGift = false;
if (empty($shop_cart['ShopCartItem'])) {
	// No hay items en el carrito
	e("<tr><td colspan='6'><h2>NO HAY ITEMS EN EL CARRITO</h2></td></tr>");
} else {
	$subtotal = 0;
	foreach ($shop_cart['ShopCartItem'] as $shoppin_cart_item) {
		$model_name = $shoppin_cart_item['model_name'];
		$foreign_key = $shoppin_cart_item['foreign_key'];
		$item = $this -> requestAction("/products/getProduct/$foreign_key");
		$subtotal += $item[$model_name]["price"] * $shoppin_cart_item['quantity'];
		//	if($shoppin_cart_item['is_gift']) $foundGift=true;
	}
}
?>
<?php e($this -> Form -> create('Order', array('novalidate' => 'novalidate')));?>
<h1 class="datos_envio">Datos de envio</h1>
<p class="envio">
	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.

	Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.
</p>
<div class="form">
	<?php //e($this -> Form -> input('Envio.full_name', array("required" => "required",'label' => 'Datos Usuario', 'value' => $nombre . " " . $appelido)));?>

	<?php e($this -> Form -> input('Envio.name', array('label' => 'Nombre', 'value' => $nombre, "required" => "required")));?>
	<?php e($this -> Form -> input('Envio.surname', array('label' => 'Apellido', 'value' => $appelido, "required" => "required")));?>
	<div class="input text">
		<label for="EnvioEmail"> Correo Electrónico</label>
		<input type="email" id="EnvioEmail" required="required" value="<?php echo $email?>" name="data[Envio][email]">
	</div>
	<?php e($this -> Form -> input('Envio.address_id', array('label' => 'Dirección')));?>
	<?php e($this -> Form -> input('Envio.country', array('disabled' => true, 'required' => 'required')));?>
	<?php e($this -> Form -> input('Envio.state', array('disabled' => true, 'required' => 'required')));?>
	<?php e($this -> Form -> input('Envio.city', array('disabled' => true, 'required' => 'required')));?>
	<?php e($this -> Form -> input('Envio.address_line_1', array('disabled' => true, 'required' => 'required')));?>
	<?php e($this -> Form -> input('Envio.address_line_2', array('disabled' => true)));?>
	<?php e($this -> Form -> input('Envio.phone', array('disabled' => true, 'required' => 'required')));?>
	<?php // e($this -> Form -> input('Envio.email', array('label' => 'Correo Electrónico', 'value' => $email, "required" => "required")));?>
	<div style="clear: both"></div>
	<?php e($this -> Form -> checkbox('Envio.authorize', array('label' => false)));?>
	<label for="EnvioAuthorize" class="terminos"> Autorizo a Excelenter  que me envíe información por correo electrónico</label>
	<div style="clear: both"></div>
	<?php e($this -> Form -> checkbox('Envio.conditions', array('label' => false, "required" => "required")));?>
	<label for="EnvioConditions" class="terminos"> Acepto terminos y condiciones de la compra.</label>
	<div style="clear: both"></div>
	<div style="clear: both"></div>
</div>
<div class="form">
	<?php
	if ($foundGift) {
		e($this -> Form -> input('Gift.name', array('label' => 'Nombre', "required" => "required")));
		e($this -> Form -> input('Gift.surname', array('label' => 'Apellido', "required" => "required")));
		e($this -> Form -> input('Gift.country', array('label' => 'País', "required" => "required")));
		e($this -> Form -> input('Gift.state', array('label' => 'Departamento', "required" => "required")));
		e($this -> Form -> input('Gift.city', array('label' => 'Ciudad', "required" => "required")));
		e($this -> Form -> input('Gift.result', array('label' => 'Ciudad', 'id' => 'resultGeoGift')));
		e($this -> Form -> input('Gift.address', array('label' => 'Dirección', "required" => "required")));
		e($this -> Form -> input('Gift.phone', array('label' => 'Número Telefónico', "required" => "required")));
	}
	?>

	<?php //if(!$foundGift):?>
	<?php //e($this -> Form -> input('Gift.country', array('label' => 'País')));?>
	<?php //e($this -> Form -> input('Gift.name', array('label' => 'Nombre')));?>
	<?php //e($this -> Form -> input('Gift.surname', array('label' => 'Apellido')));?>
	<?php //e($this -> Form -> input('Gift.address', array('label' => 'Dirección')));?>
	<?php //e($this -> Form -> input('Gift.state', array('label' => 'Departamento')));?>
	<?php //e($this -> Form -> input('Gift.city', array('label' => 'Ciudad')));?>
	<?php //e($this -> Form -> input('Gift.phone', array('label' => 'Número Telefónico')));?>
	<?php //endif;?>

	<div style="clear: both"></div>
</div>
<div style="clear: both"></div>
<div id="cupon" class="twCenMt">
	<h1 class="total">SUBTOTAL <span class="subtotal">$<?php
	if (isset($subtotal)) {echo number_format($subtotal, 0, ' ', '.');
	} else {echo number_format(0, 0, ' ', '.');
	}
		?></span></h1>
	<!--<?php if($shop_cart['ShopCart']['coupon_id']) :
	?>
	<h1 class="titulos_rosado">DESCUENTO APLICADO <span class="subtotal"><?=(100 * $shop_cart['ShopCart']['coupon_discount'])."%"
	?></span></h1>
	<?php endif;?>
	-->
	<?php $coupon_value = 0;
		if (isset($shop_cart['ShopCart']['coupon_discount']))
			$coupon_value = $shop_cart['ShopCart']['coupon_discount'];
	?>
	<h1 class="total">TOTAL <span class="total">$<?php
	if (isset($subtotal)) {echo number_format(($subtotal * (1 - $coupon_value)), 0, ' ', '.');
	} else {echo number_format(0, 0, ' ', '.');
	}
		?></span></h1>
	<div id="btn_cupon">
		<div class="continuar">
			<h1><a class="envio-form" href="#">Continuar</a></h1>
		</div>
		<div class="seguir">
			<h1><a class="seguir-comprando" href="<?php echo $session -> read('referer');?>">Seguir Comprando</a></h1>
		</div>
		<div style="clear: both"></div>
	</div>
	<div style="clear: both"></div>
</div>
<?php
if (isset($subtotal)) {
	e($this -> Form -> hidden('Order.subtotal', array('value' => $subtotal)));
	$coupon_value = 0;
	if (isset($shop_cart['ShopCart']['coupon_discount']))
		$coupon_value = $shop_cart['ShopCart']['coupon_discount'];
	e($this -> Form -> hidden('Order.total', array('value' => ($subtotal * (1 - $coupon_value)))));
} else {
	e($this -> Form -> hidden('Order.subtotal', array('value' => 0)));
	e($this -> Form -> hidden('Order.total', array('value' => 0)));
	//e($this->Form->end('enviar'));
}
?>
</form>
<script>
	/**
	 * Llenar campos de la direccion al cargar el documento
	 */
	$(document).ready(function() {
		if($('#EnvioAddressId option:selected').text() === 'Otro destino...') {
			$('#EnvioCountry').attr('disabled', false);
			$('#EnvioState').attr('disabled', false);
			$('#EnvioCity').attr('disabled', false);
			$('#EnvioAddressLine1').attr('disabled', false);
			$('#EnvioAddressLine2').attr('disabled', false);
			$('#EnvioPhone').attr('disabled', false);
			$('#EnvioCountry').val('');
			$('#EnvioState').val('');
			$('#EnvioCity').val('');
			$('#EnvioAddressLine1').val('');
			$('#EnvioAddressLine2').val('');
			$('#EnvioPhone').val('');
		} else {
			$('#EnvioCountry').attr('disabled', true);
			$('#EnvioState').attr('disabled', true);
			$('#EnvioCity').attr('disabled', true);
			$('#EnvioAddressLine1').attr('disabled', true);
			$('#EnvioAddressLine2').attr('disabled', true);
			$('#EnvioPhone').attr('disabled', true);
			$.ajax({
				url : '/addresses/getAddresses/' + $('#EnvioAddressId option:selected').val(),
				cache : false,
				dataType : 'json',
				success : function(address) {
					$('#EnvioCountry').val(address.country);
					$('#EnvioState').val(address.state);
					$('#EnvioCity').val(address.city);
					$('#EnvioAddressLine1').val(address.address_line_1);
					$('#EnvioAddressLine2').val(address.address_line_2);
					$('#EnvioPhone').val(address.phone);
				}
			});
		}
	});
	/**
	 * Verificar cambio de estado de las direcciones
	 */
	$(function() {
		$('#EnvioAddressId').change(function() {
			if($('#EnvioAddressId option:selected').text() === 'Otro destino...') {
				$('#EnvioCountry').attr('disabled', false);
				$('#EnvioState').attr('disabled', false);
				$('#EnvioCity').attr('disabled', false);
				$('#EnvioAddressLine1').attr('disabled', false);
				$('#EnvioAddressLine2').attr('disabled', false);
				$('#EnvioPhone').attr('disabled', false);
				$('#EnvioCountry').val('');
				$('#EnvioState').val('');
				$('#EnvioCity').val('');
				$('#EnvioAddressLine1').val('');
				$('#EnvioAddressLine2').val('');
				$('#EnvioPhone').val('');
			} else {
				$('#EnvioCountry').attr('disabled', true);
				$('#EnvioState').attr('disabled', true);
				$('#EnvioCity').attr('disabled', true);
				$('#EnvioAddressLine1').attr('disabled', true);
				$('#EnvioAddressLine2').attr('disabled', true);
				$('#EnvioPhone').attr('disabled', true);
				$.ajax({
					url : '/addresses/getAddresses/' + $('#EnvioAddressId option:selected').val(),
					cache : false,
					dataType : 'json',
					success : function(address) {
						$('#EnvioCountry').val(address.country);
						$('#EnvioState').val(address.state);
						$('#EnvioCity').val(address.city);
						$('#EnvioAddressLine1').val(address.address_line_1);
						$('#EnvioAddressLine2').val(address.address_line_2);
						$('#EnvioPhone').val(address.phone);
					}
				});
			}
		});
	});
	$(function() {
		$("#OrderGetAddressInfoForm").validator({
			lang : 'es'
		});
	});
	$(function() {
		function logEnvio(city, state, country) {
			$('#EnvioCity').val(city);
			$('#EnvioState').val(state);
			$('#EnvioCountry').val(country);
			//$('#resultGeo').val(city+', '+state+', '+country);
		}


		$("#resultGeo").autocomplete({
			source : function(request, response) {
				$.ajax({
					url : "http://ws.geonames.org/searchJSON",
					dataType : "jsonp",
					data : {
						featureClass : "P",
						style : "full",
						maxRows : 12,
						name_startsWith : request.term
					},
					success : function(data) {
						response($.map(data.geonames, function(item) {
							return {
								label : item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
								city : item.name,
								country : item.countryName,
								state : item.adminName1 ? item.adminName1 : "",
								value : item.name + ', ' + item.adminName1 + ', ' + item.countryName
							}
						}));
					}
				});
			},
			minLength : 2,
			select : function(event, ui) {
				logEnvio(ui.item.city ? ui.item.city : this.value, ui.item.city ? ui.item.state : '', ui.item.country ? ui.item.country : '');
			},
			open : function() {
				$(this).removeClass("ui-corner-all").addClass("ui-corner-top");
			},
			close : function() {
				$(this).removeClass("ui-corner-top").addClass("ui-corner-all");
			}
		});

		function logGift(city, state, country) {
			$('#GiftCity').val(city);
			$('#GiftState').val(state);
			$('#GiftCountry').val(country);
			//$('#resultGeo').val(city+', '+state+', '+country);
		}


		$("#resultGeoGift").autocomplete({
			source : function(request, response) {
				$.ajax({
					url : "http://ws.geonames.org/searchJSON",
					dataType : "jsonp",
					data : {
						featureClass : "P",
						style : "full",
						maxRows : 12,
						name_startsWith : request.term
					},
					success : function(data) {
						response($.map(data.geonames, function(item) {
							return {
								label : item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
								city : item.name,
								country : item.countryName,
								state : item.adminName1 ? item.adminName1 : "",
								value : item.name + ', ' + item.adminName1 + ', ' + item.countryName
							}
						}));
					}
				});
			},
			minLength : 2,
			select : function(event, ui) {
				logGift(ui.item.city ? ui.item.city : this.value, ui.item.city ? ui.item.state : '', ui.item.country ? ui.item.country : '');
			},
			open : function() {
				$(this).removeClass("ui-corner-all").addClass("ui-corner-top");
			},
			close : function() {
				$(this).removeClass("ui-corner-top").addClass("ui-corner-all");
			}
		});
	});

</script>