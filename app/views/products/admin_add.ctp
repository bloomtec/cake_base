<div class="products form2">
	<?php echo $this -> Form -> create('Product');?>
	<fieldset>
		<legend>
			<?php __('Admin Add Product');?>
		</legend>
		<?php
		echo $this -> Form -> input('product_type_id', array("empty" => "Seleccione..."));
		echo $this -> Form -> hidden('image', array('id' => 'single-field'));
		e('<div id="ProductProductTypeInfo"></div>');
		echo $this -> Form -> input('brand_id');
		echo $this -> Form -> input('name');
		echo $this -> Form -> input('description');
		echo $this -> Form -> input('tech_specs');
		echo $this -> Form -> input('ref');
		echo $this -> Form -> input('price');
		echo $this -> Form -> input('keywords');
		echo $this -> Form -> input('recommendations');
		echo $this -> Form -> input('is_gamers');
		echo $this -> Form -> input('is_active');
		echo $this -> Form -> input('is_featured');
		echo $this -> Form -> input('Tag', array('multiple'=>'checkbox'));
		//echo $this -> Form -> input('Tag', array('type'=>'radio'));
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Submit', true));?>
</div>
<div class="images">
	<h2>Image</h2>
	<div class="preview">
		<div class="wrapper">
			<?php echo $this -> Html -> image('preview.png');?>
		</div>
	</div>
	<div id="single-upload" controller="products"></div>
</div>
