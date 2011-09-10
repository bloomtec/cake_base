<div class="matches index">
	<h2><?php __('Matches');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
		<th><?php echo $this->Paginator->sort('id');?></th>
						
		<th><?php echo $this->Paginator->sort('match_status_id');?></th>
						
		<th><?php echo $this->Paginator->sort('name');?></th>
						
		<th><?php echo $this->Paginator->sort('date');?></th>
						
		<th><?php echo $this->Paginator->sort('place');?></th>
						
		<th><?php echo $this->Paginator->sort('bet');?></th>
						
		<th><?php echo $this->Paginator->sort('message');?></th>
						
		<th><?php echo $this->Paginator->sort('user_creator_id');?></th>
					<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($matches as $match):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $match['Match']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($match['MatchStatus']['name'], array('controller' => 'match_statuses', 'action' => 'view', $match['MatchStatus']['id'])); ?>
		</td>
		<td><?php echo $match['Match']['name']; ?>&nbsp;</td>
		<td><?php echo $match['Match']['date']; ?>&nbsp;</td>
		<td><?php echo $match['Match']['place']; ?>&nbsp;</td>
		<td><?php echo $match['Match']['bet']; ?>&nbsp;</td>
		<td><?php echo $match['Match']['message']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($match['UserCreator']['email'], array('controller' => 'users', 'action' => 'view', $match['UserCreator']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__(' ', true), array('action' => 'view', $match['Match']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'edit', $match['Match']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'delete', $match['Match']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $match['Match']['id'])); ?>
			<?php if(isset($match['Match']['active'])&& $match['Match']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $match['Match']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $match['Match']['id']));
}?>
			<?php if(isset($match['Match']['active'])&& !$match['Match']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $match['Match']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $match['Match']['id'])); 
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