<div class="sizes form">
<?php echo $this->Form->create('Size');?>
	<fieldset>
		<legend><?php __('Admin Add Size'); ?></legend>
	<?php
		echo $this->Form->input('size');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

