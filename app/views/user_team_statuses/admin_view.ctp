<div class="userTeamStatuses view">
<h2><?php  __('User Team Status');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $userTeamStatus['UserTeamStatus']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $userTeamStatus['UserTeamStatus']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $userTeamStatus['UserTeamStatus']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $userTeamStatus['UserTeamStatus']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $userTeamStatus['UserTeamStatus']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>


<div class="related">
	<h3><?php __('Related Users Teams');?></h3>
	<?php if (!empty($userTeamStatus['UsersTeam'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Team Id'); ?></th>
		<th><?php __('User Team Status Id'); ?></th>
		<th><?php __('Caller User Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Updated'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($userTeamStatus['UsersTeam'] as $usersTeam):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $usersTeam['id'];?></td>
			<td><?php echo $usersTeam['user_id'];?></td>
			<td><?php echo $usersTeam['team_id'];?></td>
			<td><?php echo $usersTeam['user_team_status_id'];?></td>
			<td><?php echo $usersTeam['caller_user_id'];?></td>
			<td><?php echo $usersTeam['created'];?></td>
			<td><?php echo $usersTeam['updated'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'users_teams', 'action' => 'view', $usersTeam['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'users_teams', 'action' => 'edit', $usersTeam['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'users_teams', 'action' => 'delete', $usersTeam['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $usersTeam['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Users Team', true), array('controller' => 'users_teams', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
