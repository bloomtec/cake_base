<div id="register_login" class="contact">
	<div class="register form">
		<fieldset class="centrar">
		<legend>
			<?php echo __('Contact', true); ?>
		</legend>
		<p>
			<!--Déjanos tu mensaje y nos estaremos comunicando en el menor tiempo posible-->
			<?php echo __('Leave us a message and we will be contacting you as soon as possible', true); ?>
		</p>
		<?php echo $this -> Form -> create('Pages', array('controller' => 'pages', 'action' => 'contacto')); ?>
		<!-- <form id="ContactForm" accept-charset="utf-8" method="post" controller="pages" action="contacto"> -->
			<fieldset class="contacto">
				<?php echo $this -> Form -> input('name', array('label' => __('Name:', true), 'required' => 'required')); ?>
				<!--<label for="ContactoNombre">Nombre:</label>
				<input id="ContactoNombre" type="text" required="required" class="text" name="data[Contacto][nombre]"/>-->
				<?php // echo $this -> Form -> input('email', array('label' => __('E-mail:', true), 'required' => 'required')); ?>
				<div class="input text">
					<label for="PagesEmail">E-mail:</label>
					<input id="PagesEmail" type="email" required="required" name="data[Pages][email]">
				</div>
				<!--<label for="ContactoEmail">E-mail:</label>
				<input id="ContactoEmail" type="email" required="required" class="text" name="data[Contacto][email]"/>-->
				<?php echo $this -> Form -> input('message', array('label' => __('Message:', true), 'type' => 'textarea', 'required' => 'required')); ?>
				<!--<label for="ContactoTexto">Mensaje:</label>
				<textarea id="ContactoTexto" required="required" class="text" name="data[Contacto][texto]"></textarea>-->
				<?php echo $this -> Form -> submit(__('Send', true)); ?>
				<!--<div class="submit">
					<input type="submit" value="Enviar" />
				</div>-->
				<div style="clear: both"></div>
			</fieldset>
		<?php echo $this -> Form -> end(); ?>
		<!--</form>-->
		<h1>DOMISALECOMOPROMOS</h1>
		<p>
			<br />
			<br />
			Teléfono: +57 2 664 97 34
			<br />
			<br />
			E-mail: info@domisalecomopromos.com
			<br /><br />
			<!--Si quieres trabajar con nosotros-->
			<?php echo __('If you want to work with us', true); ?>
			<br />
			E-mail: jobs@domisalecomopromos.com
		</p>
		</fieldset>
		
	</div>
	<div style="clear: both"></div>
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