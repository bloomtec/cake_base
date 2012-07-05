<div class="zones form2">
<?php echo $this->Form->create('Zone');?>
	<fieldset>
		<legend><?php __('Agregar Barrio'); ?></legend>
	<?php
		echo $this->Form->input('country_id',array('label' => __('País', true), 'options' => $countries));
		echo $this->Form->input('city_id', array('label' => __('Ciudad', true), ));
		echo $this->Form->input('name', array('label' => __('Nombre', true)));
		echo $this->Form->input('description', array('label' => __('Descripción', true)));
		echo $this->Form->hidden('image',array('id' => 'single-field'));
		//echo $this->Form->input('lat');
		//echo $this->Form->input('long');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Enviar', true));?>
</div>

<div class="images">
		<h2><?php __('Imagen'); ?></h2>
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