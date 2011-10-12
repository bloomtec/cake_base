<div class="brands form2 add">
	<?php echo $this -> Form -> create('Brand');?>
	<fieldset>
		<legend>
			<?php __('Admin Add Brand');?>
		</legend>
		<?php
		echo $this -> Form -> input('name');
		echo $this -> Form -> input('country');
		echo $this -> Form -> hidden('image_brand', array('id' => 'single-field-1'));
		echo $this -> Form -> hidden('image_hover', array('id' => 'single-field-2'));
		echo $this -> Form -> hidden('sort');
		echo $this -> Form -> input('category_id', array('type'=>'radio'));
		?>
	</fieldset>
</div>
	
<div class="images-1 images-div">
	<h2>Brand Image</h2>
	<div class="preview-1">
		<div class="wrapper">
			<?php echo $this -> Html -> image('preview.png',array("width"=>150));?>
		</div>
	</div>
	<div id="single-upload-1" controller="brands"></div>
</div>

<div class="images-2 images-div" >
	<h2>Hover Image</h2>
	<div class="preview-2">
		<div class="wrapper">
			<?php echo $this -> Html -> image('preview.png',array("width"=>150));?>
		</div>
	</div>
	<div id="single-upload-2" controller="brands"></div>
</div>

<div style="clear: both;">
	<?php echo $this -> Form -> end(__('Submit', true));?>
</div>

<script type="text/javascript">
		$(document).ready(function() {
			var server = '/';
			$('#single-upload-1').uploadify({
				'uploader' : server + 'swf/uploadify.swf',
				'script' : server + 'uploadify.php',
				'folder' : server + 'app/webroot/img/uploads',
				'auto' : true,
				'cancelImg' : server + 'img/cancel.png',
				'onComplete' : function(a, b, c, d) {
					var oldImage = $("#single-field-1").val();
					$.post(server + "images/deleteImage", {
						name : oldImage
					}, function(data) {// Elimina la imagen antigua

					});
					$(".preview-1").html('<img  src="' + d + '" />');
					var file = d.split("/");
					var nombre = file[(file.length - 1)];
					var name = c.name;
					$("#single-field-1").val(nombre);
					$.post(server + "images/resizeImage", {
						name : nombre,
						folder : 'uploads'
					}, function(data) {

					});
				}
			});
			$('#single-upload-2').uploadify({
				'uploader' : server + 'swf/uploadify.swf',
				'script' : server + 'uploadify.php',
				'folder' : server + 'app/webroot/img/uploads',
				'auto' : true,
				'cancelImg' : server + 'img/cancel.png',
				'onComplete' : function(a, b, c, d) {
					var oldImage = $("#single-field-2").val();
					$.post(server + "images/deleteImage", {
						name : oldImage
					}, function(data) {// Elimina la imagen antigua

					});
					$(".preview-2").html('<img  src="' + d + '" />');
					var file = d.split("/");
					var nombre = file[(file.length - 1)];
					var name = c.name;
					$("#single-field-2").val(nombre);
					$.post(server + "images/resizeImage", {
						name : nombre,
						folder : 'uploads'
					}, function(data) {

					});
				}
			});
		});

	</script>