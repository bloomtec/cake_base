<?php echo $this->Form->create('User',array('action'=>'changePassword'));?>
	<fieldset>
		<legend><?php __('Cambiar contraseña'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('old_password',array('type'=>'password','label'=>'Antiguo Password','required'=>'required'));
		echo $this->Form->input('new_password',array('type'=>'password','label'=>'Password','required'=>'required', 'message'=>'Los passwords no coinciden'));
		echo $this->Form->input('confirm_password',array('type'=>'password','label'=>'Confirmar password','required'=>'required' , 'data-equals'=>'data[User][new_password]'));
	?>
	</fieldset>
	<input type="submit" class="confirmar" value="Cambiar" />
	<a href='/users/profile' class="volver_profile"> Volver </a>
<?php echo $this->Form->end();?>
<script type='text/javascript'>
	$(function(){
		$('#UserChangePasswordForm').validator({lang:'es'});
	});
</script>