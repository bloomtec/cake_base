<div>
	<p>
		<?php echo $user_full_name . __(', te informamos que la orden con código ', true) . $order_code . __(' del sitio ', true) . Configure::read('site_name') . __(' ha sido rechazada.', true); ?>
	</p>
	<p>
		<?php echo __('La causa del rechazo se explica a continuación:', true); ?>
	</p>
	<p>
		<?php echo $comments; ?>
	</p>
	<p>
		<?php echo __('Esperamos que esto no sea motivo para dejar de usar nuestro servicio en un futuro.', true); ?> 
	</p>
	<p>
		<?php echo __('ComoPromos, Todas las promociones de comida a domicilio de tu ciudad, en un solo lugar!', true); ?>
	</p>
</div>