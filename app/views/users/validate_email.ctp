<div id="register_login" class="verify">
<div class="register form">
	<fieldset class="centrar">
		<legend>
			<?php __('Autenticación');?>
		</legend>
		<p>
			Enter the given code to verify
		</p>
		<?php
			e($this->Form->create());
			e('<fieldset>');
			e($this->Form->input('validation_code', array('value'=>'')));
			e('</fieldset>');
			e($this->Form->end(__('Validate Email', true)));
		?>
	</fieldset>
	</div>
	<div style="clear: both"></div>
</div>