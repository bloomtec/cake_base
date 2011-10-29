<div class="pageSliders form">
<a class='volver' href='/admin/pageSliders/index/<?php echo $this->params['pass'][0] ?>'> << Volver </a>
<?php echo $this->Form->create('PageSlider');?>
	<fieldset>
		<legend><?php __('Admin Add Page Slider'); ?></legend>
	<?php
		echo $this->Form->hidden('page_id',array('value'=>$this->params['pass'][0]));
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('wysiwyg_content',array('label'=>false));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

	<script type="text/javascript">
			CKEDITOR.replace('data[PageSlider][wysiwyg_content]',{
        	filebrowserUploadUrl : '/upload.php',
        	filebrowserBrowseUrl : '/admin/pages/wysiwyg',
		} );
		</script>
