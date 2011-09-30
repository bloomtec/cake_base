<div class="products index">
	<h2><?php __('Products');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
									
							<th><?php echo $this->Paginator->sort('name');?></th>
									
							<th><?php echo $this->Paginator->sort('image');?></th>
									
							<th><?php echo $this->Paginator->sort('clasification');?></th>
									
							<th><?php echo $this->Paginator->sort('collection_id');?></th>
									
							<th><?php echo $this->Paginator->sort('subcategory_id');?></th>
									
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
		<td><?php echo $product['Product']['id']; ?>&nbsp;</td>
		<td><?php echo $product['Product']['name']; ?>&nbsp;</td>
		<td><?php echo $this->Html->image('uploads/100x100/'.$product['Product']['image']); ?>&nbsp;</td>
		<td><?php echo $product['Product']['clasification']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($product['Collection']['name'], array('controller' => 'collections', 'action' => 'view', $product['Collection']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($product['Subcategory']['name'], array('controller' => 'subcategories', 'action' => 'view', $product['Subcategory']['id'])); ?>
		</td>
		<td><?php echo $product['Product']['created']; ?>&nbsp;</td>
		<td><?php echo $product['Product']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $product['Product']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $product['Product']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__('Gallery', true), array('controller' => 'product_pictures','action'=>'index'),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $product['Product']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $product['Product']['id'])); ?>
			<?php if(isset($product['Product']['active'])&& $product['Product']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $product['Product']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $product['Product']['id']));
}?>
			<?php if(isset($product['Product']['active'])&& !$product['Product']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $product['Product']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $product['Product']['id'])); 
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
