<div id="header">
	<div class="wrapper">
		<img src="/img/logo.jpg" style="display: none;" />
		<div class="tooltip_login ajax_login">
			<?php echo $this -> Form -> create('User', array('action' => 'ajaxLogin')); ?>
			<label for="email">E-mail:</label>
			<input type="email" required="required" name="data[User][email]" id="email" class="input_text">
			<label for="password">Password:</label>
			<input type="password" required="required" name="data[User][password]" id="password" class="input_text">
			<span class="message"> &nbsp;
			</span>
			<div style='clear:both;'></div>
			<!-- <input type="submit" class="btn_login" value="Ingresar" /> -->
			<a href="#" id="AjaxLoginSubmit" class="btn_login"><?php __('INGRESAR'); ?></a>
			<a href="/users/register" class="btn_login"><?php __('REGISTRO'); ?></a>
			<?php echo $this -> Form ->end();?>
			<div style="clear: both"></div>
		</div>
		<a href="/" class="logo_header"></a>
		<p>
			Dile a tu amigos que hay pa´comer  y acumula puntos.
			Mira la opción <a href="/prizes/index">PREMIOS</a>  y decide que te quieres ganar!
			<br />
			<?php if($this -> Session -> read('Auth.User.id')) : ?>
			<a href="/users/refer">¡INVITAR A MIS AMIGOS!</a>
			<?php endif; ?>
		</p>
		<div class="sesion">
			<!--
			<h1>Idioma</h1>
			<a href=""><img src="/img/ingles.png" /></a>
			<a href=""><img src="/img/espanol.png" /></a>
			-->
			<div style="clear: both"></div>
			<?php if(!$this -> Session-> read('Auth.User.id')){?>
			<a href="/users/login" class="iniciar_sesion login"><?php __('INGRESAR'); ?></a>
			-
			<a href="/users/register" class="iniciar_sesion" ><?php __('REGISTRO'); ?></a>
			<?php }else{ ?>
			<a href="/users/profile"><?php __('Mí Perfil');?></a>
			-
			 <a href="/users/logout"><?php __('Salir');?></a>
			<?php } ?>
		</div>
		<div style="clear: both"></div>
	</div>
	<div style="clear: both"></div>
</div>
<script>
	$("#AjaxLoginSubmit").click(function(e){
		e.preventDefault();
		$("#UserAjaxLoginForm").submit();
	});
</script>