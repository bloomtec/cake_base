<div class="subcategories index">
	<h2><?php __('Subcategories');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
		<th><?php echo $this->Paginator->sort('id');?></th>
						
		<th><?php echo $this->Paginator->sort('name');?></th>
						
		<th><?php echo $this->Paginator->sort('image');?></th>
						
		<th><?php echo $this->Paginator->sort('sort');?></th>
						
		<th><?php echo $this->Paginator->sort('brand_id');?></th>
						
		<th><?php echo $this->Paginator->sort('created');?></th>
						
		<th><?php echo $this->Paginator->sort('updated');?></th>
					<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($subcategories as $subcategory):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $subcategory['Subcategory']['id']; ?>&nbsp;</td>
		<td><?php echo $subcategory['Subcategory']['name']; ?>&nbsp;</td>
		<td><?php echo $this->Html->image('uploads/100x100/'.$subcategory['Subcategory']['image']); ?>&nbsp;</td>
		<td><?php echo $subcategory['Subcategory']['sort']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($subcategory['Brand']['name'], array('controller' => 'brands', 'action' => 'view', $subcategory['Brand']['id'])); ?>
		</td>
		<td><?php echo $subcategory['Subcategory']['created']; ?>&nbsp;</td>
		<td><?php echo $subcategory['Subcategory']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__(' ', true), array('action' => 'view', $subcategory['Subcategory']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'edit', $subcategory['Subcategory']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'delete', $subcategory['Subcategory']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $subcategory['Subcategory']['id'])); ?>
			<?php if(isset($subcategory['Subcategory']['active'])&& $subcategory['Subcategory']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $subcategory['Subcategory']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $subcategory['Subcategory']['id']));
}?>
			<?php if(isset($subcategory['Subcategory']['active'])&& !$subcategory['Subcategory']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $subcategory['Subcategory']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $subcategory['Subcategory']['id'])); 
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
			<li>
Notice: Undefined property: TemplateTask::$Html in D:\Desarrollo\xampp\htdocs\colors\cake\console\templates\bloom\views\index.ctp on line 109
echo ->link(__('Add', true), array('action' => 'add'),array('class'=>'add'));</li>
		</ul>
	</div>
</div>