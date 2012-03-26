<div class="cuisines form2">
	<?php echo $this -> Form -> create('Cuisine');?>
	<fieldset>
		<legend>
			<?php __('Agregar Cocina');?>
		</legend>
		<?php
		echo $this -> Form -> input('name', array('label' => __('Nombre', true)));
		echo $this -> Form -> input('description', array('label' => __('Descripción', true)));
		echo $this -> Form -> hidden('image', array('id' => 'single-field'));
		// echo $this -> Form -> input('Deal');
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Enviar', true));?>
</div>
<div class="images">
	<h2><?php __('Imagen'); ?></h2>
	<div class="preview">
		<div class="wrapper">
			<?php echo $this -> Html -> image('preview.png');?>
		</div>
	</div>
	<div id="single-upload" controller="cuisines"></div>
</div>