<?php //debug($product["Inventory"][0]['quantity']);?>
<h1 class="product_name"><?php echo $product['Product']['name'];?></h1>
<div class="detalle_producto galeria">
	<?php /*if(!empty($product['ProductPicture']))*/  echo $this->element('gallery-thumbs-scrollable',array("thumbsAtTime"=>3,'pictures'=>$product['ProductPicture']));?>
	<div class="nuestro_precio">
		<h2>Nuestro Precio</h2>
		<h1>$<?php echo number_format($product['Product']['price'],0,'.','.'); ?></h1>
		<h3>¡ahorrate un 10%!</h3>
	</div>
	<div class="comprar">
		<?php if($product['Inventory'][0]['quantity']):?>
		<a href="/shopCarts/add-to-cart/Product:<?php echo $product['Product']['id']; ?>:0" rel='Product:<?php echo $product['Product']['id']; ?>:0'class="comprar add-to-cart" href="#">Comprar</a>
		<div class='add-cart-confirm' >
			producto agregado ir a pagar
		</div>
		<?php endif;?>
		<?php echo $this -> element('poll-in', array('active' => true, 'model'=>'Product','foreign_key' => $product['Product']['id'])); ?>
	</div>
	<div style="clear: both"></div>
	<a class="compartir" href="javascript: void(0);" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php echo urlencode("http://".$_SERVER['SERVER_NAME'].$html->url("/products/".$product["Product"]["slug"]));?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');"><img src="/img/compartir_face.png" /></a>
	<a class="compartir" href="#" onclick="window.open('http://twitter.com/share?url=<?php echo rawurlencode("http://".$_SERVER["SERVER_NAME"]."/products/view/".$html->url("/products/view/".$product["Product"]["id"]));?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');"class="twitter" target="_blank"><img src="/img/compartir_twitt.png" /></a>
</div>
<div class="detalle_producto descripcion">
	<h1>Descripción</h1>
	<div class='description'>
		<?php echo $product['Product']['description'];?>
	</div>
	<h1>Especificaciones Técnicas</h1>
	<div class='tech_specs'>
		<?php echo $product['Product']['tech_specs'];?>
	</div>
</div>
<div class="detalle_producto relacionados">
	<?php $recomendados=$this->requestAction('/products/findRecommendedProducts/'.$product['Product']['id']);?>
	<h1>Productos relacionados</h1>
	<?php foreach($recomendados as $recomendado):?>
	<div class="productos_relacionados">
		<a href="/productos/<?php echo $recomendado['Product']['slug']; ?>"><img src="/img/uploads/100x100/<?php echo $recomendado['Product']['image']; ?>" /></a>
	
		<h1><a href="/productos/<?php echo $recomendado['Product']['slug']; ?>"><?php echo $recomendado['Product']['name']; ?></a></h1>
		<h2>Precio: <span>$<?php echo number_format($product['Product']['price'],0,'.','.'); ?></span></h2>
	</div>
	<?php endforeach;?>
</div>
<div class="comentar">
	<h1>Déjanos un comentario</h1>
	<p>
		Para nosotros es muy importante tu opinión
	</p>
	<?php echo $this -> element('simpleCommentForm',array("model"=>"Product","foreign_key"=>$product["Product"]["id"])); ?>

</div>
<div class="otros_comentarios">
	<h1>Comentarios</h1>
	<?php echo $this -> element('comments',array("comments"=>$product["Comment"]))?>
</div>
<div style="clear: both"></div>