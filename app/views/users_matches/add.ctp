<div class="usersMatches form">
<?php echo $this->Form->create('UsersMatch');?>
	<fieldset>
		<legend><?php __('Add Users Match'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('match_id');
		echo $this->Form->input('user_match_status_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

