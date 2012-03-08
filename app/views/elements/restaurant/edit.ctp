<div class="restaurants form2">
<?php echo $this->Form->create('Restaurant');?>
	<fieldset>
		<legend><?php __('Edit Restaurant'); ?></legend>
	<?php
		echo $this->Form->input('id');
		if($this -> Session -> read('Auth.User.role_id') == 1) {
			echo $this->Form->input('country_id',array('label' => __('Country', true), 'options' => $countries, 'selected'=>$city['City']['country_id']));
			echo $this->Form->input('city_id',array('label' => __('City', true), 'options' => $cities, 'selected'=>$city['City']['id']));
		}
		if($this -> Session -> read('Auth.User.role_id') != 4) {
			echo $this->Form->input('zone_id');
			echo $this->Form->input('name');
		} else {
			echo $this->Form->input('name', array('disabled' => 'disabled'));
		}
		echo $this->Form->input('description');
		echo $this->Form->input('service_policies');
		echo $this->Form->input('schedule');
		echo $this->Form->input('phone');
		echo $this->Form->input('address');
		echo $this -> Form -> input('Zone', array('label' => 'Barrios Con Domicilio', 'multiple' => 'checkbox'));
		// echo $this->Form->input('lat');
		// echo $this->Form->input('long');
		echo $this->Form->hidden('image',array('id' => 'single-field'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="images">
		<h2>Image</h2>
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
				BJS.updateSelect($zone, '/cities/getZones/' + $city.val());
			});
		}

		function updateCity() {
			BJS.updateSelect($zone, '/cities/getZones/' + $city.val());
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