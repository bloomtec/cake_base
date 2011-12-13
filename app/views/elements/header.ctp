<div id="header">
	<div class="wrapper">
		<a href="/" class="logo_header"></a>
		<p>
			Dile a tu amigos que hay pa´comer  y acumula puntos.
			Mira la opción <a href="#">PREMIOS</a>  y decide que te quieres ganar!
			<br /><a href="#">¡INVITAR A MIS AMIGOS!</a>
		</p>
		<div class="sesion">
			<h1>Idioma</h1>
			<a href=""><img src="/img/ingles.png" /></a>
			<a href=""><img src="/img/espanol.png" /></a>
			<div style="clear: both"></div>
			<?php if(!$this -> Session-> read('Auth.User.id')){?>
			<a href="/users/login" class="iniciar_sesion"><?php __('Sign in'); ?></a>
			-
			<a href="/users/register" class="iniciar_sesion" ><?php __('Register'); ?></a>
			<?php }else{?>
			<a href="/users/logout"><?php __('Log out');?></a>
			<?php } ?>
			
<!-- tooltip			
			<div class="tooltip_login ajax_login">
				<?php echo $this -> Form -> create('User', array('action' => 'ajaxLogin')); ?>
				<label for="email">E-mail:</label>
				<input type="email" required="required" name="data[User][email]" id="email" class="input_text">
				<label for="password">Password:</label>
				<input type="password" required="required" name="data[User][password]" id="password" class="input_text">
				<span class="message">
					espacio de error
				</span>
				<div style='clear:both;'></div>
				<input type="submit" class="btn_login" value="Ingresar" />
				<a href="/users/register" class="btn_login"><?php __('Registrer') ?></a>
				<?php echo $this -> Form ->end();?>
			</div>
-->
		</div>
	</div>
</div>