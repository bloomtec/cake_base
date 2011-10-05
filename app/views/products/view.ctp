<div class="products_view tahoma">
	<div id="detalle_izq">
		<div id="gallery">
			<?php if(!empty($product['ProductPicture'])) echo $this->element('gallery-thumbs-scrollable',array("thumbsAtTime"=>5,'pictures'=>$product['ProductPicture']));?>
		</div>
		<div style="clear: both"></div>
			
		<div id="comments">
			<div>
				<h3>QUE HAN DICHO OTROS CLIENTES</h3>
				<h3>ORDENAR POR</h3>
				<select></select>
			</div>
			<div class="comments">
				<ul>
					<li class="titulos_rosado twCenMt">GEORGECE007</li>
					<li class="azul twCenMt">12-08-2011</li>
				</ul>
				<p>Tiene un forro superior o Capellada en lona algodón (100%), con un elástico que permite amoldarse a las distintas alturas del empeine.
				</p>
				<div style="clear: both"></div>
				
			</div>
		<a class="azul" href="#">ESCRIBIR COMENTARIO</a>
		</div>

	</div>
	<div id="detalle_der">
		<h1 class="titulos_rosado">NOMBRE PRENDA</h1>
		<span class="puntos"></span>
		<ul class="product_info">
			<li>CLASIFICACION</li>
			<li>MARCA</li>
			<li><span>PRECIO:</span></li>
		</ul>
		<ul class="product_info">
			<li>TALLA
			 <select>
				<option>10</option>
				<option>12</option>
			</select>
			</li>			
		</ul>
		<ul class="product_info">
			<li><a href="#">anterior</a></li>
		</ul>
		<ul class="product_info" style='margin-right: 0;'>
			<li><a href="#">siguiente</a></li>			
		</ul>	
		<div style="clear: both"></div>
		<div class="agregar">
			<div class="agregar_carrito twCenMt">
				<h1><a href="#">Agregar al carrito</a></h1>
			</div>
			<div class="agregar_regalo twCenMt">
				<h1><a href="#">Agregar como regalo</a></h1>
			</div>
			<div style="clear: both"></div>
		</div>	
		<span class="puntos"></span>
		<h1 class="titulos_rosado"><a class="titulos_rosado" href="#">¿NO ENCONTRASTE LO QUE BUSCABAS?</a></h1>
		<span class="puntos"></span>
		<div id="caracteristicas">
		<h1 class="titulos_rosado">CARACTERISTICAS:</h1>
		<p>
			<?php echo $product['Product']['description'];?>
		</p>
		<span class="puntos"></span>
		</div>
		<div class="dudas">
		<h1 class="titulos_rosado"><a class="titulos_rosado" href="#">TIENES ALGUNA DUDA? PREGUNTANOS POR CORREO</a></h1>
		<span class="puntos"></span>
		</div>
		<h2 class="titulos_rosado">COMPARTE ESTE PRODUCTO</h2>
        <ul class="social">
        <li><a class="facebook" href="#">facebook</a></li>
        <li><a class="twitter" href="#">twitter</a></li>
        </ul>
		<span class="puntos"></span>
		
		
		<?php $recomendados1=$this->requestAction('/products/findRecommendedProducts/'.$product['Product']['id']);?>
		<?php if($recomendados1):?>
		<h3 class="titulos_rosado">CON QUE LO PODRÍAS USAR </h1>
		<?php echo $this->element("recomendado",array("products"=>$recomendados1));?> 
		<?php endif; ?>
		
		<?php $recomendados1=$this->requestAction('/products/findRecommendedProducts/'.$product['Product']['id']);?>
		<?php if($recomendados1):?>
		<h3 class="titulos_rosado">TAMBIÉN TE RECOMENDAMOS</h1>
		<?php echo $this->element("recomendado",array("products"=>$recomendados1));?> 
		<?php endif; ?>
	</div>

</div>
