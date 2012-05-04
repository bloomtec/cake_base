<h1>Mis pedidos</h1>
<?php if($orders){?>
<table id="ordenes">
	<tr>
		<th>Código</th>
		<th>Estado</th>
		<th>Promocion</th>
		<th>Fecha</th>
	</tr>

<?php foreach($orders as $order):?>
	<tr>
		<td><?php echo $order['Order']['code']; ?></td>
		<td><?php echo $order['OrderState']['name']; ?></td>
		<td>
			<?php echo $html->image("uploads/".$order['Deal']['image'],array('width'=>250)); ?>
			<?php echo $order['Deal']['name']; ?>
		</td>
		<td><?php echo $order['Order']['created']; ?></td>
	</tr>
<?php endforeach; ?>
</table>
<?php }else{ ?>
	<p class="message">NO TIENES ORDENES</p>
<?php } ?>