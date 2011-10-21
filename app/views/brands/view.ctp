<div class="subcategories_index">
	<?php if(isset($subcategory) && !empty($subcategory)):?>
	<div id="slide_categoria">
		<?php echo $html->image('uploads/'.$subcategory['Subcategory']['image']);?>
	</div>
	<?php endif;?>
	<ul class="filtrar twCenMt">
		<li class="titulos_rosado">
			FILTRAR:
		</li>
		<li class="azul">
			COLECCIÓN 
			<?php
			$selected=null;
			if(isset($this->params['named']['coleccion'])) $selected=$this->params['named']['coleccion'];
			$colecciones = $this -> requestAction("/brands/getCollections/" . $brand['Brand']['id']);
			echo $form -> input("tallas", array('selected'=>$selected,"type" => "select", "options" => $colecciones, "empty" => "seleccione", "div" => false, "label" => false, "class" => "filter", 'rel' => 'coleccion'));
			?>
		</li>
		<li class="azul">
			<?php
			if (isset($this -> params["named"]["subcategoria"])) {
				echo 'TALLA';
				$selected=null;
				if(isset($this->params['named']['talla'])) $selected=$this->params['named']['talla'];
				$tallas = $this -> requestAction("/subcategories/getSizes/" . $this -> params["named"]["subcategoria"]);
				echo $form -> input("tallas", array("type" => "select", "options" => $tallas, "empty" => "seleccione", "div" => false, "label" => false, 'class' => 'filter', 'rel' => 'talla','selected'=>$selected));
			}
			?>
		</li>
		<li class="titulos_rosado">
			ORDENAR:
		</li>
		<li>
			<a class="azul order" href="<?php echo $pageURL?>/orden:nuevo/" rel='nuevo'>¿QUE ES LO NUEVO?</a>
		</li>
		<li class="titulos_gris">
			|
		</li>
		<li>
			<a class="azul order" href="<?php echo $pageURL?>/orden:preferido" rel='preferido'>¿QUE ES LO PREFERIDO?</a>
		</li>
	</ul>
	<?php echo $this -> element("product-list");?>
	<div class="paging tahoma">
	<?php 
	if($this-> Paginator -> hasPage(2)){
	echo $this -> Paginator -> prev('<< ' . __('Anterior', true), array(), null, array('class' => 'disabled'));?>
	| 	<?php echo $this -> Paginator -> numbers();?>
	|
	<?php echo $this -> Paginator -> next(__('Siguiente', true) . ' >>', array(), null, array('class' => 'disabled'));
	}
	?>
	
</div>
</div>
<script type="text/javascript">
	Cufon.replace('.tahoma', {
		fontFamily : 'Tahoma',
		trim : "simple",
		hoverables:{a:true},
		hover:{color:'#ffaedc'}

	});
	Cufon.replace('.japan', {
		fontFamily : 'Japan',
		trim : "simple"
	});

	Cufon.replace('.twCenMt', {
		fontFamily : 'TwCenMt',
		trim : "simple",
		hoverables:{a:true},
		hover:{color:'#00CFB5'}
	});
	
	Cufon.replace('.halo', {
		fontFamily : 'HaloHandLetter',
		trim : "simple"
	});	
	
</script>