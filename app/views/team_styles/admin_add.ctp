<div class="teamStyles form">
<?php echo $this->Form->create('TeamStyle');?>
	<fieldset>
		<legend><?php __('Admin Add Team Style'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

