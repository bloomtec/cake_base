<<<<<<< HEAD
<div class="productPictures form">
=======
	
<div class="productPictures form2">
>>>>>>> 95f2195a47f719fb60f15d898897fd2e7e94e866
<?php echo $this->Form->create('ProductPicture');?>
	<fieldset>
		<legend><?php __('Admin Add Product Picture'); ?></legend>
	<?php
<<<<<<< HEAD
		echo $this->Form->input('product_id');
		echo $this->Form->input('title');
		echo $this->Form->input('path');
		echo $this->Form->input('alt');
=======
		echo $this->Form->input('name');
		echo $this->Form->hidden('image_path',array('id' => 'single-field'));
		echo $this->Form->input('product_id');
>>>>>>> 95f2195a47f719fb60f15d898897fd2e7e94e866
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<<<<<<< HEAD
=======
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

>>>>>>> 95f2195a47f719fb60f15d898897fd2e7e94e866
