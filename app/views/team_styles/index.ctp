<div class="teamStyles index">
	<h2><?php __('Team Styles');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
		<th><?php echo $this->Paginator->sort('id');?></th>
						
		<th><?php echo $this->Paginator->sort('name');?></th>
					<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($teamStyles as $teamStyle):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $teamStyle['TeamStyle']['id']; ?>&nbsp;</td>
		<td><?php echo $teamStyle['TeamStyle']['name']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__(' ', true), array('action' => 'view', $teamStyle['TeamStyle']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'edit', $teamStyle['TeamStyle']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'delete', $teamStyle['TeamStyle']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $teamStyle['TeamStyle']['id'])); ?>
			<?php if(isset($teamStyle['TeamStyle']['active'])&& $teamStyle['TeamStyle']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $teamStyle['TeamStyle']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $teamStyle['TeamStyle']['id']));
}?>
			<?php if(isset($teamStyle['TeamStyle']['active'])&& !$teamStyle['TeamStyle']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $teamStyle['TeamStyle']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $teamStyle['TeamStyle']['id'])); 
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