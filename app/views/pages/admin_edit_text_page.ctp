<div class="pages form">
<?php echo $this->Form->create('Page');?>
	<fieldset>
		<legend><?php __('Edit Text Page From Menu :: ' . $menu_title); ?></legend>
	<?php
		echo $this->Form->hidden('id');
		echo $this->Form->hidden('menu_id');
		echo $this->Form->hidden('page_type_id');
		echo $this->Form->input('title');
		echo $this->Form->input('wysiwyg_content');
		echo $this->Form->hidden('pic_1');
		echo $this->Form->hidden('pic_2');
		echo $this->Form->hidden('pic_3');
		echo $this->Form->hidden('pic_4');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<script type="text/javascript">
	CKEDITOR.replace( 'data[Page][wysiwyg_content]',{
        	filebrowserUploadUrl : '/upload.php',
        	filebrowserBrowseUrl : '/admin/images/wysiwyg',
		} );
</script>