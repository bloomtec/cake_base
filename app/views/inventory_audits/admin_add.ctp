<div class="inventoryAudits form">
<?php echo $this->Form->create('InventoryAudit');?>
	<fieldset>
		<legend><?php __('Admin Add Inventory Audit'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('inventory_id');
		echo $this->Form->input('value_change');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

