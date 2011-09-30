	
<div class="productPictures form2">
<?php echo $this->Form->create('ProductPicture');?>
	<fieldset>
		<legend><?php __('Admin Add Product Picture'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->hidden('image_path',array('id' => 'single-field'));
		echo $this->Form->input('product_id');
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
		<div id="single-upload" controller="productPictures">
		</div>			
</div>

