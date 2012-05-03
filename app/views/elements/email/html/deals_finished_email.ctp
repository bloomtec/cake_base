<div>
	<p>
		<?php echo __('Las promos correspondientes a ', true) . $deal['Deal']['name'] . __(' se han agotado.', true); ?>
	</p>
	<p>
		<?php echo __('Por favor contacta a tu agente local para agregar promos o crear una nueva para el restaurante ', true) . $restaurant['Restaurant']['name']; ?>
	</p>
	<p>
		<?php echo __('Gracias por usar ', true) . Configure::read('site_domain'); ?>
	</p>
</div>