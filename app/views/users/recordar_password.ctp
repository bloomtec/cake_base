<div class="login form2 users">
	<?php e($this->Form->create('User', array('controller'=>'users', 'action'=>'rememberPassword','id'=>'rememberForm'))); ?>
		<p>
			Escribe la dirección de correo electronico con la que te registraste y recibiras en tu correo una clave para ingresar a tu cuenta.
		</p>
		<label class="correo">CORREO ELECTRÓNICO REGISTRADO</label>
		<input type="email" id="UserEmail" name="data[User][email]"  required="required" />
		<div style="clear: both"></div>
		<!--<a class="azul ingresar" href="#">Ingresar</a>-->
		<?php echo $this->Form->submit(__("change",true)) ?>
		<div class='confirmacion-remember'>
			Se ha enviado un nuevo password a tu correo electronico
		</div>
		<div style="clear: both"></div>
	<?php e($form->end()) ?>
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