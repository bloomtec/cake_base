<div class="couponBatches form">
<?php echo $this->Form->create('CouponBatch');?>
	<fieldset>
		<legend><?php __('Admin Add Coupon Batch'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('value');
		echo $this->Form->input('quantity');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

