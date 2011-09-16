<div class="teamNotifications index">
	<h2><?php __('Team Notifications');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
		<th><?php echo $this->Paginator->sort('id');?></th>
						
		<th><?php echo $this->Paginator->sort('team_id');?></th>
						
		<th><?php echo $this->Paginator->sort('subject');?></th>
						
		<th><?php echo $this->Paginator->sort('content');?></th>
						
		<th><?php echo $this->Paginator->sort('created');?></th>
					<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($teamNotifications as $teamNotification):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $teamNotification['TeamNotification']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($teamNotification['Team']['name'], array('controller' => 'teams', 'action' => 'view', $teamNotification['Team']['id'])); ?>
		</td>
		<td><?php echo $teamNotification['TeamNotification']['subject']; ?>&nbsp;</td>
		<td><?php echo $teamNotification['TeamNotification']['content']; ?>&nbsp;</td>
		<td><?php echo $teamNotification['TeamNotification']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__(' ', true), array('action' => 'view', $teamNotification['TeamNotification']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'edit', $teamNotification['TeamNotification']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'delete', $teamNotification['TeamNotification']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $teamNotification['TeamNotification']['id'])); ?>
			<?php if(isset($teamNotification['TeamNotification']['active'])&& $teamNotification['TeamNotification']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $teamNotification['TeamNotification']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $teamNotification['TeamNotification']['id']));
}?>
			<?php if(isset($teamNotification['TeamNotification']['active'])&& !$teamNotification['TeamNotification']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $teamNotification['TeamNotification']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $teamNotification['TeamNotification']['id'])); 
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