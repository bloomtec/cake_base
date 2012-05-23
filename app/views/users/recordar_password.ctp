<div id="register_login" class="password">
	<div class="register form">
		<fieldset class="centrar">
		<legend>
			<?php __('¿Olvidaste tu contraseña?');?>
		</legend>
		<?php e($this->Form->create('User', array('controller'=>'users', 'action'=>'rememberPassword','id'=>'rememberForm'))); ?>
				<p>
					<?php __('Escribe la dirección de correo electronico con la que te registraste y recibiras en tu correo una clave para ingresar a tu cuenta.'); ?>
				</p>
				<label class="correo"><?php __('CORREO ELECTRÓNICO REGISTRADO'); ?></label>
				<input type="email" id="UserEmail" name="data[User][email]"  required="required" />
				<div style="clear: both"></div>
				<!--<a class="azul ingresar" href="#">Ingresar</a>-->
				<div class="submit">
					<input type="submit" value="Solicitar" />
				</div>
				<div style="clear: both"></div>
				<div class='confirmacion-remember'>
					<?php __('Se ha enviado un nuevo password a tu correo electronico'); ?>
				</div>
		<?php e($form->end()) ?>
		</fieldset>
	</div>
	<div style="clear: both"></div>
</div>
<script type="text/javascript">
	$('#rememberForm').validator({lang:'es'}).submit(function(e){
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