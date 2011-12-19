<div class="register form">
	<?php echo $this -> Form -> create('User', array('controller' => 'users', 'action' => 'ajaxRegisterProvider','novalidate'=>'novalidate'));?>
	<fieldset class="centrar">
		<legend>
			<?php __('Registro de proveedores');?>
		</legend>
		<p>
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
				Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.
		</p>
		<div class="input text">
			<label for="UserEmail">Email:</label>
			<input id='UserEmail' type='email' name='data[User][email]' required = 'required' style="background-image: url(/img/registro2.png);" />
		</div>
		<div class="input text">
			<label for="UserConfirmEmail">Confirmar Email:</label>
			<input id='UserConfirmEmail' type='email' name='data[User][confirm_email]' data-equals='data[User][email]' required = 'required' style="background-image: url(/img/registro2.png);" />
		</div>
		<?php
			echo $this -> Form -> input('password', array('type' => 'password','required' => 'required' , 'label'=>'Contraseña'));
			echo $this -> Form -> input('confirm_password', array('type' => 'password',  'required' => 'required', 'data-equals'=>'data[User][password]' , 'label'=>'Confirmar Contraseña'));
			echo $this -> Form -> input('Nit', array('required' => 'required'));
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Registrarse', true));?>
	<div style="clear: both"></div>
</div>
<script type='text/javascript'> 
$(function(){
	$('#UserAjaxRegisterProviderForm').validator({lang:'es'}).submit(function(e){
	var form=$(this);
	var fields=$(this).serialize();
	if(!e.isDefaultPrevented()){
		jQuery.ajax({
			url : '/users/ajaxRegisterProvider',
			type : "POST",
			cache : false,
			dataType : "json",
			data : fields,
			success : function(validate){
				if(validate===1){
					window.location='/users/enEspera';
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