<div class="subcategories_index">
	<div id="slide_categoria"><img src="" /></div>
	<ul class="filtrar">
		<li class="titulos_rosado">FILTRAR POR</li>
		<li class="azul">COLECCIÓN
			<select>
				<option>Enero</option>
				<option>Febrero</option>
			</select>
		</li>
		<li class="azul">TALLA
			<select>
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

	<ul class="products">
		<?php for($i=0;$i<5;$i++):?>
		<li class="info">
			<a href="#"><img src="" /></a>
			<h1 class="titulos_rosado">NOMBRE PRENDA</h1>
			<h2 class="subtitulos_gris">CLASIFICACIÓN</h2>
			<h2 class="subtitulos_gris">MARCA</h2>
			<h3 class="azul">PRECIO:</h3>
		</li>
		<?php endfor;?>
	</ul>
</div>