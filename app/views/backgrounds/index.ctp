<?php echo $this->Html->script('sortable');?>
<div class="backgrounds index">
	<h2><?php __('Backgrounds');?></h2>
	<table cellpadding="0" cellspacing="0" id="sortable" controller="backgrounds">
	<tr class="ui-state-disabled" >
		<th ><?php echo $this->Paginator->sort('sort');?></th>
		<th><?php echo $this->Paginator->sort('name');?></th>
		<th><?php echo $this->Paginator->sort('description');?></th>
		<th><?php echo $this->Paginator->sort('image');?></th>
		<th><?php echo $this->Paginator->sort('Status','is_active');?></th>
		<th><?php echo $this->Paginator->sort('created');?></th>
		<th><?php echo $this->Paginator->sort('updated');?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($backgrounds as $background):
		$class = ' class=" ui-state-default "';
		if ($i++ % 2 == 0) {
			$class = ' class="altrow ui-state-default "';
		}
	?>
	<tr<?php echo $class;?> id='<?php echo $background['Background']['id'] ?>'>
		<td class='sort'>
			<?php echo $background['Background']['sort'] ?>
		</td>
		<td><?php echo $background['Background']['name']; ?>&nbsp;</td>
		<td><?php echo $background['Background']['description']; ?>&nbsp;</td>
		<td><?php echo $this->Html->image('uploads/100x100/'.$background['Background']['image']); ?>&nbsp;</td>
		<td><?php echo $background['Background']['is_active']; ?>&nbsp;</td>
		<td><?php echo $background['Background']['created']; ?>&nbsp;</td>
		<td><?php echo $background['Background']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $background['Background']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $background['Background']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $background['Background']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $background['Background']['id'])); ?>
			<?php if(isset($background['Background']['active'])&& $background['Background']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $background['Background']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $background['Background']['id']));
}?>
			<?php if(isset($background['Background']['active'])&& !$background['Background']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $background['Background']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $background['Background']['id'])); 
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
