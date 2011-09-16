<div class="matchStatuses index">
	<h2><?php __('Match Statuses');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
		<th><?php echo $this->Paginator->sort('id');?></th>
						
		<th><?php echo $this->Paginator->sort('name');?></th>
						
		<th><?php echo $this->Paginator->sort('description');?></th>
					<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($matchStatuses as $matchStatus):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $matchStatus['MatchStatus']['id']; ?>&nbsp;</td>
		<td><?php echo $matchStatus['MatchStatus']['name']; ?>&nbsp;</td>
		<td><?php echo $matchStatus['MatchStatus']['description']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__(' ', true), array('action' => 'view', $matchStatus['MatchStatus']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'edit', $matchStatus['MatchStatus']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'delete', $matchStatus['MatchStatus']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $matchStatus['MatchStatus']['id'])); ?>
			<?php if(isset($matchStatus['MatchStatus']['active'])&& $matchStatus['MatchStatus']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $matchStatus['MatchStatus']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $matchStatus['MatchStatus']['id']));
}?>
			<?php if(isset($matchStatus['MatchStatus']['active'])&& !$matchStatus['MatchStatus']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $matchStatus['MatchStatus']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $matchStatus['MatchStatus']['id'])); 
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