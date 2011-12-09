<div class="login form">
	<?php
	echo $this -> Form -> create('User', array('action' => 'login'));
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
		
	</fieldset>
	<div class="btn_wrraper">			
		<?php
		echo $this -> Form -> end(__('Ingresar', true));
		?>
		<a class="submit primero" href='/users/register'> Registrese </a>
	</div>
	<?php
		echo $this -> Session -> flash('auth');
		?>
</div>
