<div class="pictures index">
	<h2><?php __('Pictures');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
		<th><?php echo $this->Paginator->sort('id');?></th>
						
		<th><?php echo $this->Paginator->sort('gallery_id');?></th>
						
		<th><?php echo $this->Paginator->sort('title');?></th>
						
		<th><?php echo $this->Paginator->sort('caption');?></th>
						
		<th><?php echo $this->Paginator->sort('image');?></th>
						
		<th><?php echo $this->Paginator->sort('alt');?></th>
						
		<th><?php echo $this->Paginator->sort('created');?></th>
						
		<th><?php echo $this->Paginator->sort('updated');?></th>
					<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($pictures as $picture):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $picture['Picture']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($picture['Gallery']['name'], array('controller' => 'galleries', 'action' => 'view', $picture['Gallery']['id'])); ?>
		</td>
		<td><?php echo $picture['Picture']['title']; ?>&nbsp;</td>
		<td><?php echo $picture['Picture']['caption']; ?>&nbsp;</td>
		<td><?php echo $this->Html->image('uploads/100x100/'.$picture['Picture']['image']); ?>&nbsp;</td>
		<td><?php echo $picture['Picture']['alt']; ?>&nbsp;</td>
		<td><?php echo $picture['Picture']['created']; ?>&nbsp;</td>
		<td><?php echo $picture['Picture']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__(' ', true), array('action' => 'view', $picture['Picture']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'edit', $picture['Picture']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'delete', $picture['Picture']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $picture['Picture']['id'])); ?>
			<?php if(isset($picture['Picture']['active'])&& $picture['Picture']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $picture['Picture']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $picture['Picture']['id']));
}?>
			<?php if(isset($picture['Picture']['active'])&& !$picture['Picture']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $picture['Picture']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $picture['Picture']['id'])); 
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