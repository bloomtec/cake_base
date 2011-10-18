<div class="visitedProducts form">
<?php echo $this->Form->create('VisitedProduct');?>
	<fieldset>
		<legend><?php __('Admin Edit Visited Product'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('product_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('count');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

