<div>
	<p>
		<?php echo __('A friend wants you to join the site :: ', true) . Configure::read('site_name'); ?>
	</p>
	<p>
		<?php echo __('To register go to the following link:', true); ?> <a href="<?php echo 'http://' . Configure::read('site_domain') . '/users/register/' . $code; ?>"><?php echo __('register', true); ?></a><br />
	</p>
	<p>
		<?php echo __('We hope to have you soon!.', true); ?>
	</p>
</div>