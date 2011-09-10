<div class="teamStyles form">
<?php echo $this->Form->create('TeamStyle');?>
	<fieldset>
		<legend><?php __('Admin Edit Team Style'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

