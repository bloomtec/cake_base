	
<div class="restaurants form2">
<?php echo $this->Form->create('Restaurant');?>
	<fieldset>
		<legend><?php __('Admin Add Restaurant'); ?></legend>
	<?php
		echo $this->Form->input('country_id',array('options' => $countries));
		echo $this->Form->input('city_id');
		echo $this->Form->input('zone_id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->hidden('image',array('id' => 'single-field'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="images">
		<h2>Image</h2>
		<div class="preview">
			<div class="wrapper">
					 <?php echo $this->Html->image('preview.png');?>
			</div>
		</div>
		<div id="single-upload" controller="restaurants">
		</div>			
</div>
<script type='text/javascript'>
	$(function(){
		var $country = $('#RestaurantCountryId');
		var $city = $('#RestaurantCityId');
		var $zone = $('#RestaurantZoneId');
		updateCountry();
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