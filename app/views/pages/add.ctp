<div class="pages form">
<?php echo $this->Form->create('Page');?>
	<fieldset>
		<legend><?php __('Add Page'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('keywords');
		echo $this->Form->input('active');
		echo $this->Form->input('wysiwyg_content',array('label'=>false));
		echo $this->Form->input('slug');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

	<script type="text/javascript">
			CKEDITOR.replace('data[Page][wysiwyg_content]',{
        	filebrowserUploadUrl : '/upload.php',
        	filebrowserBrowseUrl : '/admin/images/wysiwyg',
		} );
		</script>
