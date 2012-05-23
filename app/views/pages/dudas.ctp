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
			<?php echo __('Dudas, sugerencias o reclamos'); ?>
			<?php // echo __('Doubts, suggestions or complaints'); ?>
		</legend>
		<p style="width: 100%;">
			<?php echo __('ComoPromos le da una cordial bienvenida a la página de sugerencias y reclamos, donde podrá ingresar sus opiniones en pro de mejorar nuestro servicio.', true); ?>
			<?php // echo __('ComoPromos gives you a warm welcome to our suggestions and complaints page. Here you can give us input about your opinions regarding us giving you a better service', true); ?> 
			<br /><br />
			<?php echo __('Por medio de nuestro correo electrónico <span> servicioalcliente@comopromos.com.</span>  o  nuestra línea telefónica  <span>057 2 664 97 34</span> estaremos dispuestos a brindarle una atención oportuna y efectiva a sus observaciones.', true); ?>
			<?php // echo __('Through our email <span>servicioalcliente@comopromos.com</span> or our phone line <span>057 2 664 97 34</span> we are willing to provide fast and effective attention to your observations.', true); ?>
		</p>
		<?php echo $this -> Form -> create('Pages', array('controller' => 'pages', 'action' => 'dudas')); ?>
		<!-- <form id="ContactForm" accept-charset="utf-8" method="post" controller="pages" action="contacto"> -->
			<fieldset class="contacto">
				<?php echo $this -> Form -> input('name', array('label' => __('Nombre:', true), 'required' => 'required')); ?>
				<!--<label for="ContactoNombre">Nombre:</label>
				<input id="ContactoNombre" type="text" required="required" class="text" name="data[Contacto][nombre]"/>-->
				<?php // echo $this -> Form -> input('email', array('label' => __('E-mail:', true), 'required' => 'required')); ?>
				<div class="input text">
					<label for="PagesEmail"><?php __('Correo:'); ?></label>
					<input id="PagesEmail" type="email" required="required" name="data[Pages][email]">
				</div>
				<!--<label for="ContactoEmail">E-mail:</label>
				<input id="ContactoEmail" type="email" required="required" class="text" name="data[Contacto][email]"/>-->
				<?php echo $this -> Form -> input('message', array('label' => __('Mensaje:', true), 'type' => 'textarea', 'required' => 'required')); ?>
				<!--<label for="ContactoTexto">Mensaje:</label>
				<textarea id="ContactoTexto" required="required" class="text" name="data[Contacto][texto]"></textarea>-->
				<?php echo $this -> Form -> submit(__('Enviar', true)); ?>
				<!--<div class="submit">
					<input type="submit" value="Enviar" />
				</div>-->
				<div style="clear: both"></div>
			</fieldset>
		<?php echo $this -> Form -> end(); ?>
		<!--</form>-->
		</fieldset>
	</div>
	<div class="imagen_formularios">
		<img src="/img/Sugerencias y reclamos.jpg" width="455"/>
	</div>
</div>