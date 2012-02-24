	
<div class="restaurants form2">
<?php echo $this->Form->create('Restaurant');?>
	<fieldset>
		<legend><?php __('Admin Add Restaurant'); ?></legend>
	<?php
		echo $this->Form->input('zone_id',array('div'=>'input select geo'));
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
	<fieldset>
		<legend><?php __("Restaurant's User"); ?></legend>
		<?php 
		echo $this->Form->input("User.name");
		echo $this->Form->input("User.last_name");
		echo $this->Form->input("User.email");
		echo $this->Form->input("User.password");
		echo $this->Form->hidden("User.role_id",array('value'=>4));
		echo $this->Form->hidden("User.email_verified",array('value'=>1));
		echo $this->Form->input('User.active', array('checked'=>true));
		?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="images">
	<h2>Image</h2>
	<div class="preview">
		<div class="wrapper"><?php echo $this->Html->image('preview.png');?></div>
	</div>
	<div id="single-upload" controller="restaurants"></div>		
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