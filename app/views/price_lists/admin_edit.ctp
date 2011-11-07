<div class="priceLists form">
<?php echo $this->Form->create('PriceList');?>
	<fieldset>
		<legend><?php __('Admin Edit Price List'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('path');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

