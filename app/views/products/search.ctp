<div class="buscar tahoma">
	<div class="izq">
		<h3>También puedes buscar por marca</h3>
		<?php foreach($brands as $brand):?>
			<div class="marcas">
				<img src="/img/uploads/<?php echo  $brand['Brand']['image_brand']?>" />
				<h1><?php echo $brand['Brand']['name'];?></h1>
				<h2><?php echo $brand['Brand']['country'];?></h2>
				<div style="clear: both"></div>
			</div>
		<?php endforeach;?>
	</div>
	<div class="der">
	<h3>Resultados</h3>
		<ul class="products tahoma">
		<?php foreach($products as $product):?>
		<li class="info"> 
			<a href="/products/view/<?php echo $product['Product']['id']?>"><img src="/img/uploads/custom/<?php echo $product['Product']['image']?>" /></a>
			<h1 class="titulos_rosado"><?php echo $product['Product']["name"]?></h1>
			<h2 class="subtitulos_gris"><?php echo $product['Product']["clasification"]?></h2>
			<h2 class="subtitulos_gris"><?php echo $product["Brand"]["name"]?></h2>
			<h3 class="azul">PRECIO: <?php echo $product['Product']["price"]?></h3>
		</li>
		<?php endforeach;?>
</ul>
	</div>
</div>