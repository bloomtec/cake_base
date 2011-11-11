<div class="login form">
	<?php
	echo $this -> Form -> create('User', array('controller' => 'users', 'action' => 'login'));
	?>
	<fieldset class="centrar">
		<legend>
			<?php __('Ingresar');?>
		</legend>
		<div class="input text">
			<label for='email'>E-mail:</label>
			<input type="email" class="input" id='email' name='data[User][email]' required="required" />
		</div>
		<div class="input text">
			<label for='password'>Password:</label>
			<input type="password" id='password' class="input" name='data[User][password]' required="required" />
		</div>
		
		<a class="submit primero" href='/users/register'> Registrese </a>
		<?php
		echo $this -> Form -> end(__('Ingresar', true));
		?>
		
	</fieldset>
	<?php
		echo $this -> Session -> flash('auth');
		?>
</div>
