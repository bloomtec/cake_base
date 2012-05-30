<div class="deals">
	<img src="/img/uploads/<?php echo $prize ['Prize']['image'] ?>" />
	<h1><?php echo $prize ['Prize']['name'] ?></h1>
	<div class="info_producto">
		<p>
			<?php echo $prize ['Prize']['description']?>
		</p>
		<h3>Para redimir este premio necesitas</h2>
		<h4><?php echo $prize ['Prize']['score'] ?> puntos</h3>
		<p class='terminos-premios'>
			Acepto los <a  target="_blank" href="/pages/terminosPremios">TÉRMINOS Y CONDICIONES</a> de los premios 
			<input type="checkbox" id='aceptarTerminos'/>
		</p>
		<a class="comprar redimir"  style='float:left; width:150px; margin-left:0; clear:none;' href="/prizes/redeem/<?php echo $prize ['Prize']['id'] ?>"></a>
	</div>
	<h1 class="premios otros">Otros Premios</h1>
	<a href="/prizes/" class="volver_premios">Volver a los premios</a>
	<div style="clear: both"></div>
	<!-- "previous page" action -->
	<a class="prev browse left"></a>	
	<!-- root element for scrollable -->
	<div class="scrollable">      
	   <!-- root element for the items -->   
	   <div class="items">  
	      <!-- 1-5 -->
	      <div>
	      	<?php foreach($prizes as $premio): ?>
	         <div class="otros_premios">
	         	<a href="/prizes/view/<?php echo $premio ['Prize']['id'] ?>">
	         		<img src="/img/uploads/<?php echo $premio ['Prize']['image'] ?>" />
	         	</a>
	         	<a href="#" class="descripcion_premios">
	         		<?php echo $premio['Prize']['name'] ?>
	         	</a>
	         	<h2>
	         		<?php echo $premio ['Prize']['score'] ?> puntos
	         	</h2>
	         	
	         </div>
	         <?php	endforeach; ?>
	       
	      </div>
	      
	      <!-- 5-10 -->
	      <div>
	         
	      </div>
	      
	      <!-- 10-15 -->
	      <div>
	      
	      </div>
	      
	   </div>
   <div style="clear: both"></div>
</div>

<!-- "next page" action -->
<a class="next browse right"></a>

</div>
<script>
// execute your scripts when the DOM is ready. this is mostly a good habit
$(function() {
	$('.redimir').click(function(e){
		if(!$('#aceptarTerminos').is(':checked')){
			e.preventDefault()
			alert('Debe aceptar los TÉRMINOS Y CONDICIONES DE LOS CUPONES DE DESCUENTO COMOPROMOS para redimir tu premio');
		}
	});
	// initialize scrollable
	$(".scrollable").scrollable();

});
</script>

