<div class="deals form2">
	<?php echo $this -> Form -> create('Deal');?>
	<fieldset>
		<legend>
			<?php __('Agregar Promo');?>
		</legend>
		<?php
		echo $this -> Form -> input('restaurant_id', array('label' => __('Restaurante', true)));
		echo $this -> Form -> input('name', array('label' => __('Nombre', true)));
		echo $this -> Form -> input('is_promoted', array('label' => __('Promocionada', true)));
		echo $this -> Form -> input('description', array('label' => __('Descripción', true)));
		//echo $this -> Form -> input('conditions', array('label' => __('Áreas de cobertura:', true)));
		echo $this -> Form -> hidden('image', array('id' => 'single-field'));
		echo $this -> Form -> hidden('image_large', array('id' => 'single-field-2'));
		echo $this -> Form -> input('amount', array('label' => __('Cantidad', true)));
		echo $this -> Form -> input('price', array('label' => __('Precio', true)));
		echo $this -> Form -> input('normal_price', array('label' => __('Precio Normal', true)));
		//echo $this -> Form -> input('max_buys', array('label' => __('Limite', true)));
		echo $this -> Form -> input('expires', array('label' => __('Vence', true)));
		echo $this -> Form -> input('Cuisine', array('label' => __('Cocina', true), 'multiple' => 'checkbox'));
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Enviar', true));?>
</div>
<div class="images">
	<h2><?php __('Imagen');?></h2>
	<div class="preview">
		<div class="wrapper">
			<?php
			if (isset($this -> data['Deal']['image']) && !empty($this -> data['Deal']['image'])) {
				echo $this -> Html -> image('uploads/' . $this -> data['Deal']['image']);
			} else {
				echo $this -> Html -> image('preview.png');
			}
			?>
		</div>
	</div>
	<div id="single-upload" controller="deals"></div>
</div>
<div class="images">
	<h2><?php __('Imagen Promocionada');?></h2>
	<div class="preview-2">
		<div class="wrapper">
			<?php
			if (isset($this -> data['Deal']['image_large']) && !empty($this -> data['Deal']['image_large'])) {
				echo $this -> Html -> image('uploads/' . $this -> data['Deal']['image_large']);
			} else {
				echo $this -> Html -> image('preview.png');
			}
			?>
		</div>
	</div>
	<div id="single-upload-2" controller="deals"></div>
</div>
<script type="text/javascript">
	CKEDITOR.replace('data[Deal][description]', {
		filebrowserUploadUrl : '/upload.php',
		filebrowserBrowseUrl : '/admin/pages/wysiwyg',
	});

</script>
<!--<script type="text/javascript">
	CKEDITOR.replace('data[Deal][conditions]', {
		filebrowserUploadUrl : '/upload.php',
		filebrowserBrowseUrl : '/admin/pages/wysiwyg',
	});

</script>-->