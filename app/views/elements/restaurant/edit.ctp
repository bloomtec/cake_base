<div class="restaurants form2">
<?php echo $this->Form->create('Restaurant');?>
	<fieldset>
		<legend><?php __('Editar Restaurante'); ?></legend>
	<?php
		echo $this->Form->input('id');
		if($this -> Session -> read('Auth.User.role_id') == 1) {
			echo $this->Form->input('country_id',array('label' => __('País', true), 'options' => $countries, 'selected'=>$city['City']['country_id'], 'div' => 'input select geo'));
			echo $this->Form->input('city_id',array('label' => __('Ciudad', true), 'options' => $cities, 'val'=>$city['City']['id'], 'div' => 'input select geo','type'=>'select'));
		}
		if($this -> Session -> read('Auth.User.role_id') != 4) {
			echo $this -> Form -> input('zone_id', array('label' => __('Barrio', true), 'div' => 'input select geo','val'=>$this->data['Restaurant']['zone_id']));
			echo $this->Form->input('name', array('label' => __('Nombre', true)));
		} else {
			echo $this->Form->input('name', array('label' => __('Nombre', true), 'disabled' => 'disabled'));
		}
		echo $this->Form->input('description', array('label' => __('Descripción', true)));
		echo $this->Form->input('service_policies', array('label' => __('Áreas de cobertura', true)));
		echo $this->Form->input('schedule', array('label' => __('Horario', true)));
		echo $this->Form->input('phone', array('label' => __('Teléfono', true)));
		echo $this->Form->input('address', array('label' => __('Dirección', true)));
		echo '<div class="zones-by-city"></div>';
		echo $this->Form->input('lat', array('label' => __('Latitud', true)));
		echo $this->Form->input('long', array('label' => __('Longitud', true)));
		echo $this->Form->hidden('image',array('id' => 'single-field'));
	?>
	<div id="zones"></div>
	</fieldset>
<?php echo $this->Form->end(__('Enviar', true));?>
</div>
<div class="images">
		<h2><?php __('Imagen'); ?></h2>
		<div class="preview">
			<div class="wrapper">
				 <?php
				 	if(!empty($this -> data['Restaurant']['image'])) {
				 		echo $this->Html->image('/img/uploads/'.$this -> data['Restaurant']['image']);
				 	} else {
				 		echo $this->Html->image('preview.png');
				 	}					 	
				 ?>
			</div>
		</div>
		<div id="single-upload" controller="restaurants">
		</div>			
</div>
<script type="text/javascript">
	$(function() {
		var $country = $('#RestaurantCountryId');
		var $city = $('#RestaurantCityId');
		var $zone = $('#RestaurantZoneId');
		updateCountry();
		
		$country.change(function() {
			updateCountry();
		});
		$city.change(function() {
			updateCity();
		});
		function updateCountry() {
			BJS.updateSelect($city, '/countries/getCities/' + $country.val(), function() {
				$city.val($city.attr('val'));
				updateZones();
			});
		}

		function updateCity() {
			updateZones();
		}
		
		function updateZones(){
			BJS.updateSelect($zone, '/cities/getZones/' + $city.val(),function(){
				$zone.val($zone.attr('val'));
			});
			$("#zones").load("/restaurants/zonesByCity/"+$city.val()+"/"+$("#RestaurantId").val());
		}
		/*
		 * --------------------------------------------
		 */
		var $owner = $('#OwnerId');
		updateOwner();
		function updateOwner() {
			BJS.updateSelect($owner, '/users/getOwners');
		}
		
		$owner.change(function() {
			if($owner.val() == '') {
				camposUsuario(true);
			} else {
				camposUsuario(false);
			}
		});
		
		function camposUsuario(habilitar) {
			if(habilitar) {
				$('#OwnerName').removeAttr('disabled');
				$('#OwnerLastName').removeAttr('disabled');
				$('#OwnerEmail').removeAttr('disabled');
				$('#OwnerPassword').removeAttr('disabled');
				$('#OwnerActive').removeAttr('disabled');
				$('#OwnerActive_').removeAttr('disabled');
				$('#OwnerEmailVerified').removeAttr('disabled');
				$('#OwnerRoleId').removeAttr('disabled');
			} else {
				$('#OwnerName').attr('disabled', 'disabled');
				$('#OwnerLastName').attr('disabled', 'disabled');
				$('#OwnerEmail').attr('disabled', 'disabled');
				$('#OwnerPassword').attr('disabled', 'disabled');
				$('#OwnerActive').attr('disabled', 'disabled');
				$('#OwnerActive_').attr('disabled', 'disabled');
				$('#OwnerEmailVerified').attr('disabled', 'disabled');
				$('#OwnerRoleId').attr('disabled', 'disabled');
			}
		}
		
	});
</script>