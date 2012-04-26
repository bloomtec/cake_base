<div id="register_login" class="contact">
	<div class="register form">
		<fieldset class="centrar">
		<legend>
			<?php echo __('Contactanos', true); ?>
		</legend>
		<p>
			<?php echo __('Déjanos tu mensaje y nos estaremos comunicando en el menor tiempo posible', true); ?>
			<?php // echo __('Leave us a message and we will be contacting you as soon as possible', true); ?>
		</p>
		<?php echo $this -> Form -> create('Pages', array('controller' => 'pages', 'action' => 'contacto')); ?>
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
		<h1 style="color:black;">COMOPROMOS</h1>
		<p style="text-align:left;margin-bottom: 0">
			<br />
			<?php __('Teléfono:'); ?> <a href="tel:+57 2 664 97 34">+57 2 664 97 34</a>
			<br />
			<?php __('Correo:'); ?> <a href="mailto:info@comopromos.com">info@comopromos.com</a>
			<br /><br />
			<!--Si quieres trabajar con nosotros-->
			<?php echo __('¿Te gustaría trabajar con nosotros? Contactanos:', true); ?><a href="mailto:jobs@comopromos.com">jobs@comopromos.com</a>
			<br />
		</p>
		</fieldset>
		
	</div>

	<div class="imagen_formularios">
		<img src="/img/Contactenos.jpg" />
	</div>
</div>
<script type="text/javascript">
	$('#ContactForm').validator({lang:'es', position:"bottom left"}).submit(function(e){
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