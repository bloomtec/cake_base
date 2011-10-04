<div class="subcategories_index">
	<div id="slide_categoria"><img src="" /></div>
	<ul class="filtrar">
		<li class="titulos_rosado">FILTRAR POR</li>
		<li class="azul">COLECCIÓN
			<?php 
				$colecciones= $this->requestAction("/brands/getCollections/".$brand['Brand']['id']); 
				echo $form->input("tallas",array("type"=>"select","options"=>$colecciones,"empty"=>"seleccione","div"=>false,"label"=>false,"class"=>"filter",'rel'=>'coleccion'));	
			?>
		</li>
		<li class="azul">TALLA
			<?php if(isset($this->params["named"]["subcategoria"])) $tallas= $this->requestAction("/subcategories/getSizes/".$this->params["named"]["subcategoria"]); ?>
			<?php 
				echo $form->input("tallas",array("type"=>"select","options"=>$tallas,"empty"=>"seleccione","div"=>false,"label"=>false,'class'=>'filter','rel'=>'talla'));
			?>
		</li>
		<li class="titulos_rosado">ORDENAR POR</li>
		<li><a class="azul" href="<?php echo $pageURL?>/orden:nuevo/" rel='orden'>¿QUE ES LO NUEVO?</a></li>
		<li class="titulos_gris">|</li>
		<li><a class="azul" href="<?php echo $pageURL?>/orden:preferido" rel='orden'>¿QUE ES LO PREFERIDO?</a></li>
	</ul>

	<?php echo $this->element("product-list");?>
</div>