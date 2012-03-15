
<div id="register_login" class="contact">
	<div class="register form">
		<fieldset class="centrar">
		<legend>
				<?php __('Sugiérenos un restaurante');?>
		</legend>
		<p>
				¿Sabes de algún restaurante que crees debería estar en ComoPromos? Nos encantaría conocerlo. Por favor completa el cuestionario que encontrarás más abajo y podremos ofrecerte nuestros servicios.
			</p>
		<form id="SugiereForm" accept-charset="utf-8" method="post" controller="pages" action="sugiere">
			<fieldset class="contacto">
				<label for="ContactoNombre">Nombre del restaurante :</label>
				<input id="ContactoNombre" type="text" required="required" class="text" name="data[Form][nombre]"/>
				<label for="ContactoEmail">E-mail:</label>
				<input id="ContactoEmail" type="text" required="required" class="text" name="data[Form][ciudad]"/>
				
				<label for="ContactoEmail">Tu e-mail:</label>
				<input id="ContactoEmail" type="email" required="required" class="text" name="data[Form][email]"/>
				<label for="ContactoTexto">Comentarios:</label>
				<textarea id="ContactoTexto" required="required" class="text" name="data[Form][texto]"></textarea>
				<div class="submit">
					<input type="submit" value="Enviar" />
				</div>
				<div style="clear: both"></div>
			</fieldset>
		</form>
		
		</fieldset>
		
	</div>
	<div style="clear: both"></div>
</div>
<script type="text/javascript">
	$('#SugiereForm').validator({lang:'es', position:"bottom left"}).submit(function(e){
		var form=$(this);
		var fields=$(this).serialize();
		if(!e.isDefaultPrevented()){
			BJS.post('/users/rememberPassword',fields,function(response){
				if(response){
					$('.confirmacion-remember').show();
				}else{
					$('.confirmacion-remember').html('no se pudo realizar tu solicitud verifica tu email').show();
				}
			})
			e.preventDefault();
		}
	});
</script>