<div class="orden">
<div class="orden-info">
	<h1 class="descripcion">Orden:<img src="/img/descripcion_bg.png"  /></h1>
	<h2><?php __('Order number');?>:
	<span><?php echo $order['Order']['code'];?></span></h2>

<div class="explicacion-proceso">
	<?php  __('Si usted no recibe un correo notificando su pedido en los próximos 10 minutos por favor contáctese  con el restaurante
	con el numero de pedido que  aparece en el cuadro superior, recuerda que el número de pedido lo puedes consultar en la opción “mis pedidos” de tu perfil');
	?>
</div>
</div>
<div class="ubicacion">
	<h1 class="descripcion"><img src="/img/descripcion_bg.png"  />Ubicación</h1>
	<div class="info_ubicacion">
		<h1><?php echo $deal['Restaurant']['name'];?></h1>
		<h3><?php echo $deal['Restaurant']['schedule'];?></h3>
		<h3>Teléfono(s) <?php echo $deal['Restaurant']['phone'];?></h3>
		<h3>Dirección <?php echo $deal['Restaurant']['address'];?></h3>
		<h3><?php echo $city['City']['name'];?></h3>
		<img src="/img/mapa.jpg" />
		<!-- Área Google Map -->
		<!--<img alt="<?php echo 'Ubicación '.$deal['Restaurant']['name']; ?>" src="http://maps.googleapis.com/maps/api/staticmap?maptype=hybrid&zoom=17&size=246x208&sensor=true&markers=icon:http://chart.googleapis.com/chart?=|<?php echo $deal['Restaurant']['lat']; ?>,<?php echo $deal['Restaurant']['long']; ?>" />-->
		<!--<div id="map_canvas" style="height: 243px;" onactivate="initialize()"></div>-->
		<!-- Fin área Google Map -->
	</div>
</div>
</div>