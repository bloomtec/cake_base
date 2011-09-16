<div class="matchStatuses view">
<h2><?php  __('Match Status');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $matchStatus['MatchStatus']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $matchStatus['MatchStatus']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $matchStatus['MatchStatus']['description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>


<div class="related">
	<h3><?php __('Related Matches');?></h3>
	<?php if (!empty($matchStatus['Match'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Match Status Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Date'); ?></th>
		<th><?php __('Place'); ?></th>
		<th><?php __('Bet'); ?></th>
		<th><?php __('Message'); ?></th>
		<th><?php __('User Creator Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($matchStatus['Match'] as $match):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $match['id'];?></td>
			<td><?php echo $match['match_status_id'];?></td>
			<td><?php echo $match['name'];?></td>
			<td><?php echo $match['date'];?></td>
			<td><?php echo $match['place'];?></td>
			<td><?php echo $match['bet'];?></td>
			<td><?php echo $match['message'];?></td>
			<td><?php echo $match['user_creator_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'matches', 'action' => 'view', $match['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'matches', 'action' => 'edit', $match['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'matches', 'action' => 'delete', $match['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $match['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Match', true), array('controller' => 'matches', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
