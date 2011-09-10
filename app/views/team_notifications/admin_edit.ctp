<div class="teamNotifications form">
<?php echo $this->Form->create('TeamNotification');?>
	<fieldset>
		<legend><?php __('Admin Edit Team Notification'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('team_id');
		echo $this->Form->input('subject');
		echo $this->Form->input('content');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

