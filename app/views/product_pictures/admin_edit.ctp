<div class="productPictures form">
<?php echo $this->Form->create('ProductPicture');?>
	<fieldset>
		<legend><?php __('Admin Edit Product Picture'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('product_id');
		echo $this->Form->input('name');
		echo $this->Form->input('path');
		echo $this->Form->input('alt');
		echo $this->Form->input('sort');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

