<div class="orderItems index">
	<h2><?php __('Order Items');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $this->Paginator->sort('order_id');?></th>
		<th><?php echo $this->Paginator->sort('model_name');?></th>
		<th><?php echo $this->Paginator->sort('foreign_key');?></th>
		<th><?php echo $this->Paginator->sort('size_id');?></th>
		<th><?php echo $this->Paginator->sort('is_gift');?></th>
		<th><?php echo $this->Paginator->sort('quantity');?></th>
		<th><?php echo $this->Paginator->sort('price_item');?></th>
		<th><?php echo $this->Paginator->sort('price_total');?></th>
		<th><?php echo $this->Paginator->sort('nombre');?></th>
		<th><?php echo $this->Paginator->sort('apellido');?></th>
		<th><?php echo $this->Paginator->sort('pais');?></th>
		<th><?php echo $this->Paginator->sort('estado');?></th>
		<th><?php echo $this->Paginator->sort('ciudad');?></th>
		<th><?php echo $this->Paginator->sort('direccion');?></th>
		<th><?php echo $this->Paginator->sort('telefono');?></th>
		<th><?php echo $this->Paginator->sort('transportadora');?></th>
		<th><?php echo $this->Paginator->sort('guia');?></th>
		<th><?php echo $this->Paginator->sort('web_transportadora');?></th>
		<th><?php echo $this->Paginator->sort('created');?></th>
		<th><?php echo $this->Paginator->sort('updated');?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($orderItems as $orderItem):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $this->Html->link($orderItem['Order']['code'], array('controller' => 'orders', 'action' => 'view', $orderItem['Order']['id'])); ?>
		</td>
		<td><?php echo $orderItem['OrderItem']['model_name']; ?>&nbsp;</td>
		<td><?php echo $orderItem['OrderItem']['foreign_key']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($orderItem['Size']['size_reference_id'], array('controller' => 'sizes', 'action' => 'view', $orderItem['Size']['id'])); ?>
		</td>
		<td><?php echo $orderItem['OrderItem']['is_gift']; ?>&nbsp;</td>
		<td><?php echo $orderItem['OrderItem']['quantity']; ?>&nbsp;</td>
		<td><?php echo $orderItem['OrderItem']['price_item']; ?>&nbsp;</td>
		<td><?php echo $orderItem['OrderItem']['price_total']; ?>&nbsp;</td>
		<td><?php echo $orderItem['OrderItem']['nombre']; ?>&nbsp;</td>
		<td><?php echo $orderItem['OrderItem']['apellido']; ?>&nbsp;</td>
		<td><?php echo $orderItem['OrderItem']['pais']; ?>&nbsp;</td>
		<td><?php echo $orderItem['OrderItem']['estado']; ?>&nbsp;</td>
		<td><?php echo $orderItem['OrderItem']['ciudad']; ?>&nbsp;</td>
		<td><?php echo $orderItem['OrderItem']['direccion']; ?>&nbsp;</td>
		<td><?php echo $orderItem['OrderItem']['telefono']; ?>&nbsp;</td>
		<td><?php echo $orderItem['OrderItem']['transportadora']; ?>&nbsp;</td>
		<td><?php echo $orderItem['OrderItem']['guia']; ?>&nbsp;</td>
		<td><?php echo $orderItem['OrderItem']['web_transportadora']; ?>&nbsp;</td>
		<td><?php echo $orderItem['OrderItem']['created']; ?>&nbsp;</td>
		<td><?php echo $orderItem['OrderItem']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $orderItem['OrderItem']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $orderItem['OrderItem']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $orderItem['OrderItem']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $orderItem['OrderItem']['id'])); ?>
			<?php if(isset($orderItem['OrderItem']['active'])&& $orderItem['OrderItem']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $orderItem['OrderItem']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $orderItem['OrderItem']['id']));
}?>
			<?php if(isset($orderItem['OrderItem']['active'])&& !$orderItem['OrderItem']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $orderItem['OrderItem']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $orderItem['OrderItem']['id'])); 
}?>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
	<div class="actions">
		<ul>
			<li>	<?php echo $this->Html->link(__('Add', true), array('action' => 'add'),array('class'=>'add')); ?>
</li>
		</ul>
	</div>
</div>
