<div class="challenges form">
<?php echo $this->Form->create('Challenge');?>
	<fieldset>
		<legend><?php __('Edit Challenge'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('challenge_status_id');
		echo $this->Form->input('team_challenger_id');
		echo $this->Form->input('team_challenged_id');
		echo $this->Form->input('user_challenger_id');
		echo $this->Form->input('user_decided_id');
		echo $this->Form->input('date');
		echo $this->Form->input('place');
		echo $this->Form->input('bet');
		echo $this->Form->input('title');
		echo $this->Form->input('message');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

