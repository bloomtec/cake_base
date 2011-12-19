
<div class="addresses index">
	<h2><?php __('Addresses');?></h2>
	<table cellpadding="0" cellspacing="0" >
	<tr  >
		<th><?php echo $this->Paginator->sort('user_id');?></th>
		<th><?php echo $this->Paginator->sort('country');?></th>
		<th><?php echo $this->Paginator->sort('state');?></th>
		<th><?php echo $this->Paginator->sort('city');?></th>
		<th><?php echo $this->Paginator->sort('address_line_1');?></th>
		<th><?php echo $this->Paginator->sort('address_line_2');?></th>
		<th><?php echo $this->Paginator->sort('phone');?></th>
		<th><?php echo $this->Paginator->sort('created');?></th>
		<th><?php echo $this->Paginator->sort('updated');?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($addresses as $address):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?> id='<?php echo $address['Address']['id'] ?>'>
		<td>
			<?php echo $this->Html->link($address['User']['email'], array('controller' => 'users', 'action' => 'view', $address['User']['id'])); ?>
		</td>
		<td><?php echo $address['Address']['country']; ?>&nbsp;</td>
		<td><?php echo $address['Address']['state']; ?>&nbsp;</td>
		<td><?php echo $address['Address']['city']; ?>&nbsp;</td>
		<td><?php echo $address['Address']['address_line_1']; ?>&nbsp;</td>
		<td><?php echo $address['Address']['address_line_2']; ?>&nbsp;</td>
		<td><?php echo $address['Address']['phone']; ?>&nbsp;</td>
		<td><?php echo $address['Address']['created']; ?>&nbsp;</td>
		<td><?php echo $address['Address']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $address['Address']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $address['Address']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $address['Address']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $address['Address']['id'])); ?>
			<?php if(isset($address['Address']['active'])&& $address['Address']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $address['Address']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $address['Address']['id']));
}?>
			<?php if(isset($address['Address']['active'])&& !$address['Address']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $address['Address']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $address['Address']['id'])); 
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
