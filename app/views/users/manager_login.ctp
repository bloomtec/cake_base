<div class="login form">
	<?php
		echo $this -> Form -> create('User', array('controller' => 'users', 'action' => 'login'));
	?>
	<fieldset class="centrar">
	<?php
		echo $this -> Form -> input('email');
		echo $this -> Form -> input('password');
		echo $this -> Session -> flash('auth');
		echo $this -> Form -> end(__('Login', true));
	?>
	</fieldset>
</div>