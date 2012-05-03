<?php if(isset($deals) && !empty($deals)) foreach ($deals as $deal) : ?>
<div class="lista_producto"><!-- deals -->
	<a href="/deals/view/<?php echo urlencode("".$deal['Deal']['slug']); ?>"><img src="/img/uploads/200x200/<?php echo $deal['Deal']['image']; ?>" /></a>
	<h1>
		<a href="/deals/view/<?php echo urlencode("".$deal['Deal']['slug']); ?>"><!-- descripcion -->
			<?php echo $deal['Deal']['description']; ?>
		</a>
	</h1>
	<h2 class="precio-normal">Precio normal: $<?php echo number_format($deal['Deal']['normal_price'], 0, ",", "."); ?>
	<h2 class="precio"> HOY: $<?php echo number_format($deal['Deal']['price'], 0, ",", "."); ?> </h2><!-- price -->
	
	<label>Comprar con:</label>
	<select>
		<!--<option>Tarjeta de crédito</option>-->
		<option>Efectivo</option>
	</select>
	<div class='informacion-restaurante'>
		<img src="/img/uploads/100x100/<?php echo $deal['Restaurant']['image']; ?>" class="logo_negocio" />
		<div class='informacion'>
			<h1 class="horario">Horario de atención: <br /> <?php echo $deal['Restaurant']['schedule']; ?></h1>
			
		</div>
	</div>
</div>
<?php endforeach; ?>
<div style="clear: both"></div>