<div class="users view">
<h2><?php  __('User');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['email']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Password'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['password']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Role'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($user['Role']['name'], array('controller' => 'roles', 'action' => 'view', $user['Role']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>


<div class="related">
	<h3><?php __('Related User Fields');?></h3>
	<?php if (!empty($user['UserField'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Surname'); ?></th>
		<th><?php __('Birthday'); ?></th>
		<th><?php __('Gender'); ?></th>
		<th><?php __('Image'); ?></th>
		<th><?php __('Position Id'); ?></th>
		<th><?php __('Foot Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Updated'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['UserField'] as $userField):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $userField['id'];?></td>
			<td><?php echo $userField['user_id'];?></td>
			<td><?php echo $userField['name'];?></td>
			<td><?php echo $userField['surname'];?></td>
			<td><?php echo $userField['birthday'];?></td>
			<td><?php echo $userField['gender'];?></td>
			<td><?php echo $userField['image'];?></td>
			<td><?php echo $userField['position_id'];?></td>
			<td><?php echo $userField['foot_id'];?></td>
			<td><?php echo $userField['created'];?></td>
			<td><?php echo $userField['updated'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'user_fields', 'action' => 'view', $userField['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'user_fields', 'action' => 'edit', $userField['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'user_fields', 'action' => 'delete', $userField['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $userField['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Field', true), array('controller' => 'user_fields', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related User Notifications');?></h3>
	<?php if (!empty($user['UserNotification'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Subject'); ?></th>
		<th><?php __('Content'); ?></th>
		<th><?php __('Created'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['UserNotification'] as $userNotification):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $userNotification['id'];?></td>
			<td><?php echo $userNotification['user_id'];?></td>
			<td><?php echo $userNotification['subject'];?></td>
			<td><?php echo $userNotification['content'];?></td>
			<td><?php echo $userNotification['created'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'user_notifications', 'action' => 'view', $userNotification['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'user_notifications', 'action' => 'edit', $userNotification['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'user_notifications', 'action' => 'delete', $userNotification['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $userNotification['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Notification', true), array('controller' => 'user_notifications', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Clubs');?></h3>
	<?php if (!empty($user['Club'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('League Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Image'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Club'] as $club):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $club['id'];?></td>
			<td><?php echo $club['league_id'];?></td>
			<td><?php echo $club['name'];?></td>
			<td><?php echo $club['image'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'clubs', 'action' => 'view', $club['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'clubs', 'action' => 'edit', $club['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'clubs', 'action' => 'delete', $club['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $club['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Club', true), array('controller' => 'clubs', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Country Squads');?></h3>
	<?php if (!empty($user['CountrySquad'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Image'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['CountrySquad'] as $countrySquad):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $countrySquad['id'];?></td>
			<td><?php echo $countrySquad['name'];?></td>
			<td><?php echo $countrySquad['image'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'country_squads', 'action' => 'view', $countrySquad['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'country_squads', 'action' => 'edit', $countrySquad['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'country_squads', 'action' => 'delete', $countrySquad['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $countrySquad['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Country Squad', true), array('controller' => 'country_squads', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Matches');?></h3>
	<?php if (!empty($user['Match'])):?>
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
		foreach ($user['Match'] as $match):
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
<div class="related">
	<h3><?php __('Related Teams');?></h3>
	<?php if (!empty($user['Team'])):?>
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
		foreach ($user['Team'] as $team):
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
