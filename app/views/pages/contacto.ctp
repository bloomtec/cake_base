<img src="/img/contacto.png"  class="img_contacto"/>
<h1 class="titulo_contacto">Contácto</h1>
<p class="info">
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
		<input type="submit" class="submit" value="Enviar" />
		<div style="clear: both"></div>
	</fieldset>
</form>