<div class="userTeamStatuses index">
	<h2><?php __('User Team Statuses');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
		<th><?php echo $this->Paginator->sort('id');?></th>
						
		<th><?php echo $this->Paginator->sort('name');?></th>
						
		<th><?php echo $this->Paginator->sort('description');?></th>
						
		<th><?php echo $this->Paginator->sort('created');?></th>
						
		<th><?php echo $this->Paginator->sort('updated');?></th>
					<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($userTeamStatuses as $userTeamStatus):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $userTeamStatus['UserTeamStatus']['id']; ?>&nbsp;</td>
		<td><?php echo $userTeamStatus['UserTeamStatus']['name']; ?>&nbsp;</td>
		<td><?php echo $userTeamStatus['UserTeamStatus']['description']; ?>&nbsp;</td>
		<td><?php echo $userTeamStatus['UserTeamStatus']['created']; ?>&nbsp;</td>
		<td><?php echo $userTeamStatus['UserTeamStatus']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__(' ', true), array('action' => 'view', $userTeamStatus['UserTeamStatus']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'edit', $userTeamStatus['UserTeamStatus']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'delete', $userTeamStatus['UserTeamStatus']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $userTeamStatus['UserTeamStatus']['id'])); ?>
			<?php if(isset($userTeamStatus['UserTeamStatus']['active'])&& $userTeamStatus['UserTeamStatus']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $userTeamStatus['UserTeamStatus']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $userTeamStatus['UserTeamStatus']['id']));
}?>
			<?php if(isset($userTeamStatus['UserTeamStatus']['active'])&& !$userTeamStatus['UserTeamStatus']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $userTeamStatus['UserTeamStatus']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $userTeamStatus['UserTeamStatus']['id'])); 
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