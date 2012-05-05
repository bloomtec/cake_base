<?php echo $this->Form->create('User',array('action'=>'changePassword'));?>
<h1 class="orden twCenMt"><?php __('Cambiar Contraseña'); ?></h1>
	<fieldset>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('old_password',array('type'=>'password','label'=>__('Antigua Contraseña', true),'required'=>'required'));
		echo $this->Form->input('new_password',array('type'=>'password','label'=>__('Nueva Contraseña', true),'required'=>'required', 'message'=>'Los passwords no coinciden'));
		echo $this->Form->input('confirm_password',array('type'=>'password','label'=>__('Confirmar Contraseña', true),'required'=>'required' , 'data-equals'=>'data[User][new_password]'));
	?>
	</fieldset>
	<input type="submit" class="input_verde" value="Cambiar" />
	<a href='/users/profile' class="azul volver_profile"> Volver </a>
<?php echo $this->Form->end();?>
<script type='text/javascript'>
	$(function(){
		$('#UserChangePasswordForm').validator({lang:'es'});
	});
</script>