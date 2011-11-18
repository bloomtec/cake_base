<div class="deals view">
	<img src="/img/uploads/400x400/<?php echo $deal['Deal']['image']; ?>" />
	<h1><?php echo $deal['Deal']['name']; ?></h1>
	<div class="info_producto">
	  <h2 class="precio">Nuestro Precio: $<?php echo $deal['Deal']['price']; ?></h2>
	  <h2 class="precio_regular">Precio regular: $<?php echo $deal['Deal']['normal_price']; ?></h2>
		<ul>
			<?php
				if(isset($deal['Deal']['expires']) && !empty($deal['Deal']['expires'])) :
			?>
			<li>Finaliza el <?php echo $deal['Deal']['expires']; ?></li>
			<?php
				endif;
			?>
			<li>Horario de atención: <?php echo $deal['Restaurant']['schedule']; ?></li>
			<li>Tel: <?php echo $deal['Restaurant']['phone']; ?></li>
			<li><?php echo $deal['Deal']['conditions']; ?></li>
			<li>Hasta <?php echo $deal['Deal']['max_buys']; ?> cupones por persona.</li>
		</ul>
		<div style="clear: both"></div>
		<a class="comprar" href="#"></a>
	</div>
	<div class="descripcion_producto">
		<h1 class="descripcion">Descripción del producto</h1>
		<p><?php echo $deal['Deal']['description']; ?></p>
	</div>
	<div class="ubicacion">
		<h1 class="descripcion">Ubicación</h1>
		<div class="info_ubicacion">
			<h1><?php echo $deal['Restaurant']['name']; ?></h1>
			<h3><?php echo $deal['Restaurant']['schedule']; ?></h3>
			<h3>Teléfono(s) <?php echo $deal['Restaurant']['phone']; ?></h3>
			<h3>Dirección <?php echo $deal['Restaurant']['address']; ?></h3>
			<h3><?php echo $city['City']['name']; ?></h3>
			<!-- Área Google Map -->
			<img src="/img/mapa.jpg" />
			<!-- Fin área Google Map -->
		</div>
	</div>
</div>