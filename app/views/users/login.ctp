<div class="login form2 users">
	<?php
	echo $this -> Form -> create('User', array('controller' => 'users', 'action' => 'login'));
	?>
	<fieldset>
		<legend>
			<?php __('Ingresar');?>
		</legend>
		<div class="input text">
			<label for='email'>E-mail:</label>
			<input type="email"  id='email' name='data[User][email]' required="required" />
		</div>
		<div class="input text">
			<label for='password'>Password:</label>
			<input type="password" id='password'  name='data[User][password]' required="required" />
		</div>
		<div style="clear: both"></div>
		<?php
		echo $this -> Form -> end(__('Login', true));
		?>
		<a class="boton" href='/users/register'> Registrese </a>
		
	</fieldset>
	<?php
		echo $this -> Session -> flash('auth');
		?>
		
</div>
<div style="clear: both"></div>