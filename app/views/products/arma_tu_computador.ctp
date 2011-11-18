<?php 
	echo $html -> script('pc.js');
?>
<div class='pc-error' style='display:none; position:fixed; top:0; height:100px; background: orange; color: white; width:100%; left:0;'></div>
<?php $form->create('PC',array('action'=>'armaTuPC'));?>

	
	<div class="panes">
		<div>
			<div class='content'>
				<h1>Procesador</h1>
				<p>
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
				</p>
				<div class="seleccionar">
					<label>Elije la marca de tu procesador</label>
					<?php echo $form->input('architecture_id',array('id'=>'architecture','options'=>$arquitectures,'label'=>'Arquitectura'));?>
				</div>
				
				<div style="clear: both;margin-bottom: 10px"></div>
				<h2>Seleccione su procesador</h2>
				<div class='radios processors'>
					<!--Espacio donde se  llenan los radios de los procesadores-->	
				</div>
				<h2>Seleccione su tarjeta madre</h2>
				<div class='radios boards'>
					<!-- Espacio donde se llenan los radios de las boards-->
				</div>
			</div>
			<div class='browse'>
				<a href="#" class="siguiente_paso">Siguiente paso</a>
			</div>
		</div>
		
		<div>
			<div class='content'>
				<h1>Memoria RAM</h1>
				<p>
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
				</p>
				
				<div style="clear: both;margin-bottom: 10px"></div>
				<label>Seleccione: </label>
				<div class='radios ram-cards'>
					<!--Espacio donde se  llenan los radios de los procesadores-->	
				</div>
				
			</div>
			<div class='browse'>
				<a href="#" class="paso_anterior">  Atras </a>
				<a href="#" class="siguiente_paso"> Siguiente paso </a>
			</div>
		</div>
		
		<div>
			<div class='content'>
				<h1>Discos Duros</h1>
				<p>
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
				</p>
				
				<div style="clear: both;margin-bottom: 10px"></div>
				<label>Seleccione:</label>
				<div class='radios hard-drives'>
					<!--Espacio donde se  llenan los radios de los procesadores-->	
				</div>
				
			</div>
			<div class='browse'>
				<a href="#" class="paso_anterior">  Atras </a>
				<a href="#" class="siguiente_paso"> Siguiente paso </a>
			</div>
		</div>
		
		<div>
			<div class='content'>
				<h1>Tarjeta de video</h1>
				<p>
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
				</p>
				
				<div style="clear: both;margin-bottom: 10px"></div>
				<label>Seleccione: </label>
				<div class='radios video-cards'>
					<!--Espacio donde se  llenan los radios de los procesadores-->	
				</div>
				
			</div>
			<div class='browse'>
				<a href="#" class="paso_anterior">  Atras </a>
				<a href="#" class="siguiente_paso"> Siguiente paso </a>
			</div>
		</div>
		
		<div>
			<div class='content'>
				<h1>Torres</h1>
				<p>
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
				</p>
				
				<div style="clear: both;margin-bottom: 10px"></div>
				<label>Seleccione: </label>
				<div class='radios case'>
					<!--Espacio donde se  llenan los radios de los procesadores-->	
				</div>
				
			</div>
			<div class='browse'>
				<a href="#" class="paso_anterior">  Atras </a>
				<a href="#" class="siguiente_paso"> Siguiente paso </a>
			</div>
		</div>

		<div>
			<div class='content'>
				<h1>Fuentes</h1>
				<p>
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
				</p>
				
				<div style="clear: both;margin-bottom: 10px"></div>
				<label>Seleccione:</label>
				<div class='radios supplys'>
					<!--Espacio donde se  llenan los radios de los procesadores-->	
				</div>
				
			</div>
			<div class='browse'>
				<a href="#" class="paso_anterior">  Atras </a>
				<a href="#" class="siguiente_paso"> Siguiente paso </a>
			</div>
		</div>
		
		<div>
			<div class='content'>
				<h1>Unidades Opticas</h1>
				<p>
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
				</p>
				
				<div style="clear: both;margin-bottom: 10px"></div>
				<label>Seleccione:</label>
				<div class='radios optical-drives'>
					<!--Espacio donde se  llenan los radios de los procesadores-->	
				</div>
				
			</div>
			<div class='browse'>
				<a href="#" class="paso_anterior">  Atras </a>
				<a href="#" class="siguiente_paso"> Siguiente paso </a>
			</div>
		</div>
		
		<div>
			<div class='content'>
				<h1>Monitor</h1>
				<p>
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
				</p>
				
				<div style="clear: both;margin-bottom: 10px"></div>
				<label>Seleccione:</label>
				<div class='radios monitors'>
					<!--Espacio donde se  llenan los radios de los procesadores-->	
				</div>
				
			</div>
			<div class='browse'>
				<a href="#" class="paso_anterior">  Atras </a>
				<a href="#" class="siguiente_paso"> Siguiente paso </a>
			</div>
		</div>
		
		<div>
			<div class='content'>
				<h1>Periféricos</h1>
				<p>
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
				</p>
				
				<div style="clear: both;margin-bottom: 10px"></div>
				<label>Seleccione:</label>
				<div class='radios peripherals'>
					<!--Espacio donde se  llenan los radios de los procesadores-->	
				</div>
				
			</div>
			<div class='browse'>
				<a href="#" class="paso_anterior">  Atras </a>
				<a href="#" class="siguiente_paso"> Siguiente paso </a>
			</div>
		</div>
		<div>
			<div class='content'>
				<h1>Tarjetas Adicionales</h1>
				<p>
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
				</p>
				
				<div style="clear: both;margin-bottom: 10px"></div>
				<label>Seleccione:</label>
				<div class='radios other-cards'>
					<!--Espacio donde se  llenan los radios de los procesadores-->	
				</div>
				
			</div>
			<div class='browse'>
				<a href="#" class="paso_anterior">  Atras </a>
				<a href="#" class="siguiente_paso"> Siguiente paso </a>
			</div>
		</div>
		<div>
		<div class='content'>
				<h1>Accesorios</h1>
				<p>
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
				</p>
				
				<div style="clear: both;margin-bottom: 10px"></div>
				<label>Seleccione: </label>
				<div class='radios accesories'>
					<!--Espacio donde se  llenan los radios de los procesadores-->	
				</div>
				
			</div>
			<div class='browse'>
				<a href="#" class="paso_anterior">  Atras </a>
			</div>
		</div>
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
				<li><a href="#" id='processor'><div class="img_wrapper"><img src="/img/procesador.png" /></div>Procesadores y tarjetas madre</a></li>
				<li><a href="#" id='ram'><div class="img_wrapper"><img src="/img/ram.png" /></div>Memorias Ram</a></li>
				<li><a href="#" id='hard-drive'><div class="img_wrapper"><img src="/img/disco_duro.png" /></div>Discos duros</a></li>
				<li><a href="#" id='video-card'><div class="img_wrapper"><img src="/img/tarjeta_video.png" /></div>Tarjetas de video</a></li>
				<li><a href="#" id='case'><div class="img_wrapper"><img src="/img/torre.png" /></div>Torres</a></li>
				<li><a href="#" id='supply'><div class="img_wrapper"><img src="/img/fuente.png" /></div>Fuentes</a></li>
				<li><a href="#" id='optical-drive'><div class="img_wrapper"><img src="/img/cd.png" /></div>Unidades ópticas</a></li>
				<li><a href="#" id='monitor'><div class="img_wrapper"><img src="/img/monitor.png" /></div>Monitores</a></li>
				<li><a href="#" id='peripherals'><div class="img_wrapper"><img src="/img/mouse.png" /></div>Periféricos</a></li>
				<li><a href="#" id='other-cards'><div class="img_wrapper"><img src="/img/tarjeta_adicional.png" /></div>Tarjetas adicionles</a></li>
				<li><a href="#" id='accesoriess'><div class="img_wrapper"><img src="/img/audifonos.png" /></div>Accesorios</a></li>
			</ul>
		</div>
		<a class="next browse right"></a>
		<div style="clear: both"></div>
</form>