<div class="orders form">
<?php echo $this->Form->create('Order');?>
	<fieldset>
		<legend><?php __('Admin Add Order'); ?></legend>
	<?php
		echo $this->Form->input('code');
		echo $this->Form->input('user_id');
		echo $this->Form->input('address_id');
		echo $this->Form->input('quantity');
		echo $this->Form->input('deal_id');
		echo $this->Form->input('order_state_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
