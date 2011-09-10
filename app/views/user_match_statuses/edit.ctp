<div class="userMatchStatuses form">
<?php echo $this->Form->create('UserMatchStatus');?>
	<fieldset>
		<legend><?php __('Edit User Match Status'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

