<div class="products_view tahoma">
	<div id="detalle_izq">
		<div id="gallery">
			<?php if(!empty($product['ProductPicture'])) echo $this->element('gallery-thumbs-scrollable',array("thumbsAtTime"=>5,'pictures'=>$product['ProductPicture']));?>
		</div>
		<div style="clear: both"></div>
			
		<div id="comments" class="tahoma">
			<div class="comment_header">
			<?php
				if($comments) {
			?>
				<h3>QUE HAN DICHO OTROS CLIENTES</h3>
			<?php
				} else {
			?>
				<h3>¡SE EL PRIMERO EN ESCRIBIR UN COMENTARIO!</h3>
			<?php
				}
			?>
			<!--	<h3>ORDENAR POR</h3>
				<select></select> -->
			</div>
			<?php
				if($comments) {
					foreach ($comments as $key => $comment) {
						
			?>
			<div class="comments">
				<div class="linea_comment">
					<ul>
						<?php $user_email = split("@", $comment['User']['email']); ?>
						<li class="titulos_rosado twCenMt"><?=$user_email[0]?></li>
						<li class="azul twCenMt"><?=$comment['Comment']['created']?></li>
					</ul>
					<p><?=$comment['Comment']['comment']?></p>
					<div style="clear: both"></div>
				</div>
			</div>
			<?php
					}
				}
			?>
		<!--
		<a id="escribir-comentario" class="azul tahoma" href="#">ESCRIBIR COMENTARIO</a>
		<div id="user-info" class="azul tahoma" style="visibility: hidden;">
			<h3>¡DEBES ESTAR REGISTRADO PARA DEJAR UN COMENTARIO!</h3>
		</div>
		-->
		<?php if($this->Session->read('Auth.User.id')): ?>
		<div id="create-comment" style='margin-top: 5px;'>
			<form id="CommentAddForm" class="comment-form" accept-charset="utf-8" method="post" action="/comments/add">
			<input id="CommentProductId" type="hidden" value="<?=$product['Product']['id']?>" name="data[Comment][product_id]">
			<textarea placeholder='Escribe aqui tu comentario' id="CommentComment" name="data[Comment][comment]" style="width: 99%; background: transparent; color: #A1A1A1;"></textarea>
			</form>
			<a id="enviar-comentario" class="azul tahoma" href="#">ENVIAR COMENTARIO</a>
		</div>
		<?php endif;?>
		</div>

	</div>
	<div id="detalle_der">
		<h1 class="titulos_rosado" style='text-transform: uppercase;'><?php echo $product['Product']['name'];?></h1>
		<span class="puntos"></span>
		<ul class="product_info">
			<li><?php echo $product['Product']["clasification"];?></li>
			<li>MARCA: <?php echo $product['Brand']["name"];?></li>
			<li><span>PRECIO: $<?php echo number_format($product['Product']["price"], 0, ' ', '.'); ?></span></li>
		</ul>
		<ul class="product_info">
			<li>TALLA
			 <select class="ids-tallas">
			 	<?php
			 		$inventory_size_ids = $this->requestAction('/inventories/listSizeIDs/'.$product['Product']['id']);
					$size_size_reference_ids = array();
					foreach ($inventory_size_ids as $key => $value) {
						$size_size_reference_ids[] = $this->requestAction('/sizes/getSizeReferenceID/'.$value);
					}
					$size_reference_ids = $this->requestAction('/size_references/listSizes');
					$product_sizes = array();
					foreach($size_reference_ids as $sr_key => $sr_value) {
						foreach($size_size_reference_ids as $key=>$val){
							if($val==$sr_key){
								$product_sizes[$sr_key]=$sr_value;
							}
						} 
					}
					foreach ($product_sizes as $sr_key => $sr_value) {
						echo "<option id=" . $sr_key . ">$sr_value</option>";
					}
			 	?>
			</select>
			</li>			
		</ul>
		<!--
		<ul class="product_info primero">
			<li><a href="#">Anterior</a></li>
		</ul>
		<ul class="product_info ultimo">
			<li><a href="#">Siguiente</a></li>			
		</ul>
		-->
		<div style="clear: both"></div>
		<div class="agregar">
			<div class="agregar_carrito shop-cart-item" rel="Product:<?php echo $product['Product']['id'];?>:0">
				<h1 class="twCenMt"><a class="add-to-cart" href="#">Agregar al carrito</a></h1>
			</div>
			<div class="agregar_regalo shop-cart-item twCenMt" rel="Product:<?php echo $product['Product']['id'];?>:1">
				<h1><a class="add-to-cart" href="#">Agregar como regalo</a></h1>
			</div>
			<div style="clear: both"></div>
			<div class='add-cart-confirm tahoma'>
				Produccto agregaro pagar
			</div>
		</div>	
		<span class="puntos"></span>
		<h1 class="titulos_rosado"><a class="titulos_rosado" rel="#overlay" href="/pages/notificacionDisponibilidad/<?php echo $product['Product']['id'];?>">¿NO ENCONTRASTE LO QUE BUSCABAS?</a></h1>
		<span class="puntos"></span>
		<div id="caracteristicas">
		<h1 class="titulos_rosado" style="font-size: 12px;">CARACTERISTICAS:</h1>
		<p>
			<?php echo $product['Product']['description'];?>
		</p>
		<span class="puntos"></span>
		</div>
		<div class="dudas">
		<h1 class="titulos_rosado"><a class="titulos_rosado" rel="#overlay" href="/pages/dudasCompra">TIENES ALGUNA DUDA? PREGUNTANOS POR CORREO</a></h1>
		<span class="puntos"></span>
		</div>
		<h2 class="titulos_rosado">COMPARTE ESTE PRODUCTO</h2>
        <ul class="social">
        <li>
        	<a class='facebook' href="javascript: void(0);" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php echo urlencode("http://".$_SERVER['SERVER_NAME'].$html->url("/products/view/".$product["Product"]["id"]));?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');">
				Compartir en facebook
			</a> 
			<div style='clear:both;'></div>
        </li>
        <li>
        	<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
			<!-- <a href="http://twitter.com/share?url=http%3A%2F%2Fdev.twitter.com&amp;via=your_screen_name" class="boton-twitter">Compartir en twitter</a>--> 
			<a  onclick="window.open('http://twitter.com/share?url=<?php echo rawurlencode("http://".$_SERVER["SERVER_NAME"]."/products/view/".$html->url("/products/view/".$product["Product"]["id"]));?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');"class="twitter" target="_blank">
				twitter
			</a>
			<div style='clear:both;'></div>
       </li>
        </ul>
		<span class="puntos"></span>
		
		
		<?php $recomendados1=$this->requestAction('/products/findRecommendedProducts/'.$product['Product']['id']);?>
		<?php if($recomendados1):?>
		<h3 class="titulos_rosado">TAMBIÉN TE PODRÍA GUSTAR</h1>
		<?php echo $this->element("recomendado",array("products"=>$recomendados1));?> 
		<?php endif; ?>
		
		<?php $recomendados1=$this->requestAction('/products/findOtherRecommendedProducts/'.$product['Product']['id']);?>
		<?php if($recomendados1):?>
		<h3 class="titulos_rosado">LO PUEDES USAR CON</h1>
		<?php echo $this->element("recomendado",array("products"=>$recomendados1));?> 
		<?php endif; ?>
		
		<?php $visited_products = $this->requestAction('/visited_products/sync/'.$product['Product']['id']); ?>
		<?php if($visited_products):?>
		<h3 class="titulos_rosado">LO QUE HAS VISTO ULTIMAMENTE</h1>
		<?php echo $this->element("recomendado",array("products"=>$visited_products));?> 
		<?php endif; ?>
	</div>
</div>
