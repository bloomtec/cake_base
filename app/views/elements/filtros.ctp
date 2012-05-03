<div class="filtros home">
	<?php
		if (isset($cities) && !empty($cities)) {
			$selectedCity = (isset($this -> params['named']['city']) && !empty($this -> params['named']['city'])) ? $this -> params['named']['city'] : key($cities);
			$selectedZone = (isset($this -> params['named']['zone']) && !empty($this -> params['named']['zone'])) ? $this -> params['named']['zone'] : null;
			$selectedCuisine = (isset($this -> params['named']['cuisine']) && !empty($this -> params['named']['cuisine'])) ? $this -> params['named']['cuisine'] : null;
			$selectedPrice = (isset($this -> params['named']['price']) && !empty($this -> params['named']['price'])) ? $this -> params['named']['price'] : null;
	
			echo $this -> Form -> input('city_id', array('options' => $cities, 'label' => __('Qué hay para comer en:', true), 'rel' => 'city', 'selected' => $selectedCity));
			echo $this -> Form -> input('zone_id', array('options' => $zones, 'label' => __('Barrio:', true), 'rel' => 'zone', 'selected' => $selectedZone));
			echo $this -> Form -> input('cuisine_id', array('options' => $cuisines, 'label' => __('Cocina:', true), 'rel' => 'cuisine', 'selected' => $selectedCuisine));
			echo $this -> Form -> input('price_range', array('options' => $prices, 'label' => __('Rango De Precio:', true), 'rel' => 'price', 'selected' => $selectedPrice));
		}
	?>
</div>