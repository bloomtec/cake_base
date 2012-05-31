<?php if(isset($deals) && !empty($deals)) foreach ($deals as $deal) : ?>
<div class="lista_producto"><!-- deals -->
	<a href="/deals/view/<?php echo urlencode("".$deal['Deal']['slug']); ?>"><img src="/img/uploads/200x200/<?php echo $deal['Deal']['image']; ?>" /></a>
	<h1>
		<a href="/deals/view/<?php echo urlencode("".$deal['Deal']['slug']); ?>"><!-- descripcion -->
			<?php echo $deal['Deal']['description']; ?>
		</a>
	</h1>
	<h2 class="precio-normal"><?php __('Precio normal'); ?>: $<?php echo number_format($deal['Deal']['normal_price'], 0, ",", "."); ?>
	<h2 class="precio"> <?php __('HOY'); ?>: $<?php echo number_format($deal['Deal']['price'], 0, ",", "."); ?> </h2><!-- price -->
	
	<label><?php _('Comprar con'); ?>:</label>
	<select>
		<!--<option>Tarjeta de crédito</option>-->
		<option>Efectivo</option>
	</select>
	<div class='informacion-restaurante'>
		<img src="/img/uploads/100x100/<?php echo $deal['Restaurant']['image']; ?>" class="logo_negocio" title="<?php echo $deal['Restaurant']['name']; ?>" />
		<div class='informacion'>
			<h1 class="horario"><?php __('Horario de atención'); ?>: <br /> <?php echo $deal['Restaurant']['schedule']; ?></h1>
			<h3>Quedan <?php echo $deal['Deal']['amount']; ?> promociones</h3><!-- amount -->
		</div>
	</div>
</div>
<?php endforeach; ?>
<div style="clear: both"></div>