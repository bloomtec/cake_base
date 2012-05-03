<div>
	<p>
		<?php echo __('Un amigo quiere que te unas al sitio :: ', true) . Configure::read('site_name'); ?>
	</p>
	<p>
		<?php echo __('Para registrarte ve a:', true); ?> <a href="<?php echo 'http://' . Configure::read('site_domain') . '/users/register/' . $code; ?>"><?php echo __('registro', true); ?></a><br />
	</p>
	<p>
		<?php echo __('¡Esperamos tenerte pronto!.', true); ?>
	</p>
</div>