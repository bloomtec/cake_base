<h1><?php __('Cambiar Contraseña')?></h1>
<?php echo $this->Form->create('User',array('action'=>'changePassword','style'=>'clear:both;'));?>

	<fieldset>
	<?php
		echo $this->Form->input('id',array('value'=>$userId));
		echo $this->Form->input('old_password',array('type'=>'password','label'=>__('Antigua Contraseña', true),'required'=>'required'));
		echo $this->Form->input('new_password',array('type'=>'password','label'=>__('Contraseña', true),'required'=>'required', 'message'=>'Los passwords no coinciden'));
		echo $this->Form->input('confirm_password',array('type'=>'password','label'=>__('Confirmar Contraseña', true),'required'=>'required' , 'data-equals'=>'data[User][new_password]'));
	?>
	</fieldset>
	<div class='submit' style='clear: both;'>
		<input type="submit"  value="<?php __('Cambiar');?>" />
	</div>
	<div style="clear: both"></div>
<?php echo $this->Form->end();?>
<script type='text/javascript'>
	$(function(){
		$('#UserChangePasswordForm').validator({lang:'es'});
	});
</script>