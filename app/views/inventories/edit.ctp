<div class="inventories form">
<?php echo $this->Form->create('Inventory');?>
	<fieldset>
		<legend><?php __('Edit Inventory'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('product_id');
		echo $this->Form->input('size_id');
		echo $this->Form->input('quantity');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

