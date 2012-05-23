<style>
	.submit input{
		color:black;
	}
	.filtros .select{
		
	}
	.filtros .select select{
		width:130px;
		margin-right: 15px;
		padding-left:3px;
	}
	#city_id, #price_range{
		width:105px;
	}
</style>
<div class="filtros default">
	<?php
		$filterData = $session -> read('filterData');
		$selectedCity=null;
		$cities=$this -> requestAction('/deals/filterDataCities');
		if($filterData) {
			$filterData = explode(';', $filterData);
			$city = $filterData[0];
			$zone = $filterData[1];
			$cuisine = $filterData[2];
			$price = $filterData[3];
			$zones = $this -> requestAction('/deals/filterDataZonesRA/' . $city);
			$cuisines = $this -> requestAction('/deals/filterDataCuisinesRA/' . $city . '/' . $zone);
			$prices = $this -> requestAction('/deals/filterDataPricesRA/' . $city);
			echo $this -> Form -> input('city_id', array('options' => $cities, 'value' => $city, 'label' => __('Qué hay para comer en:', true), 'rel' => 'city', 'selected' => $selectedCity));
			echo $this -> Form -> input('zone_id', array('options' => $zones, 'value' => $zone, 'label' => __('Zona:', true), 'rel' => 'zone'));
			echo $this -> Form -> input('cuisine_id', array('options' => $cuisines, 'value' => $cuisine, 'label' => __('Cocina:', true), 'rel' => 'cuisine'));
			echo $this -> Form -> input('price_range', array('options' => $prices, 'value' => $price, 'label' => __('Rango De Precio:', true), 'rel' => 'price'));
		} else {
			$zones = $this -> requestAction('/deals/filterDataZonesRA');
			$cuisines = $this -> requestAction('/deals/filterDataCuisinesRA');
			$prices = $this -> requestAction('/deals/filterDataPricesRA');
			echo $this -> Form -> input('city_id', array('options' => $cities, 'label' => __('Qué hay para comer en:', true), 'rel' => 'city', 'selected' => $selectedCity));
			echo $this -> Form -> input('zone_id', array('options' => $zones, 'label' => __('Zona:', true), 'rel' => 'zone'));
			echo $this -> Form -> input('cuisine_id', array('options' => $cuisines, 'label' => __('Cocina:', true), 'rel' => 'cuisine'));
			echo $this -> Form -> input('price_range', array('options' => $prices, 'label' => __('Rango De Precio:', true), 'rel' => 'price'));
		}
		echo $this -> Form -> submit(__('Buscar', true),array('class'=>'buscar'));
	?>
</div>
<script type='text/javascript'>
	$(function() {
		/* leer los campos de la busqueda en la URL, etc */
		/*Object.size = function(obj) {
			var size = 0, key;
			for (key in obj) {
				if (obj.hasOwnProperty(key)) size++;
			}
			return size;
		};
		var path = document.location.pathname;
		path = path.substring(1);
		path = path.split('/');
		var pathSize = Object.size(path);
		if(pathSize == 4) {
			// coincide con tener 4 datos, buscar si son los de la busqueda
			$.each(path, function(index, value) {
				path[index] = value.split(':');
			});
			var city = -1, zone = -1, cuisine = -1, price = -1;
			$.each(path, function(index, value) {
				if(value[0] == 'city') {
					city = value[1];
				}
				if(value[0] == 'zone') {
					zone = value[1];
				}
				if(value[0] == 'cuisine') {
					cuisine = value[1];
				}
				if(value[0] == 'price') {
					price = value[1];
				}
			});
			if(city >= 0 && zone >= 0 && cuisine >= 0 && price != -1) {
				// los campos estan bn, proceder a seleccionar los selects.
				$('#city_id').val(city);
				cityFunctionality();
				if(zone > 0) {
					$('#zone_id').val(zone);
					BJS.updateSelect($('#cuisine_id'),"/deals/filterDataCuisines/"+$('#city_id').val()+"/"+$('#zone_id').val());
				}
				if(cuisine > 0) {
					$("#cuisine_id").val(cuisine);
				}
				if(price != -1) {
					$("#price_range").val(price);
				}
			} else {
				cityFunctionality();
			}
		} else {
			cityFunctionality();
		}*/
		
		/* funcionalidad de siempre */
		//cityFunctionality();
		$('.filtros.default select[id="city_id"]').change(function() {
			cityFunctionality();
		});
		$('.filtros.default select[id="zone_id"]').change(function() {
			BJS.updateSelect($('#cuisine_id'),"/deals/filterDataCuisines/"+$('#city_id').val()+"/"+$('#zone_id').val());
		});
		function cityFunctionality(){
			BJS.updateSelect($('#zone_id'),"/deals/filterDataZones/"+$('#city_id').val(),function(){
				BJS.updateSelect($('#cuisine_id'),"/deals/filterDataCuisines/"+$('#city_id').val()+"/"+$('#zone_id').val());
			});
			BJS.updateSelect($('#price_range'),"/deals/filterDataPrices/"+$('#city_id').val());
		}
		$('input.buscar').click(function(){
		 	var url="city:"+$("#city_id").val()+"/zone:"+$("#zone_id").val()+"/cuisine:"+$("#cuisine_id").val()+"/price:"+$("#price_range").val();
		 		document.location = "/"+url;
		});
	});

</script>