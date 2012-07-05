<div class="orders register form">
	<h1 class="mensaje-compra"><?php __('Antes de comprar ten en cuenta.'); ?></h1>
	
	<p class="mensaje-compra">
		<?php __('Verifica si este restaurante está abierto y cubre tu área.'); ?>
	</p>
	<br />
	<p class="mensaje-compra">
		<?php __('Con el objetivo de evitar pedidos falsos y mejorar los tiempos de entrega, la
		ubicacion desde donde se haga tu pedido sera registrada en nuestro sitio web.
		Compra con responsabilidad'); ?>
	</p>
	
	<?php
	echo $this -> Form -> create('Order');
	echo $this -> Form -> hidden('deal_id', array('value' => $deal['Deal']['id']));
	?>
	<div class="orden datos-orden">
		<fieldset>
			<legend>
				<?php __('Comprar Promoción');?>
			</legend>
			<div class="promo">
				<div class="order-info">
					<?php
					echo $this -> Form -> hidden('Deal.id', array('value' => $deal['Deal']['id']));
					echo $this -> Form -> hidden('Deal.price', array('value' => $deal['Deal']['price']));
					?>
					<div class="input text required">
						<label for="OrderQuantity">
							<?php __('Cantidad'); ?>						
						</label>
						<input id="OrderQuantity" type="number" maxlength="11" value="1" min="1" max="<?php echo $deal['Deal']['amount']; ?>" name="data[Order][quantity]" required="required">
					</div>
					<p class="orders-comments" style="text-align:justify; width:210px; margin-right:25px;">
						<?php __("Por favor escribe algún comentario  importante para la conformidad de tu pedido, aquí podrás omitir un ingrediente o escribir algo especifico que quisieras hacerle saber al restaurante")?>
					</p>
					<?php echo $this -> Form -> input('note', array('label' => false, 'type' => 'textarea', 'class' => 'orders')); ?>
				</div>
				<div class='cuadro-promo-order'>
					<div class="info-left">	
						<h1><?php echo $deal['Deal']['name']; ?></h1>
						<p  style="text-align:justify;">
							<?php echo $deal['Deal']['description']; ?>
						</p>
					</div>
					<img src="/img/uploads/400x400/<?php echo $deal['Deal']['image']; ?>" />
				</div>
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
					echo $this -> Form -> input('User.name', array('label' => __('Nombre', true), 'required' => 'required'));
					echo $this -> Form -> input('User.last_name', array('label' => __('Apellido', true), 'required' => 'required'));
			?>
			<div class="input text required">
				<label for="UserEmail"><?php __('Correo Electrónico');?></label>
				<input type="email" id="UserEmail" maxlength="100" required="required" name="data[User][email]" class="invalid">
			</div>
			<?php
					echo $this -> Form -> input('User.password', array('label' => __('Contraseña', true), 'required' => 'required'));
					echo $this -> Form -> input('User.phone', array('label' => __('Teléfono', true), 'required' => 'required'));
					echo $this -> Form -> input('User.country_id', array('label' => __('País', true),'empty'=>__('Seleccione su País',true)));
					echo $this -> Form -> input('User.city_id', array('label' => __('Ciudad', true),'empty'=>__('Seleccione su Ciudad',true)));
				}
			?>
		</fieldset>
	</div>
	<div class="orden datos-direccion">
		<fieldset>
			<legend>
				<?php __('Datos donde se entregará su pedido');?>
			</legend>
			<?php
			if ($user['Address'] && !empty($addresses)) {
				echo $this -> Form -> input('address_id',array('label'=>'Dirección','div'=>'input text'));
				echo $this -> Form -> input('city_id', array('label' => __('Ciudad', true), 'class' => 'ciudad','disabled' => true,'type'=>'text'));
				echo $this -> Form -> input('zone_id', array('label' => __('Zona', true), 'class' => 'barrio','disabled' => true,'type'=>'text'));
				echo $this -> Form -> input('country_id', array('label' => __('País', true), 'class' => 'pais','disabled' => true,'type'=>'text'));
				echo $this -> Form -> input('address', array('label' => 'Dirección', 'type' => 'text', 'disabled' => true));
				echo $this -> Form -> input('zip', array('label' => 'Código Postal', 'disabled' => true));
			} else {
				echo $this -> Form -> hidden('Address.name', array('label' => 'Nombre', 'value' => __('Direccion de Registro', true)));
				if($user) {
					echo $this -> Form -> hidden('Address.user_id', array('value' => $user['User']['id']));
				}
				//debug($countries);
				echo $this -> Form -> input('Address.zone_id', array('label' => __('Zona', true), 'class' => 'barrio','empty'=>__('Seleccione su Zona',true),'required' => 'required'));
				echo $this -> Form -> hidden('Address.city_id');
				echo $this -> Form -> input('Address.city_id_', array('id' => 'AddressCityId_', 'disabled' => 'disabled', 'label' => __('Ciudad', true)));
				echo $this -> Form -> hidden('Address.country_id');
				echo $this -> Form -> input('Address.country_id_', array('id' => 'AddressCountryId_', 'disabled' => 'disabled', 'label' => __('País', true)));
				echo $this -> Form -> input('Address.address', array('label' => 'Dirección', 'type' => 'text', 'required' => 'required'));
				echo $this -> Form -> input('Address.zip', array('label' => 'Código Postal', 'value'=>'57'));
			}
			?>
		</fieldset>
	</div>
	<?php $userScore = $this -> requestAction('/users/getScore'); ?>
	<?php if($userScore > $deal['Deal']['price']): ?>
	<div class="comprar-con-puntos" id="comprar-con-bono" style="visibility: visible;">
		<legend><?php __('Comprar con tu bono'); ?></legend>
		<?php			
			echo $this -> Form -> hidden('User.user_score', array('value' => $userScore));
		?>
		
		<p><?php __('Tienes actualmente'); ?>  <?php echo "$ ".number_format($userScore, 0, ",", "."); ?>  <?php __('acumulados como bono.'); ?></p>
		<p><?php __('¡Puedes actualmente pagar con tu bono!'); ?></p>
		<p><?php __('¿Deseas hacerlo?'); ?></p>
		<?php $redimir=isset($this->params['named']['redimir'])?$this->params['named']['redimir']:0;?>
		<p><?php echo $this -> Form -> input('comprar_con_bono', array('legend'=>false,'type' => 'radio', 'options' => array('0' => 'No', '1' => 'Sí'), 'value' => $redimir)); ?></p>
	</div>
	<?php endif;?>
	<div style="clear:both"></div>
	<div class='terminos'>
		<?php 
			__('Acepto ');
			echo $this->Html->link(__('Los terminos y condiciones',true),array('controller'=>'pages','action'=>'terminosYCondiciones'),array('target'=>'_blank'));
			echo $this -> Form -> checkbox('terminos',array('label'=>false,"required"=>'required'));
		?>
	</div>		
	<?php echo $this -> Form -> end(__('Comprar', true));?>
</div>


<script type="text/javascript">
	$(function() {
		if($("#OrderAddressId").length){
			BJS.JSON('/addresses/getJSON/'+$("#OrderAddressId").val()+"/1",{},function(address){
				$("#OrderZoneId").val(address.Zone.name);
				$("#OrderCityId").val(address.City.name);
				$("#OrderCountryId").val(address.Country.name);
				$("#OrderAddress").val(address.Address.address);
				$("#OrderZip").val(address.Address.zip);
			});
		}
		$("#OrderAddressId").change(function(){
			BJS.JSON('/addresses/getJSON/'+$(this).val()+"/1",{},function(address){
				$("#OrderZoneId").val(address.Zone.name);
				$("#OrderCityId").val(address.City.name);
				$("#OrderCountryId").val(address.Country.name);
				$("#OrderAddress").val(address.Address.address);
				$("#OrderZip").val(address.Address.zip);
			});
		});
		var actualizarDivComprarConPuntos = function() {
			cantidad = $('#OrderQuantity').val();
			precioUnitario = $('#DealPrice').val();
			puntosUsuario = $('#UserUserScore').val();
			if(puntosUsuario >= (cantidad * precioUnitario)) {
				$('.comprar-con-puntos').css('visibility', 'visible');
				return true;
			} else {
				$('.comprar-con-puntos').css('visibility', 'hidden');
				return false;
			}
		}
		
		actualizarDivComprarConPuntos();
		
		$('#OrderQuantity').keyup(function() {			
			if(!actualizarDivComprarConPuntos()) {
				$('#OrderComprarConBono0').prop('checked', true);
			}
		});
		
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
		'[max]'	 	: 'el campo debe ser menor o igual a $1',
		'[min]'		: 'el campo debe ser mayor o igual a $1',
		'[required]'	: 'campo obligatorio',
		'[data-equals]' : 'verifique este campo'
		});
		$('form').validator({'lang':'es'});
		
		/** -------- **/
		
		var cambiarPaisYCiudad = function() {
			if($('#AddressZoneId').val()) {
				BJS.JSON('/zones/getZoneCity/'+$('#AddressZoneId').val(), {}, function(data) {
					$.each(data, function(index, value) {
						$('#AddressCityId').val(index);
						$('#AddressCityId_').val(value);
					});
					BJS.JSON('/cities/getCityCountry/'+$('#AddressCityId').val(), {}, function(data) {
						$.each(data, function(index, value) {
							$('#AddressCountryId').val(index);
							$('#AddressCountryId_').val(value);
						});
					});
				});
				/*BJS.updateSelect($('#AddressCityId'),'/zones/getZoneCity/'+$('#AddressZoneId').val(), function(){
					BJS.updateSelect($('#AddressCountryId'),'/cities/getCityCountry/'+$('#AddressCityId').val());
				});*/
			}
		};
		
		cambiarPaisYCiudad();
		
		$('#AddressZoneId').change(function() {
			cambiarPaisYCiudad();
		});
	});
</script>