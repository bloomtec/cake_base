<div class="menus form">
<?php echo $this->Form->create('Menu');?>
	<fieldset>
		<legend><?php __('Admin Add Menu'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('background_code');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

