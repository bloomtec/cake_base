	
<div class="deals form2">
<?php echo $this->Form->create('Deal');?>
	<fieldset>
		<legend><?php __('Admin Add Deal'); ?></legend>
	<?php
		echo $this->Form->input('restaurant_id');
		echo $this->Form->input('name');
		echo $this->Form->input('is_promoted');
		echo $this->Form->input('description');
		echo $this->Form->input('conditions');
		echo $this->Form->hidden('image',array('id' => 'single-field'));
		echo $this->Form->hidden('image_large',array('id' => 'single-field-2'));
		echo $this->Form->input('amount');
		echo $this->Form->input('price');
		echo $this->Form->input('normal_price');
		echo $this->Form->input('max_buys');
		echo $this->Form->input('expires');
		echo $this->Form->input('Cuisine', array('multiple'=>'checkbox'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="images">
	<h2><?php __('Image'); ?></h2>
	<div class="preview">
		<div class="wrapper">
				 <?php
				 	if(isset($this->data['Deal']['image']) && !empty($this->data['Deal']['image'])) {
				 		echo $this->Html->image('uploads/'.$this->data['Deal']['image']);
				 	} else {
				 		echo $this->Html->image('preview.png');
				 	}
				 ?>
		</div>
	</div>
	<div id="single-upload" controller="deals">
	</div>
</div>

<div class="images">
	<h2><?php __('Large Image'); ?></h2>
	<div class="preview-2">
		<div class="wrapper">
				 <?php
				 	if(isset($this->data['Deal']['image_large']) && !empty($this->data['Deal']['image_large'])) {
				 		echo $this->Html->image('uploads/'.$this->data['Deal']['image_large']);
				 	} else {
				 		echo $this->Html->image('preview.png');
				 	}
				 ?>
		</div>
	</div>
	<div id="single-upload-2" controller="deals">
	</div>
</div>

<script type="text/javascript">
	CKEDITOR.replace(
		'data[Deal][description]',
		{
			filebrowserUploadUrl : '/upload.php',
       		filebrowserBrowseUrl : '/admin/pages/wysiwyg',
		} 
	);
</script>

<script type="text/javascript">
	CKEDITOR.replace(
		'data[Deal][conditions]',
		{
			filebrowserUploadUrl : '/upload.php',
       		filebrowserBrowseUrl : '/admin/pages/wysiwyg',
		} 
	);
</script>