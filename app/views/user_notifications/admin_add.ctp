<div class="userNotifications form">
<?php echo $this->Form->create('UserNotification');?>
	<fieldset>
		<legend><?php __('Admin Add User Notification'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('subject');
		echo $this->Form->input('content');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

