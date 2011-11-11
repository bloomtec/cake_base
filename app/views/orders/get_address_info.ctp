<?php
echo $this -> element("menu-shop-cart");
$pais = "";
$nombre = "";
$appelido = "";
$direccion = "";
$telefono = "";
$celular = "";
$departamento = "";
$ciudad = "";
$email = "";
if ($user) {
	$pais = $user['UserField']['country'];
	$nombre = $user['UserField']['name'];
	$appelido = $user['UserField']['surname'];
	$direccion = $user['UserField']['address'];
	$telefono = $user['UserField']['phone'];
	$celular = $user['UserField']['mobile'];
	$departamento = $user['UserField']['state'];
	$ciudad = $user['UserField']['city'];
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
		$item = $this -> requestAction("/$model_name" . "s/getProduct/$foreign_key");
		$subtotal += $item[$model_name]["price"] * $shoppin_cart_item['quantity'];
		if($shoppin_cart_item['is_gift']) $foundGift=true;
	}
}

?>
<?php e($this -> Form -> create('Order',array('novalidate'=>'novalidate')));?>
<p class="costo_envio tahoma">
	Recuerda que puedes recibir tu pedido en cualquier parte de Colombia, el tiempo aproximado de entrega es de 3 a 5 días después de haber realizado el
	pago.  También puedes enviar un regalo a cualquier parte de Colombia, pero si tienes varios productos como regalo, todos serán enviados a una única
	dirección. El costo del envió se asume contra entrega; envíos a la ciudad de Cali, o pedidos con un valor de pago igual o superior a $120.000, no tienen
	costo.
</p>
<div class="datos_envio form_envio">
	<h1 class="tahoma">Datos de envio</h1>
</div>
<div id="der" class="datos_envio form_envio">
	<h1 class="der tahoma"><?php if($foundGift) {echo "Datos de envio para el regalo";} else {echo "No agregó ítems como regalo";} ?></h1>
</div>
<div class="form_envio tahoma">
	<div class="form">
		<?php //e($this -> Form -> input('Envio.full_name', array("required" => "required",'label' => 'Datos Usuario', 'value' => $nombre . " " . $appelido)));?>
		
		<?php e($this -> Form -> input('Envio.name', array('label' => 'Nombre', 'value' => $nombre, "required" => "required")));?>
		<?php e($this -> Form -> input('Envio.surname', array('label' => 'Apellido', 'value' => $appelido, "required" => "required")));?>
		<?php e($this -> Form -> hidden('Envio.country', array('label' => 'País', 'value' => $pais)));?>
		<?php e($this -> Form -> hidden('Envio.state', array('label' => 'Departamento', 'value' => $departamento)));?>
		<?php e($this -> Form -> hidden('Envio.city', array('label' => 'Ciudad', 'value' => $ciudad)));?>
		<?php e($this -> Form -> input('Envio.result', array('label' => 'Ciudad', 'id' => 'resultGeo')));?>
		<?php e($this -> Form -> input('Envio.address', array('label' => 'Dirección', 'value' => $direccion, "required" => "required")));?>
		
		<?php // e($this -> Form -> input('Envio.email', array('label' => 'Correo Electrónico', 'value' => $email, "required" => "required")));?>
		
		<div class="input text">
			<label for="EnvioEmail"> Correo Electrónico</label>
			<input type="email" id="EnvioEmail" required="required" value="<?php echo $email?>" name="data[Envio][email]">
		</div>
		<?php e($this -> Form -> input('Envio.phone', array('label' => 'Número Telefónico', 'value' => $telefono)));?>
		<?php e($this -> Form -> input('Envio.mobile', array('label' => 'Celular', 'value' => $celular,'required'=>'required')));?>
		<div style="clear: both"></div>
		<?php e($this -> Form -> checkbox('Envio.authorize', array('label' => false)));?>
		<label for="EnvioAuthorize" class="azul"> Autorizo a Colors Tennis  que me envíe información por correo electrónico</label>
		<div style="clear: both"></div>
		<?php e($this -> Form -> checkbox('Envio.conditions', array('label' => false,"required" => "required")));?>
		<label for="EnvioConditions" class="azul"> Acepto terminos y condiciones de la compra.</label>
		<div style="clear: both"></div>
	</div>
	<div style="clear: both"></div>
</div>
<div class="form_envio der tahoma">
	<div class="form">
		<?php if($foundGift): ?>
		<?php e($this -> Form -> input('Gift.name', array('label' => 'Nombre',"required" => "required")));?>
		<?php e($this -> Form -> input('Gift.surname', array('label' => 'Apellido',"required" => "required")));?>
		<?php e($this -> Form -> hidden('Gift.country', array('label' => 'País')));?>
		<?php e($this -> Form -> hidden('Gift.state', array('label' => 'Departamento')));?>
		<?php e($this -> Form -> hidden('Gift.city', array('label' => 'Ciudad')));?>
		<?php e($this -> Form -> input('Gift.result', array('label' => 'Ciudad', 'id' => 'resultGeoGift')));?>
		<?php e($this -> Form -> input('Gift.address', array('label' => 'Dirección',"required" => "required")));?>
		<?php e($this -> Form -> input('Gift.phone', array('label' => 'Número Telefónico',"required" => "required")));?>
		<?php endif;?>
		
		<?php //if(!$foundGift): ?>
		<?php //e($this -> Form -> input('Gift.country', array('label' => 'País')));?>
		<?php //e($this -> Form -> input('Gift.name', array('label' => 'Nombre')));?>
		<?php //e($this -> Form -> input('Gift.surname', array('label' => 'Apellido')));?>
		<?php //e($this -> Form -> input('Gift.address', array('label' => 'Dirección')));?>
		<?php //e($this -> Form -> input('Gift.state', array('label' => 'Departamento')));?>
		<?php //e($this -> Form -> input('Gift.city', array('label' => 'Ciudad')));?>
		<?php //e($this -> Form -> input('Gift.phone', array('label' => 'Número Telefónico')));?>
		<?php //endif;?>
		
	</div>
	<div style="clear: both"></div>
</div>
<div style="clear: both"></div>

<div id="cupon" class="twCenMt">
	<h1 class="titulos_rosado">SUBTOTAL <span class="subtotal">$<?php
	if (isset($subtotal)) {echo number_format($subtotal, 0, ' ', '.');
	} else {echo number_format(0, 0, ' ', '.');
	}
		?></span></h1>
	<?php if($shop_cart['ShopCart']['coupon_id']) :
	?>
	<h1 class="titulos_rosado">DESCUENTO APLICADO <span class="subtotal"><?=(100 * $shop_cart['ShopCart']['coupon_discount'])."%"
		?></span></h1>
	<?php endif;?>
	<?php $coupon_value = 0;
		if (isset($shop_cart['ShopCart']['coupon_discount']))
			$coupon_value = $shop_cart['ShopCart']['coupon_discount'];
	?>
	<h1 class="titulos_rosado">TOTAL <span class="total">$<?php
	if (isset($subtotal)) {echo number_format(($subtotal * (1 - $coupon_value)), 0, ' ', '.');
	} else {echo number_format(0, 0, ' ', '.');
	}
		?></span></h1>
	<div id="btn_cupon">
		<div class="agregar_regalo verde twCenMt">
			<h1><a class="envio-form" href="#">Continuar</a></h1>
		</div>
		<div class="agregar_regalo twCenMt">
			<h1><a class="seguir-comprando" href="<?php echo $session->read('referer');?>">Seguir Comprando</a></h1>
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
}
?>
</form>
<script>
	$(function(){
		var ordenValida=false;
		$("#OrderGetAddressInfoForm").validator({lang:'es'}).submit(function(e){
			var form=$(this);
			if(!e.isDefaultPrevented()&&!ordenValida){
				var check= $('#resultGeo').val().split(',')
				var gif=$('#resultGeoGift');
				if(gif.length > 0){// SI HAY REGALO
					var check2= gif.val().split(',');
				//	console.log(check2.length);
					if(check2.length != 3){
						form.data("validator").invalidate({'data[Gift][result]':'seleccione una ciudad de la lista'});
						if(check.length != 3){
							form.data("validator").invalidate({'data[Envio][result]':'seleccione una ciudad de la lista'});	
						}
						e.preventDefault();
					}else{
				//		console.log('gift valido');
						if(check.length == 3){
							ordenValida = true;
							form.submit();
						}else{
							form.data("validator").invalidate({'data[Envio][result]':'seleccione una ciudad de la lista'});
							e.preventDefault();
						}
					}
				}else{// SINO HAY REGALo
					if(check.length == 3){
						ordenValida=true;
						form.submit();
					}else{
						form.data("validator").invalidate({'data[Envio][result]':'seleccione una ciudad de la lista'});
						e.preventDefault();
					}	
				}
			}
		});
	});
	
		
$(function() {
		function logEnvio( city, state, country) {
			$('#EnvioCity').val(city);
			$('#EnvioState').val(state);
			$('#EnvioCountry').val(country);
			//$('#resultGeo').val(city+', '+state+', '+country);
		}
		$("#resultGeo" ).autocomplete({
			source: function( request, response ) {
				$.ajax({
					url: "http://ws.geonames.org/searchJSON",
					dataType: "jsonp",
					data: {
						featureClass: "P",
						style: "full",
						maxRows: 12,
						name_startsWith: request.term ,
						country: 'CO'
					},
					success: function( data ) {
						response( $.map( data.geonames, function( item ) {
							return {
								label: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
								city: item.name,
								country: item.countryName,
								state:  item.adminName1 ? item.adminName1 : "", 
								value: item.name+', '+item.adminName1+', '+item.countryName
							}
						}));
					}
				});
			},
			minLength: 1,
			select: function( event, ui ) {
				logEnvio( ui.item.city ? ui.item.city: this.value, ui.item.city ? ui.item.state: '', ui.item.country ? ui.item.country:'');
			},
			open: function() {
				$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
			},
			close: function() {
				$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
			}
		});
	
		function logGift( city, state, country) {
			$('#GiftCity').val(city);
			$('#GiftState').val(state);
			$('#GiftCountry').val(country);
			//$('#resultGeo').val(city+', '+state+', '+country);
		}

		$( "#resultGeoGift" ).autocomplete({
			source: function( request, response ) {
				$.ajax({
					url: "http://ws.geonames.org/searchJSON",
					dataType: "jsonp",
					data: {
						featureClass: "P",
						style: "full",
						maxRows: 12,
						name_startsWith: request.term,
						country: 'CO'
					},
					success: function( data ) {
						response( $.map( data.geonames, function( item ) {
							return {
								label: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
								city: item.name,
								country: item.countryName,
								state:  item.adminName1 ? item.adminName1 : "", 
								value: item.name+', '+item.adminName1+', '+item.countryName
							}
						}));
					}
				});
			},
			minLength: 1,
			select: function( event, ui ) {
				logGift( ui.item.city ? ui.item.city: this.value, ui.item.city ? ui.item.state: '', ui.item.country ? ui.item.country:'');
			},
			open: function() {
				$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
			},
			close: function() {
				$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
			}
		});
});
</script>