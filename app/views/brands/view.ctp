<div class="subcategories_index">
	<div id="slide_categoria"><img src="" /></div>
	<ul class="filtrar">
		<li class="titulos_rosado">FILTRAR POR</li>
		<li class="azul">COLECCIÓN
			
			<select class="filter" rel="coleccion">
				<option>Enero</option>
				<option>Febrero</option>
			</select>
			
		</li>
		<li class="azul">TALLA
			<?php if(isset($this->params["named"]["subcategoria"])) $tallas= $this->requestAction("/subcategories/getSizes/".$this->params["named"]["subcategoria"]); ?>
			<?php 
				if(isset($tallas)){
					echo $form->input("tallas",array("ype"=>"select","options"=>$tallas,"empty"=>"seleccione","div"=>false,"label"=>false));
				}
			?>
		</li>
		<li class="titulos_rosado">ORDENAR POR</li>
		<li><a class="azul" href="#">¿QUE ES LO NUEVO?</a></li>
		<li class="titulos_gris">|</li>
		<li><a class="azul" href="#">¿QUE ES LO PREFERIDO?</a></li>
	</ul>

	<?php echo $this->element("product-list");?>
</div>