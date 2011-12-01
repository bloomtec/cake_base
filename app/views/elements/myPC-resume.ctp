<div class="resumen">
	<h1>Resumen de la compra</h1>
	<!--
	<div class="precio">
		<img src="/img/computador.jpg"/>
		<h2>Precio total: $<?php echo number_format($this->requestAction('/make_pc/getMyPCTotal'), 0, ' ', '.'); ?></h2>
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
	-->
	<?php $myPC=$this->requestAction('/make_pc/getMyPC'); ?>
	<div class="resumen-productos">
		<table class="tabla-resumen-productos">
			<?php foreach($myPC as $categoria=>$producto) : ?>
			<tr class="info-producto">
				<td class="categoria-producto"><?php echo $categoria; ?></td>
				<td class="nombre-producto">
					<?php
						if(!empty($producto)) {
							if(isset($producto['1']['Product']['name'])) echo $producto['1']['Product']['name'];
							if(isset($producto['2']['Product']['name'])) echo $producto['2']['Product']['name'];
							if(isset($producto['Product']['name'])) echo $producto['Product']['name'];
						} else {
							echo 'No se ha seleccionado un producto.';
						}
					?>
				</td>
			</tr>
			<?php endforeach; ?>
			<tr class="total-producto">
				<td class="nombre-total">Total</td>
				<td class="precio-total">$<?php echo number_format($this->requestAction('/make_pc/getMyPCTotal'), 0, ' ', '.'); ?></td>
			</tr>
			<tr class="imprimir-pagar-producto">
				<td class="imprimir">Imprimir</td>
				<td class="pagar">Pagar</td>
			</tr>
		</table>
		<!--
		<h1>Procesador</h1>
		<h2><?php if(!empty($myPC['Processor'])) { echo $myPC['Processor']['Product']['name']; } else { echo 'No hay selección'; } ?></h2>
		<h1>Tarjeta madre</h1>
		<h2><?php if(!empty($myPC['Motherboard'])) { echo $myPC['Motherboard']['Product']['name']; } else { echo 'No hay selección'; } ?></h2>
		<h1>Tarjeta de video</h1>
		<h2>
			<?php
				if(!empty($myPC['VideoCard'])) {
					if(isset($myPC['VideoCard']['1'])) echo $myPC['VideoCard']['1']['Product']['name'];
					if(isset($myPC['VideoCard']['2'])) echo $myPC['VideoCard']['2']['Product']['name'];
				} else {
					echo 'No hay selección';
				} 
			?>
		</h2>
		<h1>Memoria RAM</h1>
		<h2>
			<?php
				if(!empty($myPC['Memory'])) {
					if(isset($myPC['Memory']['1'])) echo $myPC['Memory']['1']['Product']['name'];
					if(isset($myPC['Memory']['2'])) echo $myPC['Memory']['2']['Product']['name'];
				} else {
					echo 'No hay selección';
				} 
			?>
		</h2>
		<h1>Discos duros</h1>
		<h2>
			<?php
				if(!empty($myPC['Memory'])) {
					if(isset($myPC['HardDrive']['1'])) echo $myPC['HardDrive']['1']['Product']['name'];
					if(isset($myPC['HardDrive']['2'])) echo $myPC['HardDrive']['2']['Product']['name'];
				} else {
					echo 'No hay selección';
				} 
			?>
		</h2>
		<h1>Monitor</h1>
		<h2>
			<?php
				if(!empty($myPC['Memory'])) {
					if(isset($myPC['Monitor']['1'])) echo $myPC['Monitor']['1']['Product']['name'];
					if(isset($myPC['Monitor']['2'])) echo $myPC['Monitor']['2']['Product']['name'];
				} else {
					echo 'No hay selección';
				} 
			?>
		</h2>
		<h1>Torre</h1>
		<h2><?php if(!empty($myPC['Casing'])) { echo $myPC['Casing'][1]['Product']['name']; } else { echo 'No hay selección'; } ?></h2>
		<h1>Fuente</h1>
		<h2><?php if(!empty($myPC['PowerSupply'])) { echo $myPC['PowerSupply'][1]['Product']['name']; } else { echo 'No hay selección'; } ?></h2>
		<h1>Unidades óptcas</h1>
		<h2><?php if(!empty($myPC['OpticalDrive'])) { echo $myPC['OpticalDrive'][1]['Product']['name']; } else { echo 'No hay selección'; } ?></h2>
		<h1>Periféricos</h1>
		<h2><?php if(!empty($myPC['Peripherals'])) { echo $myPC['Peripherals'][1]['Product']['name']; } else { echo 'No hay selección'; } ?></h2>
		-->
	</div>
</div>