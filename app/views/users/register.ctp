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
<div class="register form">
	<?php echo $this -> Form -> create('User', array('controller' => 'users', 'action' => 'register'));?>
	<fieldset class="centrar">
		<div class='right'>
			<legend>
				<?php __('Register', true);?>
			</legend>
			<div class="input text">
				<label for="UserEmail"><?php echo __('Email', true); ?></label>
				<input id='UserEmail' type='email' name='data[User][email]' required = 'required' value="<?="$email";?>" />
			</div>
			<div class="input text">
				<label for="UserConfirmEmail"><?php echo __('Confirm Email', true); ?></label>
				<input id='UserConfirmEmail' type='email' name='data[User][confirm_email]' data-equals='data[User][email]' required = 'required' value="<?="$confirm_email";?>" />
			</div>
			<?php
				echo $this -> Form -> input('name', array('label'=>__('Name', true), 'required'=>'required'));
				echo $this -> Form -> input('last_name', array('label'=>__('Last Name', true), 'required'=>'required'));
				echo $this -> Form -> input('password', array('label'=>__('Password', true), 'required' => 'required', 'value'=>''));
				echo $this -> Form -> input('confirm_password', array('label'=>__('Confirm Password', true), 'type' => 'password',  'required' => 'required', 'value'=>'', 'data-equals'=>'data[User][password]'));
				echo $this -> Form -> input('phone',array('label'=>__('Phone', true), 'required' => 'required' , 'title' => __('This field is to be able to contact you once you make a purchase. It will not be used otherwise.',true) ));
			?>
	</fieldset>
	<div class="btn_wrraper">
		<?php echo $this -> Form -> end(__('Register', true));?>
	</div>
	
</div>
<!--
<div class="register form">
	<?php echo $this -> Form -> create('User', array('controller' => 'users', 'action' => 'ajaxRegister', 'novalidate'=>'novalidate'));?>
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
				echo $this -> Form -> input('phone',array('required' => 'required' , 'title' => __('Este campo es para contactarte una vez compres un domicilio, no utilizaremos esta información para otros fines',true) ));
			?>

	</fieldset>
	<div class="btn_wrraper">
		<?php echo $this -> Form -> end(__('Register', true));?>
	</div>
	
</div>

<script type='text/javascript'> 
$(function(){
	if($('#AddressCountryId').val()) BJS.updateSelect($('#AddressCityId'),'/countries/getCities/'+$('#AddressCountryId').val());
	$('#AddressCountryId').change(function(){
		BJS.updateSelect($('#AddressCityId'),'/countries/getCities/'+$(this).val());
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
-->