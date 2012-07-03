<div class="users form datos_perfil" id="register_login">
<?php if(isset($addresses[0])):?>
<h1><?php __('Actualizar Dirección'); ?></h1>	
<?php 
$addressList = array();
	foreach($addresses as $address){
			$addressList[$address['Address']['id']]=$address['Address']['name'];
	} 
?>

<?php echo $this->Form->create('Address',array('action' => 'edit'));?>
	<fieldset>
	
	<?php
		echo $this -> Form -> input('Address.id', array('options' => $addressList, 'label'=>__('Direcciones',true)));
		echo $this -> Form -> hidden('Address.user_id', array('value' => $addresses[0]['Address']['user_id']));
		echo $this -> Form -> input('Address.name', array('label'=>__('Nombre',true), 'required' => 'required', 'value' => $addresses[0]['Address']['name'],'id'=>'name'));
		echo $this -> Form -> input('Address.country_id', array('label'=>__('País',true), 'required' => 'required','options' => $countries, 'selected' => $address['Address']['country_id'],'id'=>'country'));
		echo $this -> Form -> input('Address.city_id', array('label'=>__('Ciudad',true), 'required' => 'required','options' => $cities, 'selected' => $addresses[0]['Address']['city_id'],'id'=>'city'));
		echo $this -> Form -> input('Address.zone_id', array('label'=>__('Zona',true), 'required' => 'required','options' => $zones,'selected'=>$addresses[0]['Address']['zone_id'],'id'=>'zone'));
		echo $this -> Form -> input('Address.address', array('label'=>__('Dirección',true), 'required' => 'required', 'value' => $addresses[0]['Address']['address'],'id'=>'address','type'=>'text'));	
	?>
	</fieldset>
<?php echo $this->Form->end(__('Actualizar', true));?>

<?php endif;?>
<h1><?php __('Agregar Dirección')?></h1>
<?php echo $this->Form->create('Address',array('action' => 'add'));?>
	<fieldset>
	<?php
		echo $this -> Form -> hidden('Address.user_id', array('value' => $userId));
		echo $this -> Form -> input('Address.name', array('label'=>__('Nombre',true), 'required' => 'required'));
		echo $this -> Form -> input('Address.country_id', array('label'=>__('País',true), 'required' => 'required','options' => $countries));
		echo $this -> Form -> input('Address.city_id', array('label'=>__('Ciudad',true), 'required' => 'required','options' => $cities));
		echo $this -> Form -> input('Address.zone_id', array('label'=>__('Zona',true), 'required' => 'required','options' => $zones));
		echo $this -> Form -> input('Address.address', array('label'=>__('Dirección',true), 'required' => 'required','type'=>'text'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Agregar', true));?>
</div>
<script type='text/javascript'>
	$(function(){
		var $countryU = $('#country');
		var $cityU = $('#city');
		var $zoneU = $('#zone');
		
		var $countryAdd = $('#AddressCountryId');
		var $cityAdd = $('#AddressCityId');
		var $zoneAdd = $('#AddressZoneId');
		BJS.JSON("/addresses/getJSON/"+$('#AddressId').val(),{},function(address){
				updateAddress(address);
		});
		$('#AddressId').change(function(){
			BJS.JSON("/addresses/getJSON/"+$(this).val(),{},function(address){
				updateAddress(address);
			});
		});
		
		function updateAddress(address){
			if(address){
				$("#name").val(address.Address.name);			
				$("#country").val(address.Address.country_id);
				BJS.updateSelect($cityU, '/countries/getCities/' + address.Address.country_id, function() {
					$cityU.val(address.Address.city_id);
					BJS.updateSelect($zoneU, '/cities/getZones/' + address.Address.city_id,function(){
						$zoneU.val(address.Address.zone_id);
					});
				});
				$("#address").val(address.Address.address);
			}			
		}
		$countryU.change(function(){
			updateCountry($countryU,$cityU,$zoneU);
		});
		$cityU.change(function(){
			updateCity($cityU,$zoneU);
		});
		
		$countryAdd.change(function(){
			updateCountry($countryAdd,$cityAdd,$zoneAdd);
		});
		$cityAdd.change(function(){
			updateCity($cityAdd,$zoneAdd);
		});
		function updateCountry($country,$city,$zone) {
			BJS.updateSelect($city, '/countries/getCities/' + $country.val(), function() {
				updateZones($city,$zone);
			});
		}

		function updateCity($city,$zone) {
			updateZones($city,$zone);
		}
		
		function updateZones($city,$zone){
			BJS.updateSelect($zone, '/zones/getZones/' + $city.val(),{},function(){
			
			});
			
		}
	});
</script>