
<div id="register_login" class="contact">
	<div class="register form">
		<fieldset class="centrar">
		<legend>
			<?php echo __('Sugiérenos un restaurante', true); ?>
			<?php // echo __('Suggest a restaurant to us', true); ?>
		</legend>
		<p>
			<?php echo _('¿Sabes de algún restaurante que crees debería estar en Como Promos? ')?>
			<br /><br />
			<?php echo __('Nos encantaría conocerlo. Por favor completa el cuestionario para tener el gusto de contactar tu restaurante favorito y asi puedas disfrutar de todas sus promociones a domicilio por medio de nuestro sitio web.', true); ?>
		</p>
		<?php echo $this -> Form -> create('Pages', array('controller' => 'pages', 'action' => 'sugierenos')); ?>
		<!-- <form id="ContactForm" accept-charset="utf-8" method="post" controller="pages" action="contacto"> -->
			<fieldset class="contacto">
				<?php echo $this -> Form -> input('restaurant', array('label' => __('Nombre Del Restaurante:', true), 'required' => 'required')); ?>
				<!--<label for="ContactoNombre">Nombre:</label>
				<input id="ContactoNombre" type="text" required="required" class="text" name="data[Contacto][nombre]"/>-->
				<?php // echo $this -> Form -> input('email', array('label' => __('E-mail:', true), 'required' => 'required')); ?>
				<div class="input text">
					<label for="PagesRestaurantEmail"><?php __('Correo Del Restaurante:'); ?></label>
					<input id="PagesRestaurantEmail" type="email" required="required" name="data[Pages][restaurant_email]">
				</div>
				
				<?php echo $this -> Form -> input('ciudad', array('label' => __('Ciudad:', true), 'required' => 'required')); ?>
				<?php echo $this -> Form -> input('direccion', array('label' => __('Dirección:', true), 'required' => 'required')); ?>
				<div class="input text">
					<label for="PagesEmail"><?php __('Tú Correo:'); ?></label>
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
	</div>
	<div class="imagen_formularios">
		<img src="/img/Sugierenos un restaurante.jpg" width="450" />
	</div>
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