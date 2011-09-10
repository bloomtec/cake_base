<div class="friendships form">
<?php echo $this->Form->create('Friendship');?>
	<fieldset>
		<legend><?php __('Admin Add Friendship'); ?></legend>
	<?php
		echo $this->Form->input('user_a_id');
		echo $this->Form->input('user_b_id');
		echo $this->Form->input('is_accepted');
		echo $this->Form->input('is_blocked');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

