<div class="menus form">
<?php echo $this->Form->create('Menu');?>
	<fieldset>
		<legend><?php __('Admin Edit Menu'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

