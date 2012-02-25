<div class="restaurants form2">
<?php echo $this->Form->create('Restaurant');?>
	<fieldset>
		<legend><?php __('Edit Restaurant'); ?></legend>
	<?php
		echo $this->Form->input('id');
		if($this -> Session -> read('Auth.User.role_id') == 1) {
			echo $this->Form->input('country_id',array('options' => $countries, 'selected'=>$city['City']['country_id']));
			echo $this->Form->input('city_id',array('options' => $cities, 'selected'=>$city['City']['id']));
		}
		echo $this->Form->input('zone_id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('service_policies');
		echo $this->Form->input('schedule');
		echo $this->Form->input('phone');
		echo $this->Form->input('address');
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
	$(function(){
		var $country = $('#RestaurantCountryId');
		var $city = $('#RestaurantCityId');
		var $zone = $('#RestaurantZoneId');
		$country.change(function(){
			updateCountry();
		});
		$city.change(function(){
			updateCity();
		});
		
		function updateCountry(){
			BJS.updateSelect($city, '/countries/getCities/'+$country.val(),function(){
				BJS.updateSelect($zone, '/cities/getZones/'+$city.val());
			});
		}
		
		function updateCity(){
			BJS.updateSelect($zone, '/cities/getZones/'+$city.val());
		}
		
	});
</script>