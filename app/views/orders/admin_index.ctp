
<div class="orders index">
	<h2><?php __('Orders');?></h2>
	<table cellpadding="0" cellspacing="0" >
	<tr  >
		<th><?php echo $this->Paginator->sort('code');?></th>
		<th><?php echo $this->Paginator->sort('user_id');?></th>
		<th><?php echo $this->Paginator->sort('address_id');?></th>
		<th><?php echo $this->Paginator->sort('quantity');?></th>
		<th><?php echo $this->Paginator->sort('deal_id');?></th>
		<th><?php echo $this->Paginator->sort('order_state_id');?></th>
		<th><?php echo $this->Paginator->sort('created');?></th>
		<th><?php echo $this->Paginator->sort('updated');?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($orders as $order):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?> id='<?php echo $order['Order']['id'] ?>'>
		<td><?php echo $order['Order']['code']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($order['User']['email'], array('controller' => 'users', 'action' => 'view', $order['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($order['Address']['name'], array('controller' => 'addresses', 'action' => 'view', $order['Address']['id'])); ?>
		</td>
		<td><?php echo $order['Order']['quantity']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($order['Deal']['name'], array('controller' => 'deals', 'action' => 'view', $order['Deal']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($order['OrderState']['name'], array('controller' => 'order_states', 'action' => 'view', $order['OrderState']['state_id'])); ?>
		</td>
		<td><?php echo $order['Order']['created']; ?>&nbsp;</td>
		<td><?php echo $order['Order']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $order['Order']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $order['Order']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $order['Order']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $order['Order']['id'])); ?>
			<?php if(isset($order['Order']['active'])&& $order['Order']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $order['Order']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $order['Order']['id']));
}?>
			<?php if(isset($order['Order']['active'])&& !$order['Order']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $order['Order']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $order['Order']['id'])); 
}?>
		</td>
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
