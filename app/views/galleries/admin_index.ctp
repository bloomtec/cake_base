<div class="galleries index">
	<h2><?php __('Galleries');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				

						
		<th><?php echo $this->Paginator->sort('name');?></th>
						
		<th><?php echo $this->Paginator->sort('description');?></th>
						
		<th><?php echo $this->Paginator->sort('created');?></th>
						
		<th><?php echo $this->Paginator->sort('updated');?></th>
					<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($galleries as $gallery):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>

		<td><?php echo $gallery['Gallery']['name']; ?>&nbsp;</td>
		<td><?php echo $gallery['Gallery']['description']; ?>&nbsp;</td>
		<td><?php echo $gallery['Gallery']['created']; ?>&nbsp;</td>
		<td><?php echo $gallery['Gallery']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__(' ', true), array('action' => 'view', $gallery['Gallery']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'edit', $gallery['Gallery']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php //echo $this->Html->link(__(' ', true), array('action' => 'delete', $gallery['Gallery']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $gallery['Gallery']['id'])); ?>
			<?php if(isset($gallery['Gallery']['active'])&& $gallery['Gallery']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $gallery['Gallery']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $gallery['Gallery']['id']));
}?>
			<?php if(isset($gallery['Gallery']['active'])&& !$gallery['Gallery']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $gallery['Gallery']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $gallery['Gallery']['id'])); 
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
</div>