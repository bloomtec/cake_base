<div class="subcategories_index">
	<div id="slide_categoria"><img src="" /></div>
	<ul class="filtrar">
		<li class="titulos_rosado">FILTRAR POR</li>
		<li class="azul">COLECCIÓN
			<?php if(isset($this->params["named"]["subcategoria"])) $colecciones= $this->requestAction("/brand/getSizes/".$brand['Brand']['id']); ?>
			<?php if(isset($colecciones)):?>
			<select class="filter" rel="coleccion">
				<option>Enero</option>
				<option>Febrero</option>
			</select>
			<?php endif;?>
		</li>
		<li class="azul">TALLA
			<select class="filter" rel="talla">
				<option>35</option>
				<option>36</option>
				<option>37</option>
				<option>38</option>
			</select>
		</li>
		<li class="titulos_rosado">ORDENAR POR</li>
		<li><a class="azul" href="#">¿QUE ES LO NUEVO?</a></li>
		<li class="titulos_gris">|</li>
		<li><a class="azul" href="#">¿QUE ES LO PREFERIDO?</a></li>
	</ul>

	<?php echo $this->element("product-list");?>
</div>