<div class="reset-password form">
	<?php
		echo $this -> Form -> create('User', array('controller' => 'users', 'action' => 'resetPassword'));
	?>
	<fieldset class="centrar">
		<legend>
			<?php __('Pedir nueva contraseña', true);?>
		</legend>
		<p>
			<?php __('Ingrese su correo para solicitar una contraseña nueva.', true);?>
		</p>
		<div class="input text">
			<label for='email'>E-mail:</label>
			<input type="email" class="input" id='email' name='data[User][email]' required="required" />
		</div>
		<?php
		echo $this -> Form -> end(__('Solicitar nueva contraseña', true));
		?>
	</fieldset>
	<?php
		echo $this -> Session -> flash();
	?>
</div>
