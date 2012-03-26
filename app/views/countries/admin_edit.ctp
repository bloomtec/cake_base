<div class="countries form2">
	<?php echo $this -> Form -> create('Country');?>
	<fieldset>
		<legend>
			<?php __('Editar País');?>
		</legend>
		<?php
		echo $this -> Form -> input('id');
		echo $this -> Form -> input('name', array('label' => __('Nombre', true)));
		echo $this -> Form -> input('description', array('label' => __('Descripción', true)));
		echo $this -> Form -> hidden('image', array('id' => 'single-field'));
		echo $this -> Form -> input('language', array('label' => __('Idioma', true)));
		echo $this -> Form -> input('is_present', array('label' => __('Presente', true)));
		echo $this -> Form -> input('code', array('label' => __('Código', true)));
		$money_symbols = Configure::read('currencies');
		echo $this -> Form -> input('money_symbol', array('label' => __('Símbolo Monetario', true), 'type' => 'select', 'options' => $money_symbols));
		echo $this -> Form -> input('price_ranges', array('label' => __('Rangos De Precios', true) . ' (1-2:3-4, etc)'));
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Enviar', true));?>
</div>
<div class="images">
	<h2><?php __('Imagen');?></h2>
	<div class="preview">
		<div class="wrapper">
			<?php echo $this -> Html -> image('uploads/200x200/' . $this -> data['Country']['image']);?>
		</div>
	</div>
	<div id="single-upload" controller="countries"></div>
</div>
