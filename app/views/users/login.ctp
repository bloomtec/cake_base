<div class="login form">
	<?php
	echo $this -> Form -> create('User', array('controller' => 'users', 'action' => 'login'));
	?>
	<fieldset class="centrar">
		<label for='email'>email:</label>
		<input type="email" class="input" id='email' name='data[User][email]' required="required" />
		<label for='password'>Password:</label>
		<input type="password" id='password' class="input" name='data[User][password]' required="required" />
		<?php
		echo $this -> Session -> flash('auth');
		echo $this -> Form -> end(__('Ingresar', true));
		?>
		<a class="submit primero" href='/users/register'> Registrese </a>
	</fieldset>
</div>