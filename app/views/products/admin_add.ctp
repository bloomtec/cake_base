<div class="products form2">
<?php echo $this->Form->create('Product');?>
	<fieldset>
		<legend><?php __('Admin Add Product'); ?></legend>
	<?php
		echo $this->Form->input('product_type_id', array("empty"=>"Seleccione..."));
		e('<div id="ProductProductTypeInfo"></div>');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="images">
	<h2>Image</h2>
	<div class="preview">
		<div class="wrapper">
				 <?php echo $this->Html->image('preview.png');?>
		</div>
	</div>
	<div id="single-upload" controller="products">
	</div>			
</div>

