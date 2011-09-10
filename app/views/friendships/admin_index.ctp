<div class="friendships index">
	<h2><?php __('Friendships');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
		<th><?php echo $this->Paginator->sort('id');?></th>
						
		<th><?php echo $this->Paginator->sort('user_a_id');?></th>
						
		<th><?php echo $this->Paginator->sort('user_b_id');?></th>
						
		<th><?php echo $this->Paginator->sort('is_accepted');?></th>
						
		<th><?php echo $this->Paginator->sort('is_blocked');?></th>
						
		<th><?php echo $this->Paginator->sort('created');?></th>
						
		<th><?php echo $this->Paginator->sort('updated');?></th>
					<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($friendships as $friendship):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $friendship['Friendship']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($friendship['UserA']['email'], array('controller' => 'users', 'action' => 'view', $friendship['UserA']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($friendship['UserB']['email'], array('controller' => 'users', 'action' => 'view', $friendship['UserB']['id'])); ?>
		</td>
		<td><?php echo $friendship['Friendship']['is_accepted']; ?>&nbsp;</td>
		<td><?php echo $friendship['Friendship']['is_blocked']; ?>&nbsp;</td>
		<td><?php echo $friendship['Friendship']['created']; ?>&nbsp;</td>
		<td><?php echo $friendship['Friendship']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__(' ', true), array('action' => 'view', $friendship['Friendship']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'edit', $friendship['Friendship']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'delete', $friendship['Friendship']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $friendship['Friendship']['id'])); ?>
			<?php if(isset($friendship['Friendship']['active'])&& $friendship['Friendship']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $friendship['Friendship']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $friendship['Friendship']['id']));
}?>
			<?php if(isset($friendship['Friendship']['active'])&& !$friendship['Friendship']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $friendship['Friendship']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $friendship['Friendship']['id'])); 
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