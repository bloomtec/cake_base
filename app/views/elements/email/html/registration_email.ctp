<div>
	<p>
		<?php echo __('Welcome to the site :: ', true) . Configure::read('site_name'); ?>
	</p>
	<p>
		<?php echo __('To finish your registration process, click the following link:', true); ?><br />
		<?php echo Configure::read('site_domain') . '/users/validateEmail/' . $code; ?><br />
		<?php echo __('If the link fails to work for you then go ', true); ?><a href="<?php echo Configure::read('site_domain') . '/users/validateEmail'; ?>"><?php echo __('here', true); ?></a><br />
		<?php echo __('Enter the code: ', true) . $code . __('in the corresponding field.', true); ?>	
	</p>
	<p>
		<?php echo __('Thank you for registering.', true); ?>
	</p>
</div>