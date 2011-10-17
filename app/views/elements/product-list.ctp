<ul class="products tahoma">
	<?php foreach($products as $product):?>
	<li class="info"> 
		<a href="/products/view/<?php echo $product['Product']['id']?>"><img src="/img/uploads/custom/<?php echo $product['Product']['image']?>" /></a>
		<h1 class="titulos_rosado"><?php echo $product['Product']["name"]?></h1>
		<h2 class="subtitulos_gris"><?php echo $product['Product']["clasification"]?></h2>
		<h2 class="subtitulos_gris"><?php echo $product["Brand"]["name"]?></h2>
		<h3 class="azul">$<?php echo  number_format($product['Product']["price"], 0, ' ', '.');?></h3>
	</li>
	<?php endforeach;?>
	<div style='clear:both;'></div>
</ul>
