<div id="estaticas_info">
	<form class="tahoma" action="/pages/contacto" id='contacto'>
	<h1 class="titulos_rosado twCenMt">CONTACTO</h1>
	<span class="puntos"></span>
	<div class="formulario_contacto twCenMt">
		<h2 class="titulos_rosado">NOMBRE</h2>
		<input type="text" name='name' required='required' />
		<h2 class="titulos_rosado">CORREO ELECTRONICO</h2>
		<input type="email"  name='email' required='required' />
		<h2 class="titulos_rosado">COMENTARIO</h2>
		<textarea class="comentario" name='comentario'></textarea>
		<input type="submit" value="Enviar" class="twCenMt" />
		<div style='clear:both'></div>
		<div class='confirm-message' style='visibility: hidden'> tu mensaje ha sido enviado</div>
	</form>
	</div>
	
</div>
<div id="foto_estaticas"><img src="/img/foto_estaticas.jpg" /></div>
<script type="text/javascript">

	$('#contacto').validator({lang:'es'}).submit(function(e){
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
</script>