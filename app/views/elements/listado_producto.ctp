<?php for($i=0;$i<10;$i++): ?>
<div class="producto">
	<h1>Computador portátil dell</h1>
	<a href=""><img src="/img/computador_categoria.jpg" class="foto_producto" /></a>
	<h2>Precio: $1.500.000</h2>
	<a href=""><img src="/img/facebook.png" /></a>
	<a href=""><img src="/img/twitter.png" /></a>
	<a href=""><img src="/img/btn_agregar.png"/></a>
	<?php echo $this -> element("estrellas_categoria");?>
</div>
<?php endfor; ?>
<div style="clear: both"></div>