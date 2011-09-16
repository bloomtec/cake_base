<div class="challengeStatuses view">
<h2><?php  __('Challenge Status');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $challengeStatus['ChallengeStatus']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $challengeStatus['ChallengeStatus']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $challengeStatus['ChallengeStatus']['description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>


<div class="related">
	<h3><?php __('Related Challenges');?></h3>
	<?php if (!empty($challengeStatus['Challenge'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Challenge Status Id'); ?></th>
		<th><?php __('Team Challenger Id'); ?></th>
		<th><?php __('Team Challenged Id'); ?></th>
		<th><?php __('User Challenger Id'); ?></th>
		<th><?php __('User Decided Id'); ?></th>
		<th><?php __('Date'); ?></th>
		<th><?php __('Place'); ?></th>
		<th><?php __('Bet'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Message'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($challengeStatus['Challenge'] as $challenge):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $challenge['id'];?></td>
			<td><?php echo $challenge['challenge_status_id'];?></td>
			<td><?php echo $challenge['team_challenger_id'];?></td>
			<td><?php echo $challenge['team_challenged_id'];?></td>
			<td><?php echo $challenge['user_challenger_id'];?></td>
			<td><?php echo $challenge['user_decided_id'];?></td>
			<td><?php echo $challenge['date'];?></td>
			<td><?php echo $challenge['place'];?></td>
			<td><?php echo $challenge['bet'];?></td>
			<td><?php echo $challenge['title'];?></td>
			<td><?php echo $challenge['message'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'challenges', 'action' => 'view', $challenge['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'challenges', 'action' => 'edit', $challenge['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'challenges', 'action' => 'delete', $challenge['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $challenge['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Challenge', true), array('controller' => 'challenges', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
