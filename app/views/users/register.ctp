<div class="register form">
	<?php echo $this -> Form -> create('User', array('controller' => 'users', 'action' => 'ajaxRegister', 'novalidate' => 'novalidate'));?>
	<fieldset class="centrar">
		<legend>
			<?php __('Register');?>
		</legend>
		<p>
			Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
			Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.
		</p>
		<?php
		echo $this -> Form -> input('name', array('class' => 'data', 'required' => 'required', 'label' => 'Nombre(s)'));
		?>
		<?php
		echo $this -> Form -> input('last_name', array('class' => 'data', 'required' => 'required', 'label' => 'Apellidos'));
		?>
		<div class="input text">
			<label for="UserEmail">Email<span>*</span></label>
			<input id='UserEmail' type='email' name='data[User][email]' required = 'required' style="background-image: url(/img/registro2.png);"/>
		</div>
		<div class="input text">
			<label for="UserConfirmEmail">Confirmar Email<span>*</span></label>
			<input id='UserConfirmEmail' type='email' name='data[User][confirm_email]' data-equals='data[User][email]' required = 'required' style="background-image: url(/img/registro2.png);" />
		</div>
		<?php
		echo $this -> Form -> input('password', array('type' => 'password', 'required' => 'required', 'label' => 'Contraseña'));
		echo $this -> Form -> input('confirm_password', array('type' => 'password', 'required' => 'required', 'data-equals' => 'data[User][password]', 'label' => 'Confirmar Contraseña'));
		echo $this -> Form -> input('state', array('label' => 'Departamento', 'required' => 'required'));
		echo $this -> Form -> input('city', array('label' => 'Ciudad', 'required' => 'required'));
		echo $this -> Form -> input('address', array('label' => 'Dirección', 'required' => 'required'));
		echo $this -> Form -> input('phone', array('required' => 'required', 'label' => 'Teléfono', 'title' => __('Este campo es para contactarte una vez compres un domicilio, no utilizaremos esta información para otros fines', true)));
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Register', true));?>
	<div style="clear: both"></div>
</div>
<script type='text/javascript'>
	$(function() {
		$('#UserAjaxRegisterForm').validator({
			lang : 'es'
		}).submit(function(e) {
			var form = $(this);
			var fields = $(this).serialize();
			if(!e.isDefaultPrevented()) {
				jQuery.ajax({
					url : '/users/ajaxRegister',
					type : "POST",
					cache : false,
					dataType : "json",
					data : fields,
					success : function(validate) {
						if(validate === 1) {
							window.location = '/users/validateEmail';
						} else {
							form.data("validator").invalidate(validate);
						}
					}
				});
				e.preventDefault();
			}
		});
	});
</script>