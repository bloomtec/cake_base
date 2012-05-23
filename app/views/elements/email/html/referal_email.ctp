<div>
	<p>
		<?php echo __('Un amigo quiere que te unas a :: ', true) . Configure::read('site_name') . ' :: El sitio web donde encontrarás todas las promociones de comida a domicilio de tu ciudad, en un solo lugar!'; ?>
	</p>
	<p>
		<?php echo __('Para registrarte ve a:', true); ?> <a href="<?php echo 'http://' . Configure::read('site_domain') . '/users/register/' . $code; ?>"><?php echo __('registro', true); ?></a><br />
	</p>
	<p>
		<?php echo __('¡Te esperamos pronto para que disfrutes de todas nuestras promociones!', true); ?>
	</p>
</div>