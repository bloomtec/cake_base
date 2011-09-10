<div class="userMatchStatuses form">
<?php echo $this->Form->create('UserMatchStatus');?>
	<fieldset>
		<legend><?php __('Admin Add User Match Status'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

