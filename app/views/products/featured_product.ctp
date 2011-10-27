<h1><?php $product['Product']['name'];?></h1>
<img src="/img/uploads/<?php $product['Product']['image'];?>" />
<div class="info_destacado">
	<p>
		<?php $product['Product']['description'];?>
	</p>
	<a href=""><img src="/img/facebook.png" /></a>
	<a href=""><img src="/img/twitter.png" /></a>
	<a href="#" class='add-to-cart'><img src="/img/btn_agregar.png"/></a>
	<?php echo $this -> element("estrellas_categoria",array('product'=>$product));?>
</div>