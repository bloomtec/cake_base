<div class="teams search">
	<?php echo $this->Form->create('Team', array('action' => 'search'));?>
		<fieldset>
			<legend><?php __('Search'); ?></legend>
			<?php
				echo $this->Form->input('name');
			?>
		</fieldset>
	<?php echo $this->Form->end(__('Search', true));?>
	<!--
	<h2><?php __('Teams');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
		<th><?php echo $this->Paginator->sort('id');?></th>
						
		<th><?php echo $this->Paginator->sort('team_style_id');?></th>
						
		<th><?php echo $this->Paginator->sort('name');?></th>
						
		<th><?php echo $this->Paginator->sort('image');?></th>
						
		<th><?php echo $this->Paginator->sort('created');?></th>
						
		<th><?php echo $this->Paginator->sort('updated');?></th>
					<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($teams as $team):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $team['Team']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($team['TeamStyle']['name'], array('controller' => 'team_styles', 'action' => 'view', $team['TeamStyle']['id'])); ?>
		</td>
		<td><?php echo $team['Team']['name']; ?>&nbsp;</td>
		<td><?php echo $this->Html->image('uploads/100x100/'.$team['Team']['image']); ?>&nbsp;</td>
		<td><?php echo $team['Team']['created']; ?>&nbsp;</td>
		<td><?php echo $team['Team']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__(' ', true), array('action' => 'view', $team['Team']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'edit', $team['Team']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'delete', $team['Team']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $team['Team']['id'])); ?>
			<?php if(isset($team['Team']['active'])&& $team['Team']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $team['Team']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $team['Team']['id']));
}?>
			<?php if(isset($team['Team']['active'])&& !$team['Team']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $team['Team']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $team['Team']['id'])); 
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
	-->
</div>