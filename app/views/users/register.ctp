<div class="register form">
	<?php echo $this -> Form -> create('User', array('controller' => 'users', 'action' => 'register'));?>
	<fieldset class="centrar">
		<legend>
			<?php __('Registro');?>
		</legend>
		<div class="input text">
			<label for="UserEmail">Email</label>
			<input id='UserEmail' type='email' name='data[User][email]' required = 'required' />
		</div>
		<div class="input text">
			<label for="UserConfirmEmail">Confirmar Email</label>
			<input id='UserConfirmEmail' type='email' name='data[User][confirm_email]' data-equals='data[User][email]' required = 'required' />
		</div>
		<?php
			echo $this -> Form -> input('enter_password', array('type' => 'password', 'value' => '', 'required' => 'required'));
			echo $this -> Form -> input('confirm_password', array('type' => 'password', 'value' => '', 'required' => 'required', 'data-equals'=>'data[User][enter_password]'));
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Registrarse', true));?>
</div>