<div class="usersTeams index">
	<h2><?php __('Users Teams');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
		<th><?php echo $this->Paginator->sort('id');?></th>
						
		<th><?php echo $this->Paginator->sort('user_id');?></th>
						
		<th><?php echo $this->Paginator->sort('team_id');?></th>
						
		<th><?php echo $this->Paginator->sort('user_team_status_id');?></th>
						
		<th><?php echo $this->Paginator->sort('caller_user_id');?></th>
						
		<th><?php echo $this->Paginator->sort('created');?></th>
						
		<th><?php echo $this->Paginator->sort('updated');?></th>
					<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($usersTeams as $usersTeam):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $usersTeam['UsersTeam']['id']; ?>&nbsp;</td>
		<td><?php echo $usersTeam['UsersTeam']['user_id']; ?>&nbsp;</td>
		<td><?php echo $usersTeam['UsersTeam']['team_id']; ?>&nbsp;</td>
		<td><?php echo $usersTeam['UsersTeam']['user_team_status_id']; ?>&nbsp;</td>
		<td><?php echo $usersTeam['UsersTeam']['caller_user_id']; ?>&nbsp;</td>
		<td><?php echo $usersTeam['UsersTeam']['created']; ?>&nbsp;</td>
		<td><?php echo $usersTeam['UsersTeam']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__(' ', true), array('action' => 'view', $usersTeam['UsersTeam']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'edit', $usersTeam['UsersTeam']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'delete', $usersTeam['UsersTeam']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $usersTeam['UsersTeam']['id'])); ?>
			<?php if(isset($usersTeam['UsersTeam']['active'])&& $usersTeam['UsersTeam']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $usersTeam['UsersTeam']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $usersTeam['UsersTeam']['id']));
}?>
			<?php if(isset($usersTeam['UsersTeam']['active'])&& !$usersTeam['UsersTeam']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $usersTeam['UsersTeam']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $usersTeam['UsersTeam']['id'])); 
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