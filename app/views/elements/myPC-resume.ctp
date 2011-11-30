<div class="resumen">
	<h1>Resumen de la compra</h1>
	<div class="precio">
		<img src="/img/computador.jpg"/>
		<?php
			$myPC = $this->Session->read('myPC');
			$total = 0;
			foreach($myPC as $categoria) {
				if(!empty($categoria)) {
					if(isset($categoria['1'])) {
						$total += $categoria['1']['Product']['price'];
					} else {
						if(isset($categoria['2'])) {
							$total += $categoria['2']['Product']['price'];
						} else {
							$total += $categoria['Product']['price'];
						}
					}
				}
			}
		?>
		<h2>Precio total: $<?php echo number_format($total, 0, ' ', '.'); ?></h2>
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
		<h2><?php if(!empty($myPC['HardDrive'])) { echo $myPC['HardDrive'][1]['Product']['name']; } else { echo 'No hay selección'; } ?></h2>
		<h1>Monitor</h1>
		<h2><?php if(!empty($myPC['Monitor'])) { echo $myPC['Monitor'][1]['Product']['name']; } else { echo 'No hay selección'; } ?></h2>
		<h1>Torre</h1>
		<h2><?php if(!empty($myPC['Casing'])) { echo $myPC['Casing'][1]['Product']['name']; } else { echo 'No hay selección'; } ?></h2>
		<h1>Fuente</h1>
		<h2><?php if(!empty($myPC['PowerSupply'])) { echo $myPC['PowerSupply'][1]['Product']['name']; } else { echo 'No hay selección'; } ?></h2>
		<h1>Unidades óptcas</h1>
		<h2><?php if(!empty($myPC['OpticalDrive'])) { echo $myPC['OpticalDrive'][1]['Product']['name']; } else { echo 'No hay selección'; } ?></h2>
		<h1>Periféricos</h1>
		<h2><?php if(!empty($myPC['Peripherals'])) { echo $myPC['Peripherals'][1]['Product']['name']; } else { echo 'No hay selección'; } ?></h2>
	</div>
</div>
<?php //debug($myPC); ?>