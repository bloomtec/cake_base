<div class="pages form">
<?php echo $this->Form->create('Page');?>
	<fieldset>
		<legend><?php __('Admin Edit Page'); ?></legend>
	<?php
		$layouts=$this->requestAction('/admin/pages/layouts');
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('layout',array('options'=>$layouts));
		echo $this->Form->input('description');
		echo $this->Form->input('keywords');
		echo $this->Form->input('is_active');
		echo $this->Form->input('wysiwyg_content',array('label'=>false,'class'=>'editor'));
	?>
	</fieldset>
	<?php echo $this -> Html -> link('Vista previa',array('controller'=>'pages','action'=>'preview','admin'=>true),array('target'=>'_blank','class'=>'preview'));?>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<script type="text/javascript">
		$('textarea.editor').ckeditor(function(){

		}, {
			filebrowserUploadUrl : '/upload.php',
        	filebrowserBrowseUrl : '/admin/pages/wysiwyg',
			toolbar : 'Dialog'
		});
		$('a.preview').click(function(e){
		e.preventDefault();
		var href= $(this).attr('href');
		jQuery.ajax({
			url : '/admin/pages/beforePrev',
			type : "POST",
			cache : false,
			data : {wysiwyg_content:$('.editor').val(),layout:$('#PageLayout').val()},
			success : function(data){
			if(data){
				window.open(href,'','toolbars=no,scrollbars=yes,location=no,statusbars=no,menubars=no,height=600,width=1000,');
			}
		}
		});
	});
</script>