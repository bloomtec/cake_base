<div id="register_login" class="contact">
	<div class="register form">
		<fieldset class="centrar">
		<legend>
			<?php __('Contacto');?>
		</legend>
		<p>
			Déjanos tu mensaje y nos estaremos comunicando en el menor tiempo posible
		</p>
		<form id="ContactForm" accept-charset="utf-8" method="post" controller="pages" action="contacto">
			<fieldset class="contacto">
				<label for="ContactoNombre">Nombre:</label>
				<input id="ContactoNombre" type="text" required="required" class="text" name="data[Contacto][nombre]"/>
				<label for="ContactoEmail">E-mail:</label>
				<input id="ContactoEmail" type="email" required="required" class="text" name="data[Contacto][email]"/>
				<label for="ContactoTexto">Mensaje:</label>
				<textarea id="ContactoTexto" required="required" class="text" name="data[Contacto][texto]"></textarea>
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