<div class="login form">
	<?php
	echo $this -> Session -> flash('auth');
	echo $this -> Form -> create('User', array('action' => 'login'));
	?>
	<fieldset>
		<legend>
			<?php __('Accede a tu cuenta');?>
		</legend>
		<?php
		echo $this -> Form -> input('email');
		echo $this -> Form -> input('password');
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Ingresar', true));?>
</div>