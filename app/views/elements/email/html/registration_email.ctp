<div>
	<p>
		<?php echo __('Te damos la bienvenida a nuestro sitio web ', true) . Configure::read('site_name'); ?>
	</p>
	<p>
		<?php echo __('Para finalizar el proceso de registro tienes dos opciones:', true); ?>
		<?php echo __('1. Haz click en el siguiente enlace:', true); ?> <a href="<?php echo 'http://' . Configure::read('site_domain') . '/users/validateEmail/' . $code; ?>"><?php echo __('validar correo', true); ?></a><br />
		<?php echo __('2. Si el enlace falla ve ', true); ?><a href="<?php echo 'http://' . Configure::read('site_domain') . '/users/validateEmail'; ?>"><?php echo __('aquí', true); ?></a><br />
		<?php echo __('e ingresa el código: "', true) . $code . __('" (sin las comillas) en el campo correspondiente.', true); ?>
	</p>
	<p>
		<?php echo __('A partir de este momento podrás disfrutar de todas nuestras promociones.', true); ?> 
		<?php echo __('Gracias por registrarte.', true); ?>
	</p>
	<p>
		<?php echo __('ComoPromos, Todas las promociones de comida a domicilio de tu ciudad, en un solo lugar!', true); ?>
	</p>
</div>