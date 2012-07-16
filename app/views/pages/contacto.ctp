<div id="estaticas_info">
	<form class="tahoma" action="/pages/contacto" id='contacto'>
	<h1>Contácto</h1>
	<p>
		Excelenter quiere prestarle el mejor servicio. Por favor, llene los campos que presentamos y en poco tiempo un asesor se pondrá en contacto con usted para solucionar sus consultas, quejas o inquietudes.
	</p>
	<div class="formulario_contacto">
		<div class="input text">
			<label for="UserName">Nombre:</label>
			<input type="text" name='data[name]' required='required' class="data" id='UserName'/>
		</div>
		<div class="input text">
			<label for="UserEmail">E-mail:</label>
			<input id='UserEmail' type="email"  name='data[email]' required='required' />
		</div>
		<div class="input text textarea">
			<label for="Comment">Comentario:</label>
			<textarea class="comentario" name='data[comentario]' id="Comment"></textarea>
			<div style="clear: both"></div>
		</div>
		<div style="clear: both"></div>
		<input type="submit" value="Enviar" class="submit"/>
		<div style='clear:both'></div>
		<div class='confirm-message' style='visibility: hidden'> tu mensaje ha sido enviado</div>
	</form>
	</div>
	
</div>
<!--
<div class="contact_data">
	<h1>Centro comercial la pasarela Local 225 </h1>
	<h2>AV 5AN Nº 23DN-68</h2>
	<h2>Cali - Colombia</h2>
	<h2>Telefono: 660 50 79 </h2>
	<h2>Telefax   : 667 71 16</h2>
</div>
<div class="contact_data">
	<h1>Centro comercial PRYCA </h1>
	<h2>CL 13 Nº 31-45.  Local 27</h2>
	<h2>Cali - Colombia. </h2>
	<h2>Telefono: 524 33 63</h2>
</div>
<div class="contact_data">
	<h1>Horario de Atención</h1>
	<h2>Lunes a Sábados</h2>
	<h2>8:00 AM a 1:00 PM</h2>
	<h2>2:00 PM a 6:00 PM</h2>
</div>
<div style="clear: both"></div>
-->
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