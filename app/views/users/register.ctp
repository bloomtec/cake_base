<div class="register form">
<?php echo $this -> Form -> create('User', array('controller' => 'users', 'action' => 'register')); ?>

	<fieldset>
		<legend><?php __('Register'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('enter_password', array('type' => 'password', 'value' => ''));
		echo $this->Form->input('confirm_password', array('type' => 'password', 'value' => ''));
		// User Fields
		echo $this->Form->input('document_type_id');
		echo $this->Form->input('document');
		echo $this->Form->input('email');
		echo $this->Form->input('confirm_email');
		echo $this->Form->input('name');
		echo $this->Form->input('surname');
		echo $this->Form->input('phone');
		echo $this->Form->input('address');
		echo $this->Form->input('birthday', array('type' => 'date'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>