<div class="sizes index">
	<h2><?php __('Sizes');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
									
							<th><?php echo $this->Paginator->sort('size_reference_id');?></th>
									
							<th><?php echo $this->Paginator->sort('subcategory_id');?></th>
									
							<th><?php echo $this->Paginator->sort('created');?></th>
									
							<th><?php echo $this->Paginator->sort('updated');?></th>
								<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($sizes as $size):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $size['Size']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($size['SizeReference']['size'], array('controller' => 'size_references', 'action' => 'view', $size['SizeReference']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($size['Subcategory']['name'], array('controller' => 'subcategories', 'action' => 'view', $size['Subcategory']['id'])); ?>
		</td>
		<td><?php echo $size['Size']['created']; ?>&nbsp;</td>
		<td><?php echo $size['Size']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $size['Size']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $size['Size']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $size['Size']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $size['Size']['id'])); ?>
			<?php if(isset($size['Size']['active'])&& $size['Size']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $size['Size']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $size['Size']['id']));
}?>
			<?php if(isset($size['Size']['active'])&& !$size['Size']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $size['Size']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $size['Size']['id'])); 
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
