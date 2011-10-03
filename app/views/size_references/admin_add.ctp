<div class="sizeReferences form">
<?php echo $this->Form->create('SizeReference');?>
	<fieldset>
		<legend><?php __('Admin Add Size Reference'); ?></legend>
	<?php
		echo $this->Form->input('size');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

