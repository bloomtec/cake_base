<div class="inventory-form">
<?php echo $this->Form->create('Inventory');?>
	<fieldset>
		<legend><?php __('Add Inventory to :: '.$product['Product']['name']); ?></legend>
	<?php
		echo $this->Form->hidden('product_id', array('value'=>$product['Product']['id']));
		echo $this->Form->input('size_id');
		echo $this->Form->input('quantity');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Add Inventory', true));?>
</div>

