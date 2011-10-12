<div class="register form">
	<?php echo $this -> Form -> create('User', array('controller' => 'users', 'action' => 'register'));?>
	<fieldset class="centrar">
		<legend>
			<?php __('Register');?>
		</legend>
		<?php
			echo $this -> Form -> input('email');
			echo $this -> Form -> input('confirm_email');
			echo $this -> Form -> input('enter_password', array('type' => 'password', 'value' => ''));
			echo $this -> Form -> input('confirm_password', array('type' => 'password', 'value' => ''));
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Register', true));?>
</div>