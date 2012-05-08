<div id="register_login" class="verify">
<div class="register form">
	<fieldset class="centrar">
		<legend>
			<?php __('Autenticación');?>
		</legend>
		<p>
			<?php __('Ingresa tu código para verificar.'); ?>
		</p>
		<?php
			e($this->Form->create());
			e('<fieldset>');
			e($this->Form->input('validation_code', array('label' => __('Código De Validación', true), 'value'=>'')));
			e('</fieldset>');
			e($this->Form->end(__('Validar', true)));
		?>
	</fieldset>
	</div>
	<div style="clear: both"></div>
</div>