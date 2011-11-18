<div class="lista_producto"><!-- deals -->
	<a href="/deals/view/<?php echo $deal['Deal']['id']; ?>"><img src="/img/uploads/<?php echo $deal['Deal']['image']; ?>" /></a>
	<h1>
		<a href="#"><!-- descripcion -->
			<?php echo $deal['Deal']['description']; ?>
		</a>
	</h1>
	<h2 class="precio"> HOY: $<?php echo $deal['Deal']['price']; ?> </h2><!-- price -->
	<label>Comprar con:</label>
	<select>
		<option>Tarjeta de crédito</option>
		<option>Efectivo</option>
	</select>
	<p>
		<?php echo $deal['Deal']['conditions']; ?>
	</p>
	<img class="logo_negocio" src="/img/uploads/<?php $deal['Restaurant']['image']; ?>"/>
	<h3>Quedan <?php echo $deal['Deal']['amount']; ?> promociones</h3><!-- amount -->
</div>