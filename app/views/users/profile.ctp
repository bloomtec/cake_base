<h1><?php __('Mis pedidos'); ?></h1>
<?php if($orders){?>
<table id="ordenes">
	<tr>
		<th><?php __('Código');?></th>
		<th><?php __('Estado');?></th>
		<th><?php __('Promocion');?></th>
		<th><?php __('Fecha');?></th>
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
	<p class="message"><?php __('NO TIENES ORDENES');?></p>
<?php } ?>