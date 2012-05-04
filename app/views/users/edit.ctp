<div class="users form datos_perfil" id="register_login">
	<h1><?php __('Mis Datos'); ?></h1>
<?php echo $this->Form->create('User');?>
	<fieldset>
		
	<?php
	
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label' =>__('Nombres', true)));
		echo $this->Form->input('last_name', array('label' =>__('Apellidos', true)));
		echo $this->Form->input('phone', array('label' =>__('Teléfono', true)));
	?>
	</fieldset>
	<?php echo $this -> Form -> submit(__('Actualizar', true))?>
	</form>
	
	<?php echo $this -> element('change-password');?>
</div>