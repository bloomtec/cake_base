<div class="orders register form">
	<h1 class="mensaje-compra">Antes de comprar ten en cuenta.</h1>
	<p class="mensaje-compra">
		Con el objetivo de evitar pedidos falsos y mejorar los tiempos de entrega, la
		ubicacion desde donde se haga su pedido sera registrada en nuestro sitio web.
		Compra con responsabilidad
	</p>
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
			<div class="promo">
				
				<h1><?php echo $deal['Deal']['name']; ?></h1>
				<p>
					<?php echo $deal['Deal']['description']; ?>
				</p>
				<img src="/img/uploads/50x50/<?php echo $deal['Deal']['image']; ?>" />
				<?php
				echo $this -> Form -> hidden('Deal.id', array('value' => $deal['Deal']['id']));
				echo $this -> Form -> input('quantity', array('label' => __('Cantidad (máximo: ' . $deal['Deal']['max_buys'] . ')', true), 'value' => 1));
				?>
			</div>
			
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
			if ($user['Address'] && !empty($addresses)) {
				echo $this -> Form -> input('address_id');
			} else {
				echo $this -> Form -> input('Address.name', array('label' => 'Nombre', 'value' => __('default', true)));
				if($user) {
					echo $this -> Form -> hidden('Address.user_id', array('value' => $user['User']['id']));
				}
				echo $this -> Form -> input('Address.country_id', array('label' => __('País', true), 'class' => 'pais'));
				echo $this -> Form -> input('Address.city_id', array('label' => __('Ciudad', true), 'class' => 'ciudad'));
				echo $this -> Form -> input('Address.address', array('label' => 'Dirección', 'type' => 'text'));
				echo $this -> Form -> input('Address.zone_id', array('class' => 'barrio'));
				echo $this -> Form -> input('Address.zip', array('label' => 'Código Postal'));				
			}
			echo "<div class='terminos'>";
			__('Acepto ');
			echo $this->Html->link(__('Los terminos y condiciones',true),array('controller'=>'pages','action'=>'terminosYCondiciones'),array('target'=>'_blank'));
			echo $this -> Form -> checkbox('terminos',array('label'=>false,"required"=>'required'));
			echo "</div>";
			?>
		</fieldset>
	</div>
	<?php echo $this -> Form -> end(__('Comprar', true));?>
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
		$.tools.validator.localize("es", {
		'*'			: 'dato no valido',
		':email'  	: 'email no valido',
		':number' 	: 'el campo debe ser numerico',
		':url' 		: 'URL no valida',
		'[max]'	 	: 'el campo debe ser menor a $1',
		'[min]'		: 'el campo debe ser mayot a $1',
		'[required]'	: 'campo obligatorio',
		'[data-equals]' : 'verifique este campo'
		});
		$('form').validator({'lang':'es'});
		
		/** -------- **/
		
		var cambiarPaisYCiudad = function() {
			if($('.barrio').val()) {
				BJS.updateSelect($('.ciudad'),'/zones/getZoneCity/'+$('.barrio').val());
				BJS.updateSelect($('.pais'),'/cities/getCityCountry/'+$('.ciudad').val());
			}
		};
		
		cambiarPaisYCiudad();
		
		$('.barrio').change(function() {
			cambiarPaisYCiudad();
		});
	});
</script>