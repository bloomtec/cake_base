<div class="usersTeams form">
<?php echo $this->Form->create('UsersTeam');?>
	<fieldset>
		<legend><?php __('Edit Users Team'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('team_id');
		echo $this->Form->input('user_team_status_id');
		echo $this->Form->input('caller_user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

