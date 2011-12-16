<h1>nombre del producto</h1>
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
		<h1>$ 1.500.000</h1>
		<h3>¡ahorrate un 10%!</h3>
	</div>
	<div class="comprar">
		<a class="comprar" href="#">Comprar</a>
		<?php echo $this -> element('poll-in', array('active' => true, '$product' => $product)); ?>
	</div>
	<div style="clear: both"></div>
	<a class="compartir" href="#"><img src="/img/compartir_face.png" /></a>
	<a class="compartir" href="#"><img src="/img/compartir_twitt.png" /></a>
</div>
<div class="detalle_producto descripcion">
	<h1>Descripción</h1>
	<p>
		Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.

		Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.

		Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
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
	<form>
		<label>Nombre:</label>
		<input type="text" />
		<label>E-mail:</label>
		<input type="text" />
		<label>Comentario:</label>
		<textarea></textarea>
		<input type="submit" class="submit" value="Enviar" />
	</form>
</div>
<div class="otros_comentarios">
	<h1>Otros Comentarios</h1>
	<div class="comentario_usuario">
		<div class="usuario">
			<h1>Ricardo</h1>
			<img class="estrellas" src="/img/estrella_categoria.png" />
			<img class="estrellas" src="/img/estrella_categoria.png" />
			<img class="estrellas" src="/img/estrella_categoria.png" />
			<img class="estrellas" src="/img/estrella_categoria.png" />
			<img class="estrellas" src="/img/estrella_categoria.png" />
		</div>
		<div class="comentario">
			<p>
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.
			</p>
		</div>
	</div>
</div>
<div style="clear: both"></div>