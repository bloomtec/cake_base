<div class="challengeStatuses index">
	<h2><?php __('Challenge Statuses');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
		<th><?php echo $this->Paginator->sort('id');?></th>
						
		<th><?php echo $this->Paginator->sort('name');?></th>
						
		<th><?php echo $this->Paginator->sort('description');?></th>
					<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($challengeStatuses as $challengeStatus):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $challengeStatus['ChallengeStatus']['id']; ?>&nbsp;</td>
		<td><?php echo $challengeStatus['ChallengeStatus']['name']; ?>&nbsp;</td>
		<td><?php echo $challengeStatus['ChallengeStatus']['description']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__(' ', true), array('action' => 'view', $challengeStatus['ChallengeStatus']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'edit', $challengeStatus['ChallengeStatus']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'delete', $challengeStatus['ChallengeStatus']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $challengeStatus['ChallengeStatus']['id'])); ?>
			<?php if(isset($challengeStatus['ChallengeStatus']['active'])&& $challengeStatus['ChallengeStatus']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $challengeStatus['ChallengeStatus']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $challengeStatus['ChallengeStatus']['id']));
}?>
			<?php if(isset($challengeStatus['ChallengeStatus']['active'])&& !$challengeStatus['ChallengeStatus']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $challengeStatus['ChallengeStatus']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $challengeStatus['ChallengeStatus']['id'])); 
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