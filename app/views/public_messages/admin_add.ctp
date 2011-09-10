<div class="publicMessages form">
<?php echo $this->Form->create('PublicMessage');?>
	<fieldset>
		<legend><?php __('Admin Add Public Message'); ?></legend>
	<?php
		echo $this->Form->input('to_user_id');
		echo $this->Form->input('from_user_id');
		echo $this->Form->input('subject');
		echo $this->Form->input('content');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

