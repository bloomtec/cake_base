<div>
	<p>
		<?php echo __('Te damos la bienvenida a nuestro sitio web ', true) . Configure::read('site_name'); ?>
	</p>
	<p>
		<?php echo __('Para finalizar el proceso de registro haz click en el siguiente enlace:', true); ?> <a href="<?php echo 'http://' . Configure::read('site_domain') . '/users/validateEmail/' . $code; ?>"><?php echo __('validar correo', true); ?></a><br />
	</p>
	<p>
		<?php echo __('A partir de este momento podrás disfrutar de todas nuestras promociones.', true); ?> 
		<?php echo __('Gracias por registrarte.', true); ?>
	</p>
	<p>
		<?php echo __('ComoPromos, Todas las promociones de comida a domicilio de tu ciudad, en un solo lugar!', true); ?>
	</p>
</div>