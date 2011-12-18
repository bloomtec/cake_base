<?php debug($product["Inventory"][0]['quantity']);?>
<h1><?php echo $product['Product']['name'];?></h1>
<div class="detalle_producto galeria">
	<div class="galeria">
		<img src="/img/com_galeria.jpg" />
		<div style="clear: both"></div>
		<a><img class="miniaturas" src="/img/com_minitura.jpg"/></a>
		<a><img class="miniaturas active" src="/img/com_minitura.jpg"/></a>
		<a><img class="miniaturas" src="/img/com_minitura.jpg"/></a>
		<div style="clear: both"></div>
	</div>
	<div class="nuestro_precio">
		<h2>Nuestro Precio</h2>
		<h1>$<?php echo number_format($product['Product']['price'],0,'.','.'); ?></h1>
		<h3>¡ahorrate un 10%!</h3>
	</div>
	<div class="comprar">
		<a class="comprar" href="#">Comprar</a>
		<?php echo $this -> element('poll-in', array('active' => true, 'model'=>'Product','foreign_key' => $product['Product']['id'])); ?>
	</div>
	<div style="clear: both"></div>
	<a class="compartir" href="javascript: void(0);" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php echo urlencode("http://".$_SERVER['SERVER_NAME'].$html->url("/products/".$product["Product"]["slug"]));?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');"><img src="/img/compartir_face.png" /></a>
	<a class="compartir" href="#" onclick="window.open('http://twitter.com/share?url=<?php echo rawurlencode("http://".$_SERVER["SERVER_NAME"]."/products/view/".$html->url("/products/view/".$product["Product"]["id"]));?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');"class="twitter" target="_blank"><img src="/img/compartir_twitt.png" /></a>
</div>
<div class="detalle_producto descripcion">
	<h1>Descripción</h1>
	<p>
		<?php echo $product['Product']['description'];?>
	</p>
	<h1>Especificaciones Técnicas</h1>
	<p class="descripcion">
		Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel.
	</p>
	<ul>
		<li>
			Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit.
		</li>
		<li>
			Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit.
		</li>
		<li>
			Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit.
		</li>
	</ul>
</div>
<div class="detalle_producto relacionados">
	<h1>Productos relacionados</h1>
	<div class="productos_relacionados">
		<a href="#"><img src="/img/computador_categoria.jpg"/></a>
		<a href=""><h1>Computador dell -core i5</h1></a>
		<h2>Precio: <span>$1.500.000</span></h2>
		<a href="#"><img src="/img/computador_categoria.jpg"/></a>
		<a href=""><h1>Computador dell -core i5</h1></a>
		<h2>Precio: <span>$1.500.000</span></h2>
		<a href="#"><img src="/img/computador_categoria.jpg"/></a>
		<a href=""><h1>Computador dell -core i5</h1></a>
		<h2>Precio: <span>$1.500.000</span></h2>
	</div>
</div>
<div class="comentar">
	<h1>Déjanos un comentario</h1>
	<?php echo $this -> element('simpleCommentForm',array("model"=>"Product","foreign_key"=>$product["Product"]["id"])); ?>

</div>
<div class="otros_comentarios">
	<h1>Comentarios</h1>
	<?php echo $this -> element('comments',array("comments"=>$product["Comment"]))?>
</div>
<div style="clear: both"></div>