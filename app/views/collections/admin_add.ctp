<div class="collections form">
<?php echo $this->Form->create('Collection');?>
	<fieldset>
		<legend><?php __('Admin Add Collection'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('brand_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

