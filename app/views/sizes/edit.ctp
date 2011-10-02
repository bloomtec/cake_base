<div class="sizes form">
<?php echo $this->Form->create('Size');?>
	<fieldset>
		<legend><?php __('Edit Size'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('size_reference_id');
		echo $this->Form->input('subcategory_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

