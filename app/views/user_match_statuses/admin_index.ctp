<div class="userMatchStatuses index">
	<h2><?php __('User Match Statuses');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
		<th><?php echo $this->Paginator->sort('id');?></th>
						
		<th><?php echo $this->Paginator->sort('name');?></th>
						
		<th><?php echo $this->Paginator->sort('description');?></th>
					<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($userMatchStatuses as $userMatchStatus):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $userMatchStatus['UserMatchStatus']['id']; ?>&nbsp;</td>
		<td><?php echo $userMatchStatus['UserMatchStatus']['name']; ?>&nbsp;</td>
		<td><?php echo $userMatchStatus['UserMatchStatus']['description']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__(' ', true), array('action' => 'view', $userMatchStatus['UserMatchStatus']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'edit', $userMatchStatus['UserMatchStatus']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'delete', $userMatchStatus['UserMatchStatus']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $userMatchStatus['UserMatchStatus']['id'])); ?>
			<?php if(isset($userMatchStatus['UserMatchStatus']['active'])&& $userMatchStatus['UserMatchStatus']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $userMatchStatus['UserMatchStatus']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $userMatchStatus['UserMatchStatus']['id']));
}?>
			<?php if(isset($userMatchStatus['UserMatchStatus']['active'])&& !$userMatchStatus['UserMatchStatus']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $userMatchStatus['UserMatchStatus']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $userMatchStatus['UserMatchStatus']['id'])); 
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