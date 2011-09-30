<div class="productPictures index">
	<h2><?php __('Product Pictures');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
		<th><?php echo $this->Paginator->sort('id');?></th>
						
		<th><?php echo $this->Paginator->sort('name');?></th>
						
		<th><?php echo $this->Paginator->sort('image_path');?></th>
						
		<th><?php echo $this->Paginator->sort('product_id');?></th>
						
		<th><?php echo $this->Paginator->sort('created');?></th>
						
		<th><?php echo $this->Paginator->sort('updated');?></th>
					<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($productPictures as $productPicture):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $productPicture['ProductPicture']['id']; ?>&nbsp;</td>
		<td><?php echo $productPicture['ProductPicture']['name']; ?>&nbsp;</td>
		<td><?php echo $this->Html->image('uploads/100x100/'.$productPicture['ProductPicture']['image_path']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($productPicture['Product']['name'], array('controller' => 'products', 'action' => 'view', $productPicture['Product']['id'])); ?>
		</td>
		<td><?php echo $productPicture['ProductPicture']['created']; ?>&nbsp;</td>
		<td><?php echo $productPicture['ProductPicture']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__(' ', true), array('action' => 'view', $productPicture['ProductPicture']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'edit', $productPicture['ProductPicture']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'delete', $productPicture['ProductPicture']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $productPicture['ProductPicture']['id'])); ?>
			<?php if(isset($productPicture['ProductPicture']['active'])&& $productPicture['ProductPicture']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $productPicture['ProductPicture']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $productPicture['ProductPicture']['id']));
}?>
			<?php if(isset($productPicture['ProductPicture']['active'])&& !$productPicture['ProductPicture']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $productPicture['ProductPicture']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $productPicture['ProductPicture']['id'])); 
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
Notice: Undefined property: TemplateTask::$Html in F:\jucedogi\xampp\htdocs\colors\cake\console\templates\bloom\views\index.ctp on line 109
echo ->link(__('Add', true), array('action' => 'add'),array('class'=>'add'));</li>
		</ul>
	</div>
</div>