<?php
echo $html -> script('pc.js');
echo $html -> script('tab-pc.js');
?>
<div class='pc-error' style='display:none; position:fixed; top:0; left:0;'></div>
<?php $form -> create('PC', array('action' => 'armaTuPC'));?>
<div id="aplicacion">
<div class="panes">
	<div>
		<div class='content'>
			<h1>Procesador</h1>
			<p>
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
			</p>
			<div class="seleccionar">
				<label>Elije la marca de tu procesador</label>
				<?php echo $form -> input('architecture_id', array('id' => 'architecture', 'options' => $arquitectures, 'label' => 'Arquitectura'));?>
			</div>
			<div style="clear: both;"></div>
			<h2>Seleccione su procesador</h2>
			<div class='radios processors'>
				
			</div>
			<h2>Seleccione su tarjeta madre</h2>
			<div class='radios board-cards'>
				<!-- Espacio donde se llenan los radios de las boards-->
			</div>
		</div>
	</div>
	<div>
		<div class='content'>
			<h1>Memoria RAM</h1>
			<p>
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
			</p>
			<div style="clear: both;"></div>
			<label>Seleccione: </label>
			<div class='radios ram-cards'>
				
			</div>
		</div>
		
	</div>
	<div>
		<div class='content'>
			<h1>Discos Duros</h1>
			<p>
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
			</p>
			<div style="clear: both;"></div>
			<label>Seleccione:</label>
			<div class='radios hard-drives'>
				
			</div>
		</div>

	</div>
	<div>
		<div class='content'>
			<h1>Tarjeta de video</h1>
			<p>
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
			</p>
			<div style="clear: both;"></div>
			<label>Seleccione: </label>
			<div class='radios video-cards'>
				
			</div>
		</div>

	</div>
	<div>
		<div class='content'>
			<h1>Torres</h1>
			<p>
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
			</p>
			<div style="clear: both;"></div>
			<label>Seleccione su torre: </label>
			<div class='radios cases'>
				
			</div>
			<label>Seleccione su fuente:</label>
			<div class='radios supplies'>
				
			</div>
		</div>

	</div>
	<!-- OPCIONALES-->
	<div>
		<div class='content'>
			<h1>Unidades Opticas</h1>
			<p>
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
			</p>
			<div style="clear: both;"></div>
			<label>Seleccione:</label>
			<div class='radios optical-drives'>
				
			</div>
		</div>

	</div>
	<div>
		<div class='content'>
			<h1>Monitor</h1>
			<p>
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
			</p>
			<div style="clear: both;"></div>
			<label>Seleccione:</label>
			<div class='radios monitors'>
				
			</div>
		</div>

	</div>
	<div>
		<div class='content'>
			<h1>Periféricos</h1>
			<p>
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
			</p>
			<div style="clear: both;"></div>
			
			<div class='radios key-boards'>
				
			</div>
			
			<div class='radios mice'>
				
			</div>
			
		</div>

	</div>
	<div>
		<div class='content'>
			<h1>Tarjetas Adicionales</h1>
			<p>
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
			</p>
			<div style="clear: both;"></div>
			
			<div class='radios sound-cards'>
				
			</div>
			<div class='radios tv-cards'>
				
			</div>
			
		</div>
	</div>

</div>
<div id="resumen">
	
</div>

<div class='browse'  style='clear:both;'>
	<div class="wrapper_browse">
		<a href="#" class="paso_anterior">
			<ul>
				<li>Paso Anterior</li>
			</ul>	
		</a>
		<a href="#" class="siguiente_paso">
			<ul>
				<li>Paso Siguiente</li>
			</ul>
		</a>
		<!--<a href="#" class='pagar'>
			<ul>
				<li>Pagar</li>
			</ul>
		</a>-->
		<div style="clear: both"></div>
	</div>
</div>

<div class="scrollable">
	<ul class='tabs items'>
		<div>
			<li>
				<a href="#processor" id='processor'>
				<div class="img_wrapper"><img src="/img/procesador.png" />
				</div>Procesadores y tarjetas madre</a>
			</li>
			<li>
				<a href="#ram-cards" id='ram-cards'>
				<div class="img_wrapper"><img src="/img/ram.png" />
				</div>Memorias Ram</a>
			</li>
			<li>
				<a href="#hard-drive" id='hard-drive'>
				<div class="img_wrapper"><img src="/img/disco_duro.png" />
				</div>Discos duros</a>
			</li>
			<li>
				<a href="#video-card" id='video-card'>
				<div class="img_wrapper"><img src="/img/tarjeta_video.png" />
				</div>Tarjetas de video</a>
			</li>
			<li>
				<a href="#case" id='case'>
				<div class="img_wrapper"><img src="/img/torre.png" />
				</div>Torres</a>
			</li>
		</div>
		<!-- OPCIONALES-->
		<div>
			<li>
				<a href="#optical-drive" id='optical-drive'>
				<div class="img_wrapper"><img src="/img/cd.png" />
				</div>Unidades ópticas</a>
			</li>
			<li>
				<a href="#monitor" id='monitor'>
				<div class="img_wrapper"><img src="/img/monitor.png" />
				</div>Monitores</a>
			</li>
			<li>
				<a href="#peripherals" id='peripherals'>
				<div class="img_wrapper"><img src="/img/mouse.png" />
				</div>Teclado y Mouse</a>
			</li>
			<li>
				<a href="#other-cards" id='other-cards'>
				<div class="img_wrapper"><img src="/img/tarjeta_adicional.png" />
				</div>Tarjetas adicionles</a>
			</li>
		</div>
	</ul>
</div>
<div style="clear: both"></div>
</div>
</form>