<div class="ordenar">
	<label>Ordenar por:</label>
	<select class='orden'>
		<option val='puntuacion'>Puntuación</option>
		<option val='precio-asc'>Precio de menor a mayor</option>
		<option val='precio-desc'>Precio de mayor a menor</option>
	</select>
	<label>Ver:</label>
	<select class='num-productos'>
		<option val = '12'>12 por página</option>
		<option val = '24'>24 por página</option>
	</select>
</div>
<?php echo $this->element("listado_producto",array('products' => $products));?>
<div class="ordenar">
	<label>Ver:</label>
	<select class='num-productos'>
		<option val = '12'>12 por página</option>
		<option val = '24'>24 por página</option>
	</select>
	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div> 
<div class="info_categoria primero">
	<h1> Somos distribuidores autorizados</h1>
	<p>
		Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.

	</p>
	<img src="/img/marcas.jpg" />
</div>
<div class="info_categoria">
	<h1>Pague de forma segura</h1>
	<p>
		Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada.
	</p>
	<img src="/img/tarjetas.jpg" />
</div>
<div style="clear: both"></div>
