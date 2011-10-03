<ul class="products">
	<?php foreach($products as $product):?>
	<li class="info">
		<a href="#"><img src="" /></a>
		<h1 class="titulos_rosado"><?=$product["name"]?></h1>
		<h2 class="subtitulos_gris"><?=$product["clasificacion"]?></h2>
		<h2 class="subtitulos_gris"><?=$brand["Brand"]["name"]?></h2>
		<h3 class="azul">PRECIO: <?=$product["precio"]?></h3>
	</li>
	<?php endforeach;?>
</ul>