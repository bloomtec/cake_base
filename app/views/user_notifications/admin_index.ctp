<div class="userNotifications index">
	<h2><?php __('User Notifications');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
		<th><?php echo $this->Paginator->sort('id');?></th>
						
		<th><?php echo $this->Paginator->sort('user_id');?></th>
						
		<th><?php echo $this->Paginator->sort('subject');?></th>
						
		<th><?php echo $this->Paginator->sort('content');?></th>
						
		<th><?php echo $this->Paginator->sort('created');?></th>
					<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($userNotifications as $userNotification):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $userNotification['UserNotification']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($userNotification['User']['email'], array('controller' => 'users', 'action' => 'view', $userNotification['User']['id'])); ?>
		</td>
		<td><?php echo $userNotification['UserNotification']['subject']; ?>&nbsp;</td>
		<td><?php echo $userNotification['UserNotification']['content']; ?>&nbsp;</td>
		<td><?php echo $userNotification['UserNotification']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__(' ', true), array('action' => 'view', $userNotification['UserNotification']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'edit', $userNotification['UserNotification']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'delete', $userNotification['UserNotification']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $userNotification['UserNotification']['id'])); ?>
			<?php if(isset($userNotification['UserNotification']['active'])&& $userNotification['UserNotification']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $userNotification['UserNotification']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $userNotification['UserNotification']['id']));
}?>
			<?php if(isset($userNotification['UserNotification']['active'])&& !$userNotification['UserNotification']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $userNotification['UserNotification']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $userNotification['UserNotification']['id'])); 
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