<div class="resumen">
	<h1>Resumen de la compra</h1>
	<div class="precio">
		<img src="/img/computador.jpg"/>
		<h2>Precio total:1.500.000</h2>
	</div>
	<div class="resumen_menu">
		<ul>
			<li>
				<a href="">Ir a mi carrito</a>
			</li>
			<li>
				<a href="">Pagar</a>
			</li>
			<li>
				<a href="">Imprimir</a>
			</li>
		</ul>
	</div>
	<?php $myPC = $this->Session->read('myPC'); ?>
	<div class="resumen_productos">
		<h1>Procesador</h1>
		<h2><?php if(!empty($myPC['Processor'])) { echo $myPC['Processor']['Product']['name']; } else { echo 'No hay selección'; } ?></h2>
		<h1>Tarjeta madre</h1>
		<h2><?php if(!empty($myPC['Motherboard'])) { echo $myPC['Motherboard']['Product']['name']; } else { echo 'No hay selección'; } ?></h2>
		<h1>Tarjeta de video</h1>
		<h2><?php if(!empty($myPC['VideoCard'])) { echo $myPC['VideoCard']['Product']['name']; } else { echo 'No hay selección'; } ?></h2>
		<h1>Memoria RAM</h1>
		<h2><?php if(!empty($myPC['Memory'])) { echo $myPC['Memory'][1]['Product']['name']; } else { echo 'No hay selección'; } ?></h2>
		<h1>Discos duros</h1>
		<h2>algo</h2>
		<h1>Monitor</h1>
		<h2>algo</h2>
		<h1>Torre</h1>
		<h2>algo</h2>
		<h1>Fuente</h1>
		<h2>algo</h2>
		<h1>Unidades óptcas</h1>
		<h2>algo</h2>
		<h1>Periféricos</h1>
		<h2>algo</h2>
		<h1>Tarjetas adicionales</h1>
		<h2>algo</h2>
		<h1>Accesorios</h1>
		<h2>algo</h2>
	</div>
</div>
<?php //debug($myPC); ?>