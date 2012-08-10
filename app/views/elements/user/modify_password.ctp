<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Modificar Contraseña'); ?></legend>
	<?php
		echo $this -> Form -> input('id');
		echo $this -> Form -> input('old_pass', array('label' => __('Contraseña Anterior', true), 'type' => 'password', 'value' => ''));
		echo $this -> Form -> input('new_pass', array('label' => __('Contraseña Nueva', true), 'type' => 'password', 'value' => ''));
		echo $this -> Form -> input('verified_pass', array('label' => __('Verificar Contraseña', true), 'type' => 'password', 'value' => ''));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Enviar', true));?>
</div>