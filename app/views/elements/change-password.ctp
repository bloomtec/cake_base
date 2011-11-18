<div class="login form2 users">
	<?php echo $this->Form->create('User',array('action'=>'changePassword'));?>
		<fieldset>
			<legend><?php __('Cambiar contraseña'); ?></legend>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('old_password',array('type'=>'password','label'=>'Antiguo Password','required'=>'required'));
			echo $this->Form->input('new_password',array('type'=>'password','label'=>'Password','required'=>'required', 'message'=>'Los passwords no coinciden'));
			echo $this->Form->input('confirm_password',array('type'=>'password','label'=>'Confirmar password','required'=>'required' , 'data-equals'=>'data[User][new_password]'));
		?>
		<?php echo $this->Form->submit(__("change",true)) ?>
		<a href='/users/profile' class="boton"> <?php __("Back")?> </a>
		</fieldset>
		
		<?php echo $this->Form->end();?>
</div>
<script type='text/javascript'>
	$(function(){
		$('#UserChangePasswordForm').validator({lang:'es'});
	});
</script>