<style>
	.submit input{
		color:black;
	}
</style>
<div class="filtros default">
	<?php
		$selectedCity=null;
		$cities=$this -> requestAction('/deals/getCities');
		echo $this -> Form -> input('city_id', array('options' => $cities, 'label' => __('Qué hay para comer en:', true), 'rel' => 'city', 'selected' => $selectedCity));
		echo $this -> Form -> input('zone_id', array('options' => array(), 'label' => __('Barrio:', true), 'rel' => 'zone'));
		echo $this -> Form -> input('cuisine_id', array('options' => array(), 'label' => __('Cocina:', true), 'rel' => 'cuisine'));
		echo $this -> Form -> input('price_range', array('options' => array(), 'label' => __('Rango De Precio:', true), 'rel' => 'price'));
		echo $this -> Form -> submit(__('Buscar', true));
	?>
</div>
<script type='text/javascript'>
	$(function() {
		cityFunctionality();
		$('.filtros.default select[id="city_id"]').change(function() {
			cityFunctionality();
		});
		$('.filtros.default select[id="zone_id"]').change(function() {
			BJS.updateSelect($('#cuisine_id'),"/deals/filterDataCuisines/"+$('#zone_id').val());
		});
		function cityFunctionality(){
			BJS.updateSelect($('#zone_id'),"/deals/filterDataZones/"+$('#city_id').val(),function(){
				BJS.updateSelect($('#cuisine_id'),"/deals/filterDataCuisines/"+$('#zone_id').val());
			});
			BJS.updateSelect($('#price_range'),"/deals/filterDataPrices/"+$('#city_id').val());
		}
		$('.submit').click(function(){
		 	var url="city:"+$("#city_id").val()+"/zone:"+$("#zone_id").val()+"/cuisine:"+$("#cuisine_id").val()+"/price:"+$("#price_range").val();
		 		document.location = "/"+url;
		});
	});

</script>