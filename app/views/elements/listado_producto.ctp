<?php
	if(isset($products) && !empty($products)) {
	foreach($products as $product) :
?>
<div class="producto">
	<h1><a href="/productos/<?php echo $product['Product']['slug']; ?>"><?php echo $product['Product']['name']; ?></a></h1>
	<a href="/productos/<?php echo $product['Product']['slug']; ?>"><img src="/img/uploads/100x100/<?php echo $product['Product']['image']; ?>" class="foto_producto" /></a>
	<h2>Precio: $<?php echo number_format($product['Product']['price'], 0, ",", "."); ?></h2>
	<a href="javascript: void(0);" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php echo urlencode("http://".$_SERVER['SERVER_NAME'].$html->url("/products/".$product["Product"]["slug"]));?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');"><img src="/img/facebook.png" /></a>		
	
	<a onclick="window.open('http://twitter.com/share?url=<?php echo rawurlencode("http://".$_SERVER["SERVER_NAME"]."/products/view/".$html->url("/products/view/".$product["Product"]["id"]));?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');"class="twitter" target="_blank"><img src="/img/twitter.png" /></a>
	<a href="#" class='add-to-cart'><img src="/img/btn_agregar.png"/></a>
	<div class='add-cart-confirm'>
		producto agregado ir a pagar
	</div>
	<?php echo $this -> element("estrellas_categoria",array('product'=>$product));?>
</div>
<?php endforeach; ?>
<?php }else{?>
	<h1 class='no-datos'>No hay productos en la categoria</h1>
<?php } ?>
<div style="clear: both"></div>