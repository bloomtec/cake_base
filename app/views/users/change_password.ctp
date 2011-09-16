<div class="changePassword form">
	<?php
		echo $this -> Form -> create('User', array('action' => 'changePassword'));
	?>
	<fieldset>
		<legend>
			<?php __('Change Password');?>
		</legend>
		<?php
			echo $this -> Form -> hidden('id', array('value' => $this->Session->read('Auth.User.id')));
			echo $this -> Form -> input ('enter_old_password', array('type' => 'password', 'value' => ''));
			echo $this -> Form -> input('enter_new_password', array('type' => 'password', 'value' => ''));
			echo $this -> Form -> input('repeat_new_password', array('type' => 'password', 'value' => ''));
		?>
	</fieldset>
	<?php
		echo $this -> Form -> end(__('Submit', true));
	?>
</div>