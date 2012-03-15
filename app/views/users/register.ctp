<?php
	$email = '';
	$confirm_email = '';
	$name = '';
	$last_name = '';
	if(!empty($this->data)) {
		$email = $this->data['User']['email'];
		$confirm_email = $this->data['User']['confirm_email'];
		$name = $this->data['User']['name'];
		$last_name = $this->data['User']['last_name'];
	}
?>
<div id="register_login">
	<div class="register form">
		<?php //echo $this -> Form -> create('User', array('controller' => 'users', 'action' => 'register'));?>
		<?php echo $this -> Form -> create('User', array('controller' => 'users', 'action' => 'ajaxRegister', 'novalidate'=>'novalidate'));?>
		<fieldset class="centrar">
			<legend>
				<?php __('¿Aún no eres usuario?');?>
			</legend>
			<p>
				Registrate y empieza a disfrutar de los mejores descuentos!
			</p>
				<div class="input text">
					<label for="UserEmail"><?php echo __('Email', true); ?></label>
					<input id='UserEmail' type='email' name='data[User][email]' required = 'required' value="<?="$email";?>" />
					<span class="field_required">*</span>
				</div>
				<div class="input text">
					<label for="UserConfirmEmail"><?php echo __('Confirm Email', true); ?></label>
					<input id='UserConfirmEmail' type='email' name='data[User][confirm_email]' data-equals='data[User][email]' required = 'required' value="<?="$confirm_email";?>" />
					<span class="field_required">*</span>
				</div>
				<?php
					// Código del referente si lo hay
					if(isset($referer_code) && !empty($referer_code)) {
						debug($referer_code);
						echo $this -> Form -> hidden('referer_code', array('value' => $referer_code));
					}
					// Datos personales
					echo $this -> Form -> input('name', array('label'=>__('Name', true), 'required'=>'required'));
					echo $this -> Form -> input('last_name', array('label'=>__('Last Name', true), 'required'=>'required'));
					echo $this -> Form -> input('password', array('label'=>__('Password', true), 'required' => 'required', 'value'=>''));
					echo $this -> Form -> input('confirm_password', array('label'=>__('Confirm Password', true), 'type' => 'password',  'required' => 'required', 'value'=>'', 'data-equals'=>'data[User][password]'));
					echo $this -> Form -> input('phone', array('label'=>__('Phone', true), 'required' => 'required' , 'title' => __('This field is to be able to contact you once you make a purchase. It will not be used otherwise.',true) ));
					echo $this -> Form -> input('country_id', array('label'=>__('Country', true)));
					echo $this -> Form -> input('city_id', array('label'=>__('City', true)));
					// Direccion
					echo $this -> Form -> hidden('Address.name', array('label' => __('Name', true), 'required' => 'required', 'value' => 'default'));
					echo $this -> Form -> input('Address.zone_id', array('label' => __('District', true), 'required' => 'required'));
					echo $this -> Form -> input('Address.address', array('label' => __('Address', true), 'required' => 'required'));
					echo $this -> Form -> input('Address.zip', array('label' => __('Zip Code', true), 'required' => 'required'));
				?>
		</fieldset>
		<div class="btn_wrraper">
			<?php echo $this -> Form -> end(__('Register', true));?>
		</div>
		
	</div>
	
	<div class="login form">
		<?php
		echo $this -> Form -> create('User', array('action' => 'login'));
		?>
		<fieldset class="centrar">
			<legend>
				<?php __('Ingresar');?>
			</legend>
			<p>
				Introduce tus datos de sesión para acceder a tu cuenta
			</p>
			<div class="input text">
				<label for='email'>E-mail</label>
				<input type="email" class="input" id='email' name='data[User][email]' required="required" />
			</div>
			<div class="input text">
				<label for='password'>Password</label>
				<input type="password" id='password' class="input" name='data[User][password]' required="required" />
			</div>
			
		</fieldset>
		<div class="btn_wrraper">			
			<?php
			echo $this -> Form -> end(__('Ingresar', true));
			?>
		</div>
		<?php
			echo $this -> Session -> flash('auth');
			?>
	</div>
	<h3>Los campos marcados con (*) son obligatorios</h3>
	<div style="clear: both"></div>
</div>

<script type='text/javascript'> 
$(function(){
	
	$('#UserLoginForm').validator({lang:'es',position:"bottom left"});
	var country_id = $('#UserCountryId').val();
	if($('#UserCountryId').val()) {
		BJS.updateSelect($('#UserCityId'),'/countries/getCities/'+$('#UserCountryId').val());
		BJS.updateSelect($('#AddressZoneId'),'/cities/getZones/'+$('#UserCityId').val());
	} 
	$('#UserCountryId').change(function(){
		BJS.updateSelect($('#UserCityId'),'/countries/getCities/'+$(this).val());
	});
	
	$('#UserCityId').change(function(){
		BJS.updateSelect($('#AddressZoneId'),'/cities/getZones/'+$(this).val());
	});
	
	$('#UserAjaxRegisterForm').validator({lang:'es',position:"bottom left"}).submit(function(e){
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
					window.location='/users/validateEmail';
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