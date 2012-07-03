<?php echo $this -> element('overlay-bonos');?>
<div id="header">
	<div class="wrapper">
		<img src="/img/logo.jpg" style="display: none;" />
		<div class="tooltip_login ajax_login">
			<?php echo $this -> Form -> create('User', array('action' => 'ajaxLogin')); ?>
			<label for="email"><?php __('E-mail'); ?>:</label>
			<input type="email" required="required" name="data[User][email]" id="email" class="input_text">
			<label for="password"><?php __('Contraseña'); ?>:</label>
			<input type="password" required="required" name="data[User][password]" id="password" class="input_text">
			<span class="message"> &nbsp;
			</span>
			<div style='clear:both;'></div>
			<!-- <input type="submit" class="btn_login" value="Ingresar" /> -->
			<a href="#" id="AjaxLoginSubmit" class="btn_login"><?php __('INGRESAR'); ?></a>
			<!--<a href="/users/register" class="btn_login"><?php __('REGISTRO'); ?></a>-->
			<?php echo $this -> Form ->end();?>
			<div style="clear: both"></div>
		</div>
		<a href="/" class="logo_header"></a>
		<p>
			<?php __('Dile a tus amigos que hay para comer y acumula'); ?> <a class='dinero' rel='#overlay_bonos' href="#"><?php __('dinero'); ?></a> <?php __('para tus proximas compras.'); ?>
			
			<br />
			<br />
			<?php if($this -> Session -> read('Auth.User.id')) : ?>
			<a href="/users/refer"> <span class='dinero'><?php __('¡INVITAR A MIS AMIGOS!'); ?></span></a>
			<?php endif; ?>
		</p>
		<div class="sesion">
			<div class='nombre'>
				<?php if($this -> Session -> read("Auth.User.name")) echo __("Hola, ").$this -> Session -> read("Auth.User.name")." ". $this -> Session -> read("Auth.User.last_name") ?>
			</div>
			<div style="clear: both"></div>
			<?php if(!$this -> Session-> read('Auth.User.id')){?>
			<a href="/" class='iniciar_sesion'><?php __('INICIO'); ?></a>
			-
			<a href="/users/login" class="iniciar_sesion login"><?php __('INGRESAR'); ?></a>
			-
			<a href="/users/register" class="iniciar_sesion" ><?php __('REGISTRO'); ?></a>
			<?php }else{ ?>
			<a href="/"><?php __('INICIO');?></a>
			-
			<a href="/users/profile"><?php __('MI PERFIL');?></a>
			-
			 <a href="/users/logout"><?php __('SALIR');?></a>
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
	$(function(){
		  $("a.dinero[rel]").overlay();
	});
</script>