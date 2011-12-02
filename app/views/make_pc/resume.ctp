<?php $myPC = $this -> requestAction('/make_pc/getMyPC');?>
<div class="resumen-productos">
	<table class="tabla-resumen-productos">
		<tr class="info-producto">
			<td class="categoria-producto"><?php echo __('Processor', true); ?></td>
			<td class="nombre-producto"><?php
			if (!empty($myPC['Processor'])) {
				if (isset($myPC['Processor']['1']['Product']['name']))
					echo $myPC['Processor']['1']['Product']['name'];
				if (isset($myPC['Processor']['2']['Product']['name']))
					echo $myPC['Processor']['2']['Product']['name'] . ' x 2';
				if (isset($myPC['Processor']['Product']['name']))
					echo $myPC['Processor']['Product']['name'];
			} else {
				echo 'No se ha seleccionado un producto.';
			}
			?></td>
		</tr>
		<tr class="info-producto">
			<td class="categoria-producto"><?php echo __('Motherboard', true); ?></td>
			<td class="nombre-producto"><?php
			if (!empty($myPC['Motherboard'])) {
				if (isset($myPC['Motherboard']['1']['Product']['name']))
					echo $myPC['Motherboard']['1']['Product']['name'];
				if (isset($myPC['Motherboard']['2']['Product']['name']))
					echo $myPC['Motherboard']['2']['Product']['name'] . ' x 2';
				if (isset($myPC['Motherboard']['Product']['name']))
					echo $myPC['Motherboard']['Product']['name'];
			} else {
				echo 'No se ha seleccionado un producto.';
			}
			?></td>
		</tr>
		<tr class="info-producto">
			<td class="categoria-producto"><?php echo __('Memory', true); ?></td>
			<td class="nombre-producto"><?php
			if (!empty($myPC['Memory'])) {
				if (isset($myPC['Memory']['1']['Product']['name']))
					echo $myPC['Memory']['1']['Product']['name'];
				if (isset($myPC['Memory']['2']['Product']['name']))
					echo $myPC['Memory']['2']['Product']['name'] . ' x 2';
				if (isset($myPC['Memory']['Product']['name']))
					echo $myPC['Memory']['Product']['name'];
			} else {
				echo 'No se ha seleccionado un producto.';
			}
			?></td>
		</tr>
		<tr class="info-producto">
			<td class="categoria-producto"><?php echo __('Hard Drive', true); ?></td>
			<td class="nombre-producto"><?php
			if (!empty($myPC['HardDrive'])) {
				if (isset($myPC['HardDrive']['1']['Product']['name']))
					echo $myPC['HardDrive']['1']['Product']['name'];
				if (isset($myPC['HardDrive']['2']['Product']['name']))
					echo $myPC['HardDrive']['2']['Product']['name'] . ' x 2';
				if (isset($myPC['HardDrive']['Product']['name']))
					echo $myPC['HardDrive']['Product']['name'];
			} else {
				echo 'No se ha seleccionado un producto.';
			}
			?></td>
		</tr>
		<tr class="info-producto">
			<td class="categoria-producto"><?php echo __('Video Card', true); ?></td>
			<td class="nombre-producto"><?php
			if (!empty($myPC['VideoCard'])) {
				if (isset($myPC['VideoCard']['1']['Product']['name']))
					echo $myPC['VideoCard']['1']['Product']['name'];
				if (isset($myPC['VideoCard']['2']['Product']['name']))
					echo $myPC['VideoCard']['2']['Product']['name'] . ' x 2';
				if (isset($myPC['VideoCard']['Product']['name']))
					echo $myPC['VideoCard']['Product']['name'];
			} else {
				echo 'No se ha seleccionado un producto.';
			}
			?></td>
		</tr>
		<tr class="info-producto">
			<td class="categoria-producto"><?php echo __('Casing', true); ?></td>
			<td class="nombre-producto"><?php
			if (!empty($myPC['Casing'])) {
				if (isset($myPC['Casing']['1']['Product']['name']))
					echo $myPC['Casing']['1']['Product']['name'];
				if (isset($myPC['Casing']['2']['Product']['name']))
					echo $myPC['Casing']['2']['Product']['name'] . ' x 2';
				if (isset($myPC['Casing']['Product']['name']))
					echo $myPC['Casing']['Product']['name'];
			} else {
				echo 'No se ha seleccionado un producto.';
			}
			?></td>
		</tr>
		<tr class="info-producto">
			<td class="categoria-producto"><?php echo __('Power Supply', true); ?></td>
			<td class="nombre-producto"><?php
			if (!empty($myPC['PowerSupply'])) {
				if (isset($myPC['PowerSupply']['1']['Product']['name']))
					echo $myPC['PowerSupply']['1']['Product']['name'];
				if (isset($myPC['PowerSupply']['2']['Product']['name']))
					echo $myPC['PowerSupply']['2']['Product']['name'] . ' x 2';
				if (isset($myPC['PowerSupply']['Product']['name']))
					echo $myPC['PowerSupply']['Product']['name'];
			} else {
				echo 'No se ha seleccionado un producto.';
			}
			?></td>
		</tr>
		<tr class="info-producto">
			<td class="categoria-producto"><?php echo __('Monitor', true); ?></td>
			<td class="nombre-producto"><?php
			if (!empty($myPC['Monitor'])) {
				if (isset($myPC['Monitor']['1']['Product']['name']))
					echo $myPC['Monitor']['1']['Product']['name'];
				if (isset($myPC['Monitor']['2']['Product']['name']))
					echo $myPC['Monitor']['2']['Product']['name'] . ' x 2';
				if (isset($myPC['Monitor']['Product']['name']))
					echo $myPC['Monitor']['Product']['name'];
			} else {
				echo 'No se ha seleccionado un producto.';
			}
			?></td>
		</tr>
		<tr class="info-producto">
			<td class="categoria-producto"><?php echo __('Cards', true); ?></td>
			<td class="nombre-producto"><?php
			if (!empty($myPC['Cards'])) {
				if (isset($myPC['Cards']['1']['Product']['name']))
					echo $myPC['Cards']['1']['Product']['name'];
				if (isset($myPC['Cards']['2']['Product']['name']))
					echo $myPC['Cards']['2']['Product']['name'] . ' x 2';
				if (isset($myPC['Cards']['Product']['name']))
					echo $myPC['Cards']['Product']['name'];
			} else {
				echo 'No se ha seleccionado un producto.';
			}
			?></td>
		</tr>
		<tr class="info-producto">
			<td class="categoria-producto"><?php echo __('Accesories', true); ?></td>
			<td class="nombre-producto"><?php
			if (!empty($myPC['Accesories'])) {
				if (isset($myPC['Accesories']['1']['Product']['name']))
					echo $myPC['Accesories']['1']['Product']['name'];
				if (isset($myPC['Accesories']['2']['Product']['name']))
					echo $myPC['Accesories']['2']['Product']['name'] . ' x 2';
				if (isset($myPC['Accesories']['Product']['name']))
					echo $myPC['Accesories']['Product']['name'];
			} else {
				echo 'No se ha seleccionado un producto.';
			}
			?></td>
		</tr>
		<tr class="info-producto">
			<td class="categoria-producto"><?php echo __('Mouse', true); ?></td>
			<td class="nombre-producto"><?php
			if (!empty($myPC['Mouse'])) {
				if (isset($myPC['Mouse']['1']['Product']['name']))
					echo $myPC['Mouse']['1']['Product']['name'];
				if (isset($myPC['Mouse']['2']['Product']['name']))
					echo $myPC['Mouse']['2']['Product']['name'] . ' x 2';
				if (isset($myPC['Mouse']['Product']['name']))
					echo $myPC['Mouse']['Product']['name'];
			} else {
				echo 'No se ha seleccionado un producto.';
			}
			?></td>
		</tr>
		<tr class="info-producto">
			<td class="categoria-producto"><?php echo __('Keyboard', true); ?></td>
			<td class="nombre-producto"><?php
			if (!empty($myPC['Keyboard'])) {
				if (isset($myPC['Keyboard']['1']['Product']['name']))
					echo $myPC['Keyboard']['1']['Product']['name'];
				if (isset($myPC['Keyboard']['2']['Product']['name']))
					echo $myPC['Keyboard']['2']['Product']['name'] . ' x 2';
				if (isset($myPC['Keyboard']['Product']['name']))
					echo $myPC['Keyboard']['Product']['name'];
			} else {
				echo 'No se ha seleccionado un producto.';
			}
			?></td>
		</tr>
		
		
		<tr class="total-producto">
			<td class="nombre-total">Total</td>
			<td class="precio-total">$<?php echo number_format($this -> requestAction('/make_pc/getMyPCTotal'), 0, ' ', '.');?></td>
		</tr>
	</table>
	<div class="imprimir-pagar-producto">
		<div style="clear: both"></div>
		
		<a href="" class="pagar">Pagar</a>
	</div>
</div>
