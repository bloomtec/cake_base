<div class="sizes form">
<?php echo $this->Form->create('Size');?>
	<fieldset>
		<legend><?php __('Admin Edit Size'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('size');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

