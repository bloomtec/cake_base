<div class="tagSliders form">
<a class='volver' href='/admin/tagSliders/index/<?php echo $this->data['TagSlider']['tag_id'] ?>'> << Volver </a>
<?php echo $this->Form->create('TagSlider');?>
	<fieldset>
		<legend><?php __('Admin Edit Tag Slider'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->hidden('tag_id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('wysiwyg_content',array('label'=>false));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

	<script type="text/javascript">
			CKEDITOR.replace('data[TagSlider][wysiwyg_content]',{
        	filebrowserUploadUrl : '/upload.php',
        	filebrowserBrowseUrl : '/admin/pages/wysiwyg',
		} );
		</script>
