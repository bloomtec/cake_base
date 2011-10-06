	
<div class="news form2">
<?php echo $this->Form->create('News');?>
	<fieldset>
		<legend><?php __('Admin Add News'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('desccription');
		echo $this->Form->input('wysiwyg_content',array('label'=>false));
		echo $this->Form->hidden('image',array('id' => 'single-field'));
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
		<div id="single-upload" controller="news">
		</div>			
</div>

	<script type="text/javascript">
			CKEDITOR.replace('data[News][wysiwyg_content]',{
        	filebrowserUploadUrl : '/upload.php',
        	filebrowserBrowseUrl : '/admin/images/wysiwyg',
		} );
		</script>
