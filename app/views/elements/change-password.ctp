<?php echo $this->Form->create('User',array('action'=>'changePassword'));?>
<h1><?php __('Cambiar Contraseña')?></h1>
	<fieldset>
	<?php
		echo $this->Form->input('id',array('value'=>$this->params['pass'][0]));
		echo $this->Form->input('old_password',array('type'=>'password','label'=>'Antigua Contraseña','required'=>'required'));
		echo $this->Form->input('new_password',array('type'=>'password','label'=>'Contraseña','required'=>'required', 'message'=>'Los passwords no coinciden'));
		echo $this->Form->input('confirm_password',array('type'=>'password','label'=>'Confirmar Contraseña','required'=>'required' , 'data-equals'=>'data[User][new_password]'));
	?>
	</fieldset>
	<div class='submit'>
	<input type="submit"  value="Cambiar" />
	</div>
<?php echo $this->Form->end();?>
<script type='text/javascript'>
	$(function(){
		$('#UserChangePasswordForm').validator({lang:'es'});
	});
</script>