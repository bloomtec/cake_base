<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Admin Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('role_id', array('label' => __('Rol', true)));
		echo $this->Form->input('active', array('label' => __('Activo', true)));
		echo $this->Form->input('email', array('label' => __('Correo Electrónico', true)));
		echo $this->Form->input('pass', array('label'=>__('Contraseña', true),'type'=>'password', 'value'=>''));
		echo $this->Form->input('name', array('label' => __('Nombre', true)));
		echo $this->Form->input('last_name', array('label' => __('Apellido', true)));
		echo $this->Form->input('phone', array('label' => __('Teléfono', true)));
	?>
	<div class="city-id" style="visibility: hidden;">
	<?php
		echo $this->Form->input('city_id', array('empty'=>__('Seleccione...', true)));
	?>
	</div>
	</fieldset>
<?php echo $this->Form->end(__('Enviar', true));?>
</div>