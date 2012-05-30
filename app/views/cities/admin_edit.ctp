<div class="cities form2">
	<?php echo $this -> Form -> create('City');?>
	<fieldset>
		<legend>
			<?php __('Editar Ciudad');?>
		</legend>
		<?php
		echo $this -> Form -> input('id');
		echo $this -> Form -> input('country_id', array('label' => __('País', true)));
		echo $this -> Form -> input('name', array('label' => __('Nombre', true)));
		echo $this -> Form -> input('description', array('label' => __('Descripción', true)));
		echo $this -> Form -> hidden('image', array('id' => 'single-field'));
		echo $this -> Form -> input('is_present', array('label' => __('Presente', true)));
		echo $this -> Form -> input('code', array('label' => __('Código', true)));
		//echo $this->Form->input('lat');
		//echo $this->Form->input('long');
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
	<div id="single-upload" controller="cities"></div>
</div>
