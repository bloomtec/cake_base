<?php if(isset($deals) && !empty($deals)) foreach ($deals as $deal) : ?>
<div class="lista_producto"><!-- deals -->
	<a href="/deals/view/<?php echo urlencode($deal['Deal']['slug']); ?>"><img src="/img/uploads/200x200/<?php echo $deal['Deal']['image']; ?>" /></a>
	<h1>
		<a href="/deals/view/<?php echo $deal['Deal']['slug']; ?>"><!-- descripcion -->
			<?php echo $deal['Deal']['description']; ?>
		</a>
	</h1>
	<h2 class="precio"> HOY: $<?php echo $deal['Deal']['price']; ?> </h2><!-- price -->
	<h4>Promocion válida solo por internet</h4>
	<!--
	<label>Comprar con:</label>
	<select>
		<option>Tarjeta de crédito</option>
		<option>Efectivo</option>
	</select>
	-->

		<?php echo $deal['Deal']['conditions']; ?>

	<img src="/img/uploads/50x50/<?php echo $deal['Restaurant']['image']; ?>" class="logo_negocio" />
	<h3>Quedan <?php echo $deal['Deal']['amount']; ?> promociones</h3><!-- amount -->
</div>
<?php endforeach; ?>
<div style="clear: both"></div>