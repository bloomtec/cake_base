<div class="register form">
	<?php echo $this -> Form -> create('User', array('controller' => 'users', 'action' => 'ajaxRegister','novalidate'=>'novalidate'));?>
	<fieldset class="centrar">
		<div class='right'>
			<legend>
				<?php __('Register');?>
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
				echo $this -> Form -> input('phone',array('required' => 'required' , 'title' => __('Este campo es para contactarte una vez compres un domicilio, no utilizaremos esta información para otros fines') ));
			?>
		</div>
		<div class='left'>
			<legend>
				<?php __('Address');?>
			</legend>
			<?php
				echo $this -> Form -> input('Address.country_id', array('required' => 'required'));
				echo $this -> Form -> input('Address.city_id', array('required' => 'required'));
				
			?>
		</div>
	</fieldset>
	<?php echo $this -> Form -> end(__('Register', true));?>
</div>
<script type='text/javascript'> 
$(function(){
	$('').change(function(){
		
	});
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