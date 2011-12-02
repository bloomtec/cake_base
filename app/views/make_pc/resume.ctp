<?php $myPC = $this -> requestAction('/make_pc/getMyPC');?>
<div class="resumen-productos">
	<table class="tabla-resumen-productos">
		<?php foreach($myPC as $categoria=>$producto) :
		?>
		<tr class="info-producto">
			<td class="categoria-producto"><?php echo $categoria;?></td>
			<td class="nombre-producto"><?php
			if (!empty($producto)) {
				if (isset($producto['1']['Product']['name']))
					echo $producto['1']['Product']['name'];
				if (isset($producto['2']['Product']['name']))
					echo $producto['2']['Product']['name'] . 'x 2';
				if (isset($producto['Product']['name']))
					echo $producto['Product']['name'];
			} else {
				echo 'No se ha seleccionado un producto.';
			}
			?></td>
		</tr>
		<?php endforeach;?>
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
