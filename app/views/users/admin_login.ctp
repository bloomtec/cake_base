<div class="login form">
	<?php
		echo $this -> Form -> create('User', array('controller' => 'users', 'action' => 'login'));
	?>
	<fieldset class="centrar">
	<?php
		echo $this -> Form -> input('email', array('label' => __('Correo Electrónico', true)));
		echo $this -> Form -> input('password', array('label' => __('Contraseña', true))); 
		echo $this -> Session -> flash('auth');
		echo $this -> Form -> end(__('Ingresar', true));
	?>
	</fieldset>
</div>