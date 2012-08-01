<div class="orden">
<div class="orden-info">
	<h1 class="descripcion">Orden:<img src="/img/descripcion_bg.png"  /></h1>
	<h2><?php __('Orden Número');?>:
	<span><?php echo $order['Order']['code'];?></span></h2>

<div class="explicacion-proceso">
	<?php  __('Si después de 10 minutos de realizar su pedido no ha recibido su confirmación de aprobación vía email, por favor comuníquese con el restaurante usando los datos que encontrará a continuación y su código de compra.');
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
		<!--<img src="/img/mapa.jpg" /> -->
		<?php if( $deal['Restaurant']['lat'] &&  $deal['Restaurant']['long']):?>
		<img alt="<?php echo 'Ubicación '.$deal['Restaurant']['name']; ?>" src="http://maps.googleapis.com/maps/api/staticmap?maptype=normal&zoom=17&size=320x208&sensor=true&markers=icon:http://chart.googleapis.com/chart?=|<?php echo $deal['Restaurant']['lat']; ?>,<?php echo $deal['Restaurant']['long']; ?>" />
		<div id="map_canvas" style="width: 320px;" onactivate="initialize()"></div>
		<?php endif;?>
	</div>
</div>
</div>