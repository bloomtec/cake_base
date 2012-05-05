<div class='content'>
	<h1>Procesador</h1>
	<p>
		Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
	</p>
	<div class="seleccionar">
		<h2>Elije la Arquitectura</h2>
		<?php echo $form -> input('architecture_id', array('id' => 'architecture', 'options' => $arquitectures, 'label' => false));?>
	</div>
	<div style="clear: both;"></div>
	<div class="col">
		<h2>Seleccione su procesador</h2>
		<div class='radios processors'></div>
	</div>
	<div class="col">
		<h2>Seleccione su tarjeta madre</h2>
		<div class='radios board-cards'>
			<!-- Espacio donde se llenan los radios de las boards-->
		</div>
	</div>
	<div style="clear: both;"></div>
</div>
</div>