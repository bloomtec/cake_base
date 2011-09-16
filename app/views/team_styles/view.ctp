<div class="teamStyles view">
<h2><?php  __('Team Style');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $teamStyle['TeamStyle']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $teamStyle['TeamStyle']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>


<div class="related">
	<h3><?php __('Related Teams');?></h3>
	<?php if (!empty($teamStyle['Team'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Team Style Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Image'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Updated'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($teamStyle['Team'] as $team):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $team['id'];?></td>
			<td><?php echo $team['team_style_id'];?></td>
			<td><?php echo $team['name'];?></td>
			<td><?php echo $team['image'];?></td>
			<td><?php echo $team['created'];?></td>
			<td><?php echo $team['updated'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'teams', 'action' => 'view', $team['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'teams', 'action' => 'edit', $team['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'teams', 'action' => 'delete', $team['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $team['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Team', true), array('controller' => 'teams', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
