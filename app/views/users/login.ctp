<div class="login form">
	<?php
	echo $this -> Form -> create('User', array('controller' => 'users', 'action' => 'login'));
	?>
	<fieldset class="centrar">
		<legend>
			<?php __('Ingresar');?>
		</legend>
		<p>
		Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
		Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.
		</p>
		<div class="input text">
			<label for='email'>E-mail:</label>
			<input type="email" class="input" id='email' name='data[User][email]' required="required" />
		</div>
		<div class="input text">
			<label for='password'>Password:</label>
			<input type="password" id='password' class="input" name='data[User][password]' required="required" />
		</div>
		<?php
		echo $this -> Form -> end(__('Ingresar', true));
		?>
		<a class="submit primero" href='/users/register'> Registrese </a>
		
	</fieldset>
	<?php
		echo $this -> Session -> flash('auth');
		?>
</div>
