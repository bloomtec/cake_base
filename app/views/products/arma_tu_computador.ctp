<!-- the form -->
<form action="#" class="aplicacion">

	
	<div class="panes">
		<div>
			<h1>Procesador</h1>
			<p>
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
			</p>
			<div class="seleccionar">
				<label>Elije la marca de tu procesador</label>
				<select>
					<option>Amd</option>
					<option>Intel</option>
				</select>
			</div>
			<a href="#" class="siguiente_paso">Siguiente paso</a>
			<div style="clear: both;margin-bottom: 10px"></div>
			<input type="radio" />			
			<p class="descripcion">
				<span>amd opteron 64:</span> Procesador de 6 nucleos, 3.33GHz, 12MB Cache
				Precio: $ 500.000
			</p>
			<input type="radio" />			
			<p class="descripcion">
				<span>amd opteron 64:</span> Procesador de 6 nucleos, 3.33GHz, 12MB Cache
				Precio: $ 500.000
			</p>
			<input type="radio" />			
			<p class="descripcion">
				<span>amd opteron 64:</span> Procesador de 6 nucleos, 3.33GHz, 12MB Cache
				Precio: $ 500.000
			</p>
			
			
			
		</div>
		<div>Second tab content</div>
		<div>Third tab content</div>
		<div>First tab content. Tab contents are called "panes"</div>
		<div>Second tab content</div>
		<div>Third tab content</div>
		<div>First tab content. Tab contents are called "panes"</div>
		<div>Second tab content</div>
		<div>Third tab content</div>
		<div>First tab content. Tab contents are called "panes"</div>
		<div>Second tab content</div>
	</div>
	<div class="resumen">
		<h1>Resumen de la compra</h1>
		<div class="precio">
			<img src="/img/computador.jpg"/>
			<h2>Precio total:1.500.000</h2>
		</div>
		<div class="resumen_menu">
			<ul>
				<li><a href="">Ir a mi carrito</a></li>
				<li><a href="">Pagar</a></li>
				<li><a href="">Imprimir</a></li>
			</ul>
		</div>
		<div class="resumen_productos">
			<a href="/"><h1>Procesador</h1></a>
			<a href="/"><h2>algo</h2></a>
			<a href="/"><h1>Tarjeta madre</h1></a>
			<a href="/"><h2>algo</h2></a>
			<a href="/"><h1>Tarjeta de video</h1></a>
			<a href="/"><h2>algo</h2></a>
			<a href="/"><h1>Memoria RAM</h1></a>
			<a href="/"><h2>algo</h2></a>
			<a href="/"><h1>Discos duros</h1></a>
			<a href="/"><h2>algo</h2></a>
			<a href="/"><h1>Monitor</h1></a>
			<a href="/"><h2>algo</h2></a>
			<a href="/"><h1>Torre</h1></a>
			<a href="/"><h2>algo</h2></a>
			<a href="/"><h1>Fuente</h1></a>
			<a href="/"><h2>algo</h2></a>
			<a href="/"><h1>Unidades óptcas</h1></a>
			<a href="/"><h2>algo</h2></a>
			<a href="/"><h1>Periféricos</h1></a>
			<a href="/"><h2>algo</h2></a>
			<a href="/"><h1>Tarjetas adicionales</h1></a>
			<a href="/"><h2>algo</h2></a>
			<a href="/"><h1>Accesorios</h1></a>
			<a href="/"><h2>algo</h2></a>
		</div>
		
	</div>
		<a class="prev browse left"></a>
		<div class="scrollable">   
			<ul class='tabs items'>
				<li><a href="#"><div class="img_wrapper"><img src="/img/procesador.png" /></div>Procesador y tarjeta madre</a></li>
				<li><a href="#"><div class="img_wrapper"><img src="/img/tarjeta_video.png" /></div>Tarjeta de video</a></li>
				<li><a href="#"><div class="img_wrapper"><img src="/img/ram.png" /></div>Memoria Ram</a></li>
				<li><a href="#"><div class="img_wrapper"><img src="/img/disco_duro.png" /></div>Discos duros</a></li>
				<li><a href="#"><div class="img_wrapper"><img src="/img/monitor.png" /></div>Monitor</a></li>
				<li><a href="#"><div class="img_wrapper"><img src="/img/torre.png" /></div>Torre</a></li>
				<li><a href="#"><div class="img_wrapper"><img src="/img/fuente.png" /></div>Fuente</a></li>
				<li><a href="#"><div class="img_wrapper"><img src="/img/cd.png" /></div>Unidades ópticas</a></li>
				<li><a href="#"><div class="img_wrapper"><img src="/img/mouse.png" /></div>Periféricos</a></li>
				<li><a href="#"><div class="img_wrapper"><img src="/img/tarjeta_adicional.png" /></div>Tarjetas adicionles</a></li>
				<li><a href="#"><div class="img_wrapper"><img src="/img/audifonos.png" /></div>Accesorios</a></li>
			</ul>
		</div>
		<a class="next browse right"></a>
		<div style="clear: both"></div>
</form>


<script type="text/javascript">
$(function() {
	// setup ul.tabs to work as tabs for each div directly under div.panes
	$("ul.tabs").tabs("div.panes > div");
	$(".scrollable").scrollable();
});
	
	
</script>