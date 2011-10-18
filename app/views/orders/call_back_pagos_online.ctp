<?php
	//comparacion de las firmas para comprobar que los datos si vienen de Pagosonline
	if(strtoupper($firma)==strtoupper($firmacreada)) :
?>
<table width="%100" border="1">
	<tr>
		<td>Nombre de la empresa</td>
		<td>Colors Tennis</td>
	</tr>
	<tr>
		<td>RUT</td>
		<td>1130618737</td>
	</tr>
	<tr>
		<td>Fecha de procesamiento</td>
		<td><?php echo $fecha_procesamiento;?></td>
	</tr>
	<tr>
		<td>Estado de la transaccion</td>
		<td><?php echo $estadoTx;?> </td>
	</tr>
	<tr>
		<td>referencia de la venta </td>
		<td><?php echo $ref_venta;?> </td> </tr>
	<tr>
		<td>Referencia de la transaccion </td>
		<td><?php echo $ref_pol;?> </td>
	</tr>
	<tr>
	<?php if($banco_pse!=null) : ?>
	<tr>
		<td>cus </td>
		<td><?php echo $cus;?> </td>
	</tr>
	<tr>
		<td>Banco </td>
		<td><?php echo $banco_pse;?> </td>
	</tr>
	<?php endif; ?>
	<tr>
		<td>Valor total</td>
		<td><?php echo number_format($valor);?> </td>
	</tr>
	<tr>
		<td>moneda </td>
		<td><?php echo $moneda;?></td>
	</tr>
	<tr>
		<td>Descripción:</td>
		<td><?php echo $descripcion;?></td>
	</tr>
</table>

<input type="button" name="imprimir" value="Imprimir Recibo" onclick="window.print();">
<br />
Si tiene alguna duda acerca de esta transacci&oacute;n por favor cumun&iacute;quese con nuestro servicio al cliente al tel&eacute;fono XXX.
	
<?php endif; ?>