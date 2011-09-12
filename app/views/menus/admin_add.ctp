<div class="menus form">
<?php echo $this->Form->create('Menu');?>
	<fieldset>
		<legend><?php __('Admin Add Menu'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

