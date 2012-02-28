<div class="orders register form">
	<?php
	// debug($user);
	echo $this -> Form -> create('Order');
	echo $this -> Form -> hidden('deal_id', array('value' => $deal['Deal']['id']));
	?>
	<div class="orden datos-orden">
		<fieldset>
			<legend>
				<?php __('Comprar Promoción');?>
			</legend>
			<?php
				echo $this -> Form -> hidden('max_buys', array('value' => $deal['Deal']['max_buys']));
				echo $this -> Form -> input('quantity', array('label' => __('Cantidad (máximo: ' . $deal['Deal']['max_buys'] . ')', true)));
			?>
		</fieldset>
	</div>
	<div class="orden datos-usuario">
		<fieldset>
			<legend>
				<?php __('Datos Usuario');?>
			</legend>
			<?php
				if($user) {
					echo $this -> Form -> hidden('user_id', array('type' => 'input', 'value' => $user['User']['id']));
					echo $this -> Form -> input('Info.name', array('label' => __('Nombre', true), 'value' => $user['User']['name'], 'disabled' => 'disabled'));
					echo $this -> Form -> input('Info.last_name', array('label' => __('Apellido', true), 'value' => $user['User']['last_name'], 'disabled' => 'disabled'));
					echo $this -> Form -> input('Info.email', array('label' => __('Correo Electrónico', true), 'value' => $user['User']['email'], 'disabled' => 'disabled'));
					echo $this -> Form -> input('Info.phone', array('label' => __('Teléfono', true), 'value' => $user['User']['phone'], 'disabled' => 'disabled'));
				} else {
					echo $this -> Form -> input('User.name', array('label' => __('Nombre', true)));
					echo $this -> Form -> input('User.last_name', array('label' => __('Apellido', true)));
					echo $this -> Form -> input('User.email', array('label' => __('Correo Electrónico', true)));
					echo $this -> Form -> input('User.password', array('label' => __('Contraseña', true)));
					echo $this -> Form -> input('User.phone', array('label' => __('Teléfono', true)));
					echo $this -> Form -> input('User.country_id', array('label' => __('País', true)));
					echo $this -> Form -> input('User.city_id', array('label' => __('Ciudad', true)));
				}
			?>
		</fieldset>
	</div>
	<div class="orden datos-direccion">
		<fieldset>
			<legend>
				<?php __('Datos Dirección');?>
			</legend>
			<?php
			if ($user['Address']) {
				echo $this -> Form -> input('address_id');
			} else {
				echo $this -> Form -> input('Address.name', array('label' => 'Nombre'));
				if($user) {
					echo $this -> Form -> hidden('Address.user_id', array('value' => $user['User']['id']));
					echo $this -> Form -> hidden('Address.country_id', array('value' => $user['City']['country_id']));
					echo $this -> Form -> hidden('Address.city_id', array('value' => $user['City']['id']));
				}
				echo $this -> Form -> input('Address.address', array('label' => 'Dirección'));
				echo $this -> Form -> input('Address.zip', array('label' => 'Código Postal'));				
			}
			?>
		</fieldset>
	</div>
	<?php echo $this -> Form -> end(__('Submit', true));?>
</div>
<script type="text/javascript">
	$(function() {
		var country_id = $('#UserCountryId').val();
		if($('#UserCountryId').val()) {
			BJS.updateSelect($('#UserCityId'),'/countries/getCities/'+$('#UserCountryId').val());
		}
		$('#UserCountryId').change(function(){
			BJS.updateSelect($('#UserCityId'),'/countries/getCities/'+$(this).val());
		});
	});
</script>