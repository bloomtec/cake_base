<div class="zones form2">
<?php echo $this->Form->create('Zone');?>
	<fieldset>
		<legend><?php __('Admin Add Zone'); ?></legend>
	<?php
		echo $this->Form->input('country_id',array('options' => $countries));
		echo $this->Form->input('city_id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->hidden('image',array('id' => 'single-field'));
		//echo $this->Form->input('lat');
		/echo $this->Form->input('long');
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
		<div id="single-upload" controller="zones">
		</div>			
</div>
<script type='text/javascript'>
	$(function(){
		var $country = $('#ZoneCountryId');
		var $city = $('#ZoneCityId');
		updateCountry();
		$country.change(function(){
			updateCountry();
		});
				
		function updateCountry(){
			BJS.updateSelect($city, '/countries/getCities/'+$country.val());
		}
		
		
	});
</script>