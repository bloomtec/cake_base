<div class="clubsUsers index">
	<h2><?php __('Clubs Users');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
		<th><?php echo $this->Paginator->sort('id');?></th>
						
		<th><?php echo $this->Paginator->sort('club_id');?></th>
						
		<th><?php echo $this->Paginator->sort('user_id');?></th>
					<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($clubsUsers as $clubsUser):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $clubsUser['ClubsUser']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($clubsUser['Club']['name'], array('controller' => 'clubs', 'action' => 'view', $clubsUser['Club']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($clubsUser['User']['email'], array('controller' => 'users', 'action' => 'view', $clubsUser['User']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__(' ', true), array('action' => 'view', $clubsUser['ClubsUser']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'edit', $clubsUser['ClubsUser']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'delete', $clubsUser['ClubsUser']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $clubsUser['ClubsUser']['id'])); ?>
			<?php if(isset($clubsUser['ClubsUser']['active'])&& $clubsUser['ClubsUser']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $clubsUser['ClubsUser']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $clubsUser['ClubsUser']['id']));
}?>
			<?php if(isset($clubsUser['ClubsUser']['active'])&& !$clubsUser['ClubsUser']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $clubsUser['ClubsUser']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $clubsUser['ClubsUser']['id'])); 
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