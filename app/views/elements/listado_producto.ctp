<?php if(isset($product)&&!empty($product)){?>
<?php foreach($products as $product): ?>
<div class="producto">
	<h1><?php echo $product['name']?></h1>
	<a href="/productos/<?php echo $product['slug']?>"><img src="/img/uploads/<?php echo $product['image']?>" class="foto_producto" /></a>
	<h2>Precio: <?php echo $product['price']?></h2>
	<a href=""><img src="/img/facebook.png" /></a>
	<a href=""><img src="/img/twitter.png" /></a>
	<a href=""><img src="/img/btn_agregar.png"/></a>
	<?php echo $this -> element("estrellas_categoria",array('product'=>$product));?>
</div>
<?php endforeach; ?>
<?php }else{?>
	<h1 class='no-datos'>No hay productos en la categoria</h1>
<?php } ?>
<div style="clear: both"></div>