	
<div class="brands form2">
<?php echo $this->Form->create('Brand');?>
	<fieldset>
		<legend><?php __('Admin Add Brand'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->hidden('image_brand',array('id' => 'single-field'));
		echo $this->Form->hidden('image_hover',array('id' => 'single-field'));
		echo $this->Form->input('sort');
		echo $this->Form->input('category_id');
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
		<div id="single-upload" controller="brands">
		</div>			
</div>

