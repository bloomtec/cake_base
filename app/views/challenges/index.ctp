<div class="challenges index">
	<h2><?php __('Challenges');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
		<th><?php echo $this->Paginator->sort('id');?></th>
						
		<th><?php echo $this->Paginator->sort('challenge_status_id');?></th>
						
		<th><?php echo $this->Paginator->sort('team_challenger_id');?></th>
						
		<th><?php echo $this->Paginator->sort('team_challenged_id');?></th>
						
		<th><?php echo $this->Paginator->sort('user_challenger_id');?></th>
						
		<th><?php echo $this->Paginator->sort('user_decided_id');?></th>
						
		<th><?php echo $this->Paginator->sort('date');?></th>
						
		<th><?php echo $this->Paginator->sort('place');?></th>
						
		<th><?php echo $this->Paginator->sort('bet');?></th>
						
		<th><?php echo $this->Paginator->sort('title');?></th>
						
		<th><?php echo $this->Paginator->sort('message');?></th>
					<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($challenges as $challenge):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $challenge['Challenge']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($challenge['ChallengeStatus']['name'], array('controller' => 'challenge_statuses', 'action' => 'view', $challenge['ChallengeStatus']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($challenge['TeamChallenger']['name'], array('controller' => 'teams', 'action' => 'view', $challenge['TeamChallenger']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($challenge['TeamChallenged']['name'], array('controller' => 'teams', 'action' => 'view', $challenge['TeamChallenged']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($challenge['UserChallenger']['email'], array('controller' => 'users', 'action' => 'view', $challenge['UserChallenger']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($challenge['UserDecided']['email'], array('controller' => 'users', 'action' => 'view', $challenge['UserDecided']['id'])); ?>
		</td>
		<td><?php echo $challenge['Challenge']['date']; ?>&nbsp;</td>
		<td><?php echo $challenge['Challenge']['place']; ?>&nbsp;</td>
		<td><?php echo $challenge['Challenge']['bet']; ?>&nbsp;</td>
		<td><?php echo $challenge['Challenge']['title']; ?>&nbsp;</td>
		<td><?php echo $challenge['Challenge']['message']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__(' ', true), array('action' => 'view', $challenge['Challenge']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'edit', $challenge['Challenge']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'delete', $challenge['Challenge']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $challenge['Challenge']['id'])); ?>
			<?php if(isset($challenge['Challenge']['active'])&& $challenge['Challenge']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $challenge['Challenge']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $challenge['Challenge']['id']));
}?>
			<?php if(isset($challenge['Challenge']['active'])&& !$challenge['Challenge']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $challenge['Challenge']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $challenge['Challenge']['id'])); 
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