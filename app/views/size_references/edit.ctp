<div class="sizeReferences form">
<?php echo $this->Form->create('SizeReference');?>
	<fieldset>
		<legend><?php __('Edit Size Reference'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('size');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

