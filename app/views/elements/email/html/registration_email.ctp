<div>
	<p>
		<?php echo __('Bienvenido al sitio :: ', true) . Configure::read('site_name'); ?>
	</p>
	<p>
		<?php echo __('Para finalizar el proceso de registro, haz click en el siguiente enlace:', true); ?> <a href="<?php echo 'http://' . Configure::read('site_domain') . '/users/validateEmail/' . $code; ?>"><?php echo __('validar correo', true); ?></a><br />
		<?php echo __('Si el enlace falla ve ', true); ?><a href="<?php echo 'http://' . Configure::read('site_domain') . '/users/validateEmail'; ?>"><?php echo __('aquí', true); ?></a><br />
		<?php echo __('Ingresa el código: "', true) . $code . __('" (sin las comillas) en el campo correspondiente.', true); ?>
	</p>
	<p>
		<?php echo __('Gracias por registrarte.', true); ?>
	</p>
</div>