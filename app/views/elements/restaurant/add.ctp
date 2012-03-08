<div class="restaurants form2">
	<?php echo $this -> Form -> create('Restaurant');?>
	<fieldset>
		<legend>
			<?php __('Add Restaurant');?>
		</legend>
		<?php
		if($this -> Session -> read('Auth.User.role_id') == 1) {
			echo $this -> Form -> input('country_id', array('options' => $countries, 'div' => 'input select geo'));
			echo $this -> Form -> input('city_id', array('div' => 'input select geo'));
		}
		echo $this -> Form -> input('zone_id', array('div' => 'input select geo'));
		echo $this -> Form -> input('name');
		echo $this -> Form -> input('description');
		echo $this -> Form -> input('service_policies');
		echo $this -> Form -> input('schedule');
		echo $this -> Form -> input('phone');
		echo $this -> Form -> input('address');
		
		// echo $this->Form->input('lat');
		// echo $this->Form->input('long');
		echo $this -> Form -> hidden('image', array('id' => 'single-field'));
		?>
		<div id="zones"></div>
	</fieldset>
	<fieldset>
		<legend>
			<?php __("Restaurant's Owner");?>
		</legend>
		<?php
		echo $this -> Form -> input("Owner.id", array('label' => __('Owner', true), 'type' => 'select', 'empty' => __('Select...', true)));
		echo $this -> Form -> input("Owner.name");
		echo $this -> Form -> input("Owner.last_name");
		echo $this -> Form -> input("Owner.email");
		echo $this -> Form -> input("Owner.password");
		echo $this -> Form -> hidden("Owner.role_id", array('value' => 4));
		echo $this -> Form -> hidden("Owner.email_verified", array('value' => 1));
		echo $this -> Form -> input('Owner.active', array('checked' => true));
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Submit', true));?>
</div>
<div class="images">
	<h2>Image</h2>
	<div class="preview">
		<div class="wrapper">
			<?php echo $this -> Html -> image('preview.png');?>
		</div>
	</div>
	<div id="single-upload" controller="restaurants"></div>
</div>
<script type='text/javascript'>
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
				updateZones();
			});
		}

		function updateCity() {
			updateZones();
		}
		
		function updateZones(){
			//BJS.updateSelect($zone, '/cities/getZones/' + $city.val());
			$("#zones").load("/zones/zonesByCity"+$city.val());
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