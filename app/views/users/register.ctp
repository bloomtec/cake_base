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
		<?php echo $this -> Form -> create('User', array('controller' => 'users', 'action' => 'ajaxRegister', 'novalidate'=>'novalidate'));?>
		<fieldset class="centrar">
			<legend>
				<?php __('¿Aún no eres usuario?'); ?>
			</legend>
			<p>
				<?php __('Registrate y empieza a disfrutar de los mejores descuentos!'); ?>
			</p>
				<div class="input text">
					<label for="UserEmail"><?php echo __('Correo', true); ?></label>
					<input id='UserEmail' type='email' name='data[User][email]' required = 'required' value="<?="$email";?>" />
					<span class="field_required">*</span>
				</div>
				<div class="input text">
					<label for="UserConfirmEmail"><?php echo __('Confirmar Correo', true); ?></label>
					<input id='UserConfirmEmail' type='email' name='data[User][confirm_email]' data-equals='data[User][email]' required = 'required' value="<?="$confirm_email";?>" />
					<span class="field_required">*</span>
				</div>
				<?php
					// Código del referente si lo hay
					if(isset($referer_code) && !empty($referer_code)) {
						//debug($referer_code);
						echo $this -> Form -> hidden('referer_code', array('value' => $referer_code));
					}
					// Datos personales
					echo $this -> Form -> input('name', array('label'=>__('Nombre', true), 'required'=>'required','after'=>'<span class="field_required">*</span>'));
					echo $this -> Form -> input('last_name', array('label'=>__('Apellido', true), 'required'=>'required','after'=>'<span class="field_required">*</span>'));
					echo $this -> Form -> input('password', array('label'=>__('Contraseña', true), 'required' => 'required', 'value'=>'','after'=>'<span class="field_required">*</span>'));
					echo $this -> Form -> input('confirm_password', array('label'=>__('Confirmar Contraseña', true), 'type' => 'password',  'required' => 'required', 'value'=>'', 'data-equals'=>'data[User][password]','after'=>'<span class="field_required">*</span>'));
					echo $this -> Form -> input('phone', array('label'=>__('Teléfono', true), 'required' => 'required' , 'title' => __('Este campo es para contactarte cuando hagas una compra. En caso contrario, no será utilizado.',true),'after'=>'<span class="field_required">*</span>' ));
					echo $this -> Form -> input('country_id', array('label'=>__('País', true),'after'=>'<span class="field_required">*</span>'));
					echo $this -> Form -> input('city_id', array('label'=>__('Ciudad', true),'after'=>'<span class="field_required">*</span>'));
					// Direccion
					echo $this -> Form -> hidden('Address.name', array('label' => __('Nombre', true), 'required' => 'required', 'value' => 'Dirección de Registro'));
					echo $this -> Form -> input('Address.zone_id', array('label' => __('Zona', true), 'required' => 'required','after'=>'<span class="field_required">*</span>'));
					echo $this -> Form -> input('Address.another_zone', array('label' => '', 'style' => 'visibility: hidden;', 'after'=>'<span style="visibility: hidden;" class="field_required afterSpan">*</span>'));
					echo $this -> Form -> input('Address.address', array('label' => __('Dirección', true), 'required' => 'required','after'=>'<span class="field_required">*</span>'));
					echo $this -> Form -> input('Address.zip', array('label' => __('Código Postal', true),'value'=>'57'));
				?>
		</fieldset>
		<p>
			<b>
				<?php __('Recuerda revisar tu correo luego de enviar el formulario de registro para activar tu usuario. Este paso es requerido para disfrutar de las promociones que encontrarás en nuestro sitio.'); ?>
			</b>
		</p>
		<div class="btn_wrraper">
			<?php echo $this -> Form -> end(__('Registro', true));?>
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
				<?php __('Introduce tus datos de sesión para acceder a tu cuenta'); ?>
			</p>
			<div class="input text">
				<label for='email'><?php __('Correo:'); ?></label>
				<input type="email" class="input" id='email' name='data[User][email]' required="required" />
			</div>
			<div class="input text">
				<label for='password'><?php __('Contraseña:'); ?></label>
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
	<h3><?php __('Los campos marcados con (*) son obligatorios'); ?></h3>
	<div style="clear: both"></div>
</div>

<script type='text/javascript'>
$(function(){
	
	$('#UserLoginForm').validator({lang:'es',position:"bottom left"});
	var country_id = $('#UserCountryId').val();
	if($('#UserCountryId').val()) {
		BJS.updateSelect($('#UserCityId'),'/countries/getCities/'+$('#UserCountryId').val(),function(){
			BJS.updateSelect($('#AddressZoneId'),'/cities/getZones/'+$('#UserCityId').val());
			$('#AddressZoneId').append('<option value="otro">Selecciona tu zona...</option>');
		});
		
	} 
	$('#UserCountryId').change(function(){
		BJS.updateSelect($('#UserCityId'),'/countries/getCities/'+$(this).val());
	});
	
	$('#UserCityId').change(function(){
		BJS.updateSelect($('#AddressZoneId'),'/cities/getZones/'+$(this).val());
		$('#AddressZoneId').append('<option value="otro">Selecciona tu zona...</option>');
	});
	
	$('#AddressZoneId').change(function() {
		if($('#AddressZoneId').val() == 'otro') {
			$('#AddressAnotherZone').css('visibility', 'visible');
			$('.afterSpan').css('visibility', 'visible');
			$('#AddressAnotherZone').attr('required', 'required');
		} else {
			$('#AddressAnotherZone').removeAttr('required', 'required');
			$('#AddressAnotherZone').removeClass('invalid');
			$('#AddressAnotherZone').css('visibility', 'hidden');
			$('.afterSpan').css('visibility', 'hidden');
		}
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
					window.location='/';
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