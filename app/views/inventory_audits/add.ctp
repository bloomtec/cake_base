<div class="inventoryAudits form">
<?php echo $this->Form->create('InventoryAudit');?>
	<fieldset>
		<legend><?php __('Add Inventory Audit'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('inventory_id');
		echo $this->Form->input('old_value');
		echo $this->Form->input('new_value');
		echo $this->Form->input('comment');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

