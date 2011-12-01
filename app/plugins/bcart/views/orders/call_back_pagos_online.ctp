<?php
	//comparacion de las firmas para comprobar que los datos si vienen de Pagosonline
	if(strtoupper($firma)==strtoupper($firmacreada)) :
?>
<h1 class="recibo twCenMt">RECIBO DE  CAJA</h1>
<table width="%100" class="recibo tahoma">
	<tr>
		<td class="azul">Nombre de la empresa</td>
		<td class="gris">Colors Tennis</td>
	</tr>
	<tr>
		<td class="azul">RUT</td>
		<td class="gris">1130618737</td>
	</tr>
	<tr>
		<td class="azul">Fecha de procesamiento</td>
		<td class="gris"><?php echo $fecha_procesamiento;?></td>
	</tr>
	<tr>
		<td class="azul">Estado de la transaccion</td>
		<td class="gris"><?php echo $estadoTx;?></td>
	</tr>
	<tr>
		<td class="azul">referencia de la venta</td>
		<td class="gris"><?php  echo $ref_venta;?> </td>
	</tr>
	<tr>
		<td class="azul">Referencia de la transaccion</td>
		<td class="gris"><?php echo $ref_pol;?></td>
	</tr>
	<tr>
	<?php if($banco_pse!=null) : ?>
	<tr>
		<td class="azul">cus</td>
		<td class="gris"><?php echo $cus;?></td>
	</tr>
	<tr>
		<td class="azul">Banco </td>
		<td class="gris"><?php echo $banco_pse;?></td>
	</tr>
	<?php endif; ?>
	<tr>
		<td class="azul">Valor total</td>
		<td class="gris">$<?php echo number_format($valor);?></td>
	</tr>
	<tr>
		<td class="azul">moneda</td>
		<td class="gris"><?php echo $moneda;?></td>
	</tr>
	<tr>
		<td class="azul">Descripción:</td>
		<td class="gris"><?php echo $descripcion;?></td>
	</tr>

			

</table>
<input type="button" name="imprimir" value="Imprimir" class="submit_rosado" onclick="window.print();">
<br />
<?php endif; ?>