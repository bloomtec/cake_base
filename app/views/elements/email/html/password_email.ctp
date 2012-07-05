<div>
	<p>
		<?php echo __('Se te ha enviado este correo desde :: ', true) . Configure::read('site_domain'); ?>
	</p>
	<p>
		<?php echo __('Se envió este correo luego de solicitar un cambio de contraseña.', true); ?><br />
		<?php echo __('Puedes acceder al sitio usando tu usuario y la contraseña generada.', true); ?><br />
		<?php echo __('Usuario :: ', true) . $username; ?><br />
		<?php echo __('Contraseña :: ', true) . $password; ?>
	</p>
	<p>
		<?php echo __('Recuerda cambiar la contraseña por una que recuerdes facilmente.', true); ?>
	</p>
</div>