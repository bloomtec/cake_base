<div>
	<p>
		<?php echo $user_full_name . __(', te informamos que el estado de la orden con código ', true) . $order_code . __(' del sitio ', true) . Configure::read('site_name') . __(' ha sido modificado.', true); ?>
	</p>
	<p>
		<?php echo __('El estado anterior era:', true) . $oldState; ?>
	</p>
	<p>
		<?php echo __('El nuevo estado es:', true) . $newState; ?>
	</p>
</div>