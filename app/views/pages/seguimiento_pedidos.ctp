<p class='titulos_rosado tahoma'>
	Ingresa el número de pedido que te dimos en el momento de tu compra.
</p>
<form action="/orders/seguimiento/" class="tahoma" id='seguirPedido'>
	<label for='pedido' class='azul'>NUMERO DE PEDIDO</label>
	<input id='pedido' name='data[Order][order_number]' required="required">
	<input class="input_verde" type="submit" value="Conocer Estado" />
	<div style="clear: both"></div>
	<div class='pedido-info'>
		
	</div>
	
</form>


<p class="subtitulos_gris tahoma">NOTA: También puedes ver el número de pedido, en la confirmación que te enviamos al correo. Tu pedido demora como máximo 24 horas en 
bodega y después es despachado por la transportadora, te damos el número de guía para que revises en su página.</p>

<script type="text/javascript">
	$('#seguirPedido').validator({lang:'es'}).submit(function(e){
		if(!e.isDefaultPrevented()){
			$('.pedido-info').load('/orders/seguimiento/'+$('#pedido').val());
			e.preventDefault();
		}
	});
</script>