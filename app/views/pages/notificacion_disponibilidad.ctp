<p class='titulos_rosado tahoma'>
	Sólo tienes que introducir tu dirección de correo electrónico abajo y nosotros te haremos saber cuándo la
combinación que buscas esté disponible!
</p>
<form class="tahoma" id='disponibilidad'>
	<label for='pedido' class='azul'>CORREO ELECTRONICO</label>
	<input type="email" required="required" name='data[email]' />
<h1 class="subtitulos_gris">MARCA:</h1> <h2 class="subtitulos_blanco"> <?php echo $product['Brand']['name']; ?> </h2>
<h1 class="subtitulos_gris">NOMBRE PRENDA:</h1> <h2 class="subtitulos_blanco"><?php echo $product['Product']['name']; ?> </h2>
<h1 class="subtitulos_gris">CLASIFICACION:</h1><h2 class="subtitulos_blanco"><?php echo $product['Product']['clasification']; ?></h2>
<h1 class="subtitulos_gris">TALLA:</h1> <input type='text' name='data[talla]' required="required" />
	<div class="newsletter_wrapper">
		<?php echo $form->checkbox('subscribe',array('label'=>'false','name'=>'data[subscribe]','div'=>false))?>
		<label class="subtitulos_blanco tahoma">Suscribirme al NewsLetter de Colors Tennis</label>
		<div style="clear: both"></div>
	</div>
	<div style="clear: both"></div>
	<?php 
		echo $form->hidden('brand',array('value'=>$product['Brand']['name']));
		echo $form->hidden('clasification',array('value'=>$product['Product']['clasification']));
		//echo $form->hidden('brand',array('value'=>$product['Brand']['name']));
	?>
	<input class="input_verde tahoma" type="submit" value="Notificar" />
	<div class='confirm-message' style="visibility: hidden"> solicitud enviada</div>
</form>
<p class="subtitulos_gris tahoma">NOTA: Algunos tamaños pueden no estar disponibles ya desde el fabricante. Sin embargo, haremos todo lo posible para reponer su tamaño y te notificaremos si este 
producto entra en nuestra tienda</p>

<script type="text/javascript">
	$('#disponibilidad').validator({lang:'es'}).submit(function(e){
	var form=$(this);
	var fields=$(this).serialize();
	if(!e.isDefaultPrevented()){
		jQuery.ajax({
			url : '/pages/enviarDisponibilidad',
			type : "POST",
			cache : false,
	
			data : fields,
			success : function(sendMessage){
				if(sendMessage==1){
					$('.confirm-message').css('visibility','visible');
					$('input[type=text]').val("");
					$('input[type=email]').val("");
					$('textarea').val("");
				}else{
					//form.data("validator").invalidate(validate);
					alert('no se pudo enviar el mensaje');
				}
			}
		});	
		e.preventDefault();
	}
});

	Cufon.replace('.tahoma', {
		fontFamily : 'Tahoma',
		trim : "simple",
		hoverables:{a:true},
		hover:{color:'#ffaedc'}

	});
	Cufon.replace('.japan', {
		fontFamily : 'Japan',
		trim : "simple"
	});

	Cufon.replace('.twCenMt', {
		fontFamily : 'TwCenMt',
		trim : "simple",
		hoverables:{a:true},
		hover:{color:'#00CFB5'}
	});
	
	Cufon.replace('.halo', {
		fontFamily : 'HaloHandLetter',
		trim : "simple"
	});	
	

</script>