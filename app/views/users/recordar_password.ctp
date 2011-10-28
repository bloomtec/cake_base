<?php e($this->Form->create('User', array('controller'=>'users', 'action'=>'rememberPassword','id'=>'rememberForm'))); ?>
		
		<label>CORREO ELECTRÓNICO REGISTRADO</label>
		<input id="UserEmail" name="data[User][email]" type="email" required="required" />
		<div style="clear: both"></div>
		<!--<a class="azul ingresar" href="#">Ingresar</a>-->
		<input type="submit" class='twCenMt' value="Solicitar" />
		<div style="clear: both"></div>
		<div class='confirmacion-remember'>
			Se ha enviado un nuevo password a tu correo electronico
		</div>
<?php e($form->end()) ?>