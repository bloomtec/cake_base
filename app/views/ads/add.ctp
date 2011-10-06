<div class="ads form">
<?php echo $this->Form->create('Ad');?>
	<fieldset>
		<legend><?php __('Add Ad'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('wysiwyg_content',array('label'=>false));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

	<script type="text/javascript">
			CKEDITOR.replace('data[Ad][wysiwyg_content]',{
        	filebrowserUploadUrl : '/upload.php',
        	filebrowserBrowseUrl : '/admin/images/wysiwyg',
		} );
		</script>
