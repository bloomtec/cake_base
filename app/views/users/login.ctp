<div class="login form">
	<?php
	echo $this -> Session -> flash('auth');
	echo $this -> Form -> create('User', array('controller' => 'users', 'action' => 'login'));
	?>
	<fieldset>
		<legend>
			<?php __('Login');?>
		</legend>
		<?php
		echo $this -> Form -> input('username');
		echo $this -> Form -> input('password');
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Submit', true));?>
</div>