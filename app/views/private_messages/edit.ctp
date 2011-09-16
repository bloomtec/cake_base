<div class="privateMessages form">
<?php echo $this->Form->create('PrivateMessage');?>
	<fieldset>
		<legend><?php __('Edit Private Message'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('to_user_id');
		echo $this->Form->input('from_user_id');
		echo $this->Form->input('subject');
		echo $this->Form->input('content');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

