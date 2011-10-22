<div class="products index">
	<h2><?php __('Products');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
									
					<th><?php echo $this->Paginator->sort('product_type_id');?></th>
									
					<th><?php echo $this->Paginator->sort('architecture_id');?></th>
									
					<th><?php echo $this->Paginator->sort('socket_id');?></th>
									
					<th><?php echo $this->Paginator->sort('slot_id');?></th>
									
					<th><?php echo $this->Paginator->sort('name');?></th>
									
					<th><?php echo $this->Paginator->sort('description');?></th>
									
					<th><?php echo $this->Paginator->sort('ref');?></th>
									
					<th><?php echo $this->Paginator->sort('price');?></th>
									
					<th><?php echo $this->Paginator->sort('image');?></th>
									
					<th><?php echo $this->Paginator->sort('slug');?></th>
									
					<th><?php echo $this->Paginator->sort('keywords');?></th>
									
					<th><?php echo $this->Paginator->sort('created');?></th>
									
					<th><?php echo $this->Paginator->sort('updated');?></th>
								<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($products as $product):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $this->Html->link($product['ProductType']['name'], array('controller' => 'product_types', 'action' => 'view', $product['ProductType']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($product['Architecture']['name'], array('controller' => 'architectures', 'action' => 'view', $product['Architecture']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($product['Socket']['name'], array('controller' => 'sockets', 'action' => 'view', $product['Socket']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($product['Slot']['name'], array('controller' => 'slots', 'action' => 'view', $product['Slot']['id'])); ?>
		</td>
		<td><?php echo $product['Product']['name']; ?>&nbsp;</td>
		<td><?php echo $product['Product']['description']; ?>&nbsp;</td>
		<td><?php echo $product['Product']['ref']; ?>&nbsp;</td>
		<td><?php echo $product['Product']['price']; ?>&nbsp;</td>
		<td><?php echo $this->Html->image('uploads/100x100/'.$product['Product']['image']); ?>&nbsp;</td>
		<td><?php echo $product['Product']['slug']; ?>&nbsp;</td>
		<td><?php echo $product['Product']['keywords']; ?>&nbsp;</td>
		<td><?php echo $product['Product']['created']; ?>&nbsp;</td>
		<td><?php echo $product['Product']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $product['Product']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $product['Product']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__('Gallery', true), array('controller' => 'product_pictures','action'=>'view', $product['Product']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $product['Product']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $product['Product']['id'])); ?>
			<?php if(isset($product['Product']['active'])&& $product['Product']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $product['Product']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $product['Product']['id']));
}?>
			<?php if(isset($product['Product']['active'])&& !$product['Product']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $product['Product']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $product['Product']['id'])); 
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
