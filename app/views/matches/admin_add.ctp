<div class="matches form">
<?php echo $this->Form->create('Match');?>
	<fieldset>
		<legend><?php __('Admin Add Match'); ?></legend>
	<?php
		echo $this->Form->input('match_status_id');
		echo $this->Form->input('name');
		echo $this->Form->input('date');
		echo $this->Form->input('place');
		echo $this->Form->input('bet');
		echo $this->Form->input('message');
		echo $this->Form->input('user_creator_id');
		echo $this->Form->input('User');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

