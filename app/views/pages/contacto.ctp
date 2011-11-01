<div id="estaticas_info">
	<form class="tahoma" action="/pages/contacto" id='contacto'>
	<h1>Cntacto</h1>
	<div class="formulario_contacto">
		<div class="input text">
			<label>Nombre</label>
			<input type="text" name='data[name]' required='required' />
		</div>
		<div class="input text">
			<label>E-mail</label>
			<input type="email"  name='data[email]' required='required' />
		</div>
		<div class="input text">
			<label>Comentario</label>
			<textarea class="comentario" name='data[comentario]'></textarea>
		</div>
		<input type="submit" value="Enviar" class="submit"/>
		<div style='clear:both'></div>
		<div class='confirm-message' style='visibility: hidden'> tu mensaje ha sido enviado</div>
	</form>
	</div>
	
</div>
<script type="text/javascript">

	$('#contacto').validator({lang:'es'}).submit(function(e){
	var form=$(this);
	var fields=$(this).serialize();
	if(!e.isDefaultPrevented()){
		jQuery.ajax({
			url : '/pages/contacto',
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