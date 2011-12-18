<?php if(isset($product) && !empty($product)){ ?>
<h1><?php echo $product['Product']['name'];?></h1>
<img src="/img/uploads/<?php echo $product['Product']['image']; ?>" />
<div class="info_destacado">
	<p>
		<?php echo $product['Product']['description'];?>
	</p>
	<a href="javascript: void(0);" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php echo urlencode("http://".$_SERVER['SERVER_NAME'].$html->url("/products/".$product["Product"]["slug"]));?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');"><img src="/img/facebook.png" /></a>		
	
	<a href="#" onclick="window.open('http://twitter.com/share?url=<?php echo rawurlencode("http://".$_SERVER["SERVER_NAME"]."/products/view/".$html->url("/products/view/".$product["Product"]["id"]));?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');"class="twitter" target="_blank"><img src="/img/twitter.png" /></a>
	<a href="#" class='add-to-cart'><img src="/img/btn_agregar.png"/></a>
	<?php echo $this -> element("poll-in",array('product' => $product , 'active' => false ));?>
</div>
<?php }else{ ?>
	<?php echo $this->element('promo-gamers');?>
<?php } ?>