<p class='titulos_rosado tahoma'>
	Si tienes alguna duda de tu compra háznosla saber y te daremos respuesta a tu correo  lo más antes posible, 
para que sigas con la compra.
</p>
<form class="tahoma" action="/pages/enviarDuda" id='duda'>
	<label class='azul'>NOMBRE</label>
	<input type="text" required="required" name="data[name]"/>
	<label class='azul'>CORREO ELECTRONICO</label>
	<input type="email" required="required" name="data[email]" />
	<label class='azul'>DUDA</label>
	<textarea required='required' class="comentario" name='data[comentario]'> </textarea>
	<div style="clear: both"></div>
	<div class="newsletter_wrapper">
		<?php echo $form->hidden('clasification',array('name'=>'data[clasification]')); ?>
		<?php echo $form->checkbox('subscribe',array('label'=>'false','name'=>'data[subscribe]','div'=>false))?>
		<label class="subtitulos_blanco tahoma">Suscribirme al NewsLetter de Colors Tennis</label>
		<div style="clear: both"></div>
	</div>
	<input class="input_verde" type="submit" value="Enviar duda" />
	<div style="clear: both"></div>
	<div class='confirm-message' style='visibility: hidden'> tu mensaje ha sido enviado</div>
</form>
<p class="subtitulos_gris tahoma">NOTA: Te daremos respuesta dentro de las siguientes 12 horas. Si no te llega respuesta a tu bandeja de entrada, revisa en correos no deseados.
</p>
<script type="text/javascript">

	$('#duda').validator({lang:'es'}).submit(function(e){
	var form=$(this);
	var fields=$(this).serialize();
	if(!e.isDefaultPrevented()){
		jQuery.ajax({
			url : '/pages/enviarDuda',
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