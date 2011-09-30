	
<div class="subcategories form2">
<?php echo $this->Form->create('Subcategory');?>
	<fieldset>
		<legend><?php __('Add Subcategory'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->hidden('image',array('id' => 'single-field'));
		echo $this->Form->input('sort');
		echo $this->Form->input('brand_id');
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
		<div id="single-upload" controller="subcategories">
		</div>			
</div>

