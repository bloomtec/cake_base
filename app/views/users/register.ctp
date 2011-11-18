<div class="register form">
	<?php echo $this -> Form -> create('User', array('controller' => 'users', 'action' => 'ajaxRegister','novalidate'=>'novalidate'));?>
	<fieldset class="centrar">
		<legend>
			<?php __('Registro');?>
		</legend>
		<div class="input text">
			<label for="UserEmail">Email</label>
			<input id='UserEmail' type='email' name='data[User][email]' required = 'required' />
		</div>
		<div class="input text">
			<label for="UserConfirmEmail">Confirmar Email</label>
			<input id='UserConfirmEmail' type='email' name='data[User][confirm_email]' data-equals='data[User][email]' required = 'required' />
		</div>
		<?php
			echo $this -> Form -> input('password', array('type' => 'password','required' => 'required'));
			echo $this -> Form -> input('confirm_password', array('type' => 'password',  'required' => 'required', 'data-equals'=>'data[User][password]'));
		?>
		<?php echo $this -> Form -> end(__('Registrarse', true));?>
	</fieldset>
	
</div>
<script type='text/javascript'> 
$(function(){
	$('#UserAjaxRegisterForm').validator({lang:'es'}).submit(function(e){
	var form=$(this);
	var fields=$(this).serialize();
	if(!e.isDefaultPrevented()){
		jQuery.ajax({
			url : '/users/ajaxRegister',
			type : "POST",
			cache : false,
			dataType : "json",
			data : fields,
			success : function(validate){
				if(validate===1){
					window.location='/users/profile';
				}else{
					form.data("validator").invalidate(validate);
				}
			}
		});	
		e.preventDefault();
	}
	});
});
</script>