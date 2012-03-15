<!--<img src="/img/dudas.png"  class="img_contacto"/>
<h1 class="titulo_contacto">Dudas, Sugerencias o Reclamos</h1>
<p class="info">
	Déjanos tu mensaje y nos estaremos comunicando en el menor tiempo posible
</p>
<fieldset class="contacto">
	<label>Nombre:</label>
	<input type="text" required="required"  class="text"/>
	<label>E-mail:</label>
	<input type="email" required="required" class="text"/>
	<label>Mensaje:</label>
	<textarea class="text"></textarea>
	<input type="submit" class="submit" value="Enviar" />
	<div style="clear: both"></div>
</fieldset>
-->
<div id="register_login" class="contact">
	<div class="register form">
		<fieldset class="centrar">
		<legend>
			<?php __('Dudas, sugerencias o reclamos');?>
		</legend>
		<p>
			ComoPromos le da una cordial bienvenida a la página de sugerencias y reclamos, donde podrá ingresar sus opiniones en pro de mejorar nuestro servicio. 
			<br /><br />
			Por medio de nuestro correo electrónico <span>servicioalcliente@comopromos.com.</span>  o  nuestra línea telefónica  <span>057 2 664 97 34</span> estaremos dispuestos a brindarle una atención oportuna y efectiva a sus observaciones.
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