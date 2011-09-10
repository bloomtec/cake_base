<div class="usersMatches index">
	<h2><?php __('Users Matches');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
		<th><?php echo $this->Paginator->sort('id');?></th>
						
		<th><?php echo $this->Paginator->sort('user_id');?></th>
						
		<th><?php echo $this->Paginator->sort('match_id');?></th>
						
		<th><?php echo $this->Paginator->sort('user_match_status_id');?></th>
					<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($usersMatches as $usersMatch):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $usersMatch['UsersMatch']['id']; ?>&nbsp;</td>
		<td><?php echo $usersMatch['UsersMatch']['user_id']; ?>&nbsp;</td>
		<td><?php echo $usersMatch['UsersMatch']['match_id']; ?>&nbsp;</td>
		<td><?php echo $usersMatch['UsersMatch']['user_match_status_id']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__(' ', true), array('action' => 'view', $usersMatch['UsersMatch']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'edit', $usersMatch['UsersMatch']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'delete', $usersMatch['UsersMatch']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $usersMatch['UsersMatch']['id'])); ?>
			<?php if(isset($usersMatch['UsersMatch']['active'])&& $usersMatch['UsersMatch']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $usersMatch['UsersMatch']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $usersMatch['UsersMatch']['id']));
}?>
			<?php if(isset($usersMatch['UsersMatch']['active'])&& !$usersMatch['UsersMatch']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $usersMatch['UsersMatch']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $usersMatch['UsersMatch']['id'])); 
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