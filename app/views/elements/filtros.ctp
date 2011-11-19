<div class="filtros">
	<?php 
		$selectedCity = (isset($this->params['named'][__('city',true)]) && !empty($this->params['named'][__('city',true)])) ?  $this->params['named'][__('city',true)] : key($cities);

		$selectedZone = (isset($this->params['named'][__('zone',true)]) && !empty($this->params['named'][__('zone',true)])) ?  $this->params['named'][__('zone',true)] : null;
		$selectedCuisine = (isset($this->params['named'][__('cuisine',true)]) && !empty($this->params['named'][__('cuisine',true)])) ?  $this->params['named'][__('cuisine',true)] : null;
		$selectedPrice = (isset($this->params['named'][__('price',true)]) && !empty($this->params['named'][__('price',true)])) ?  $this->params['named'][__('price',true)] : null;
	?>
	<?php echo $this -> Form -> input('city_id',array('options' => $cities,'label' => __('Que hay pa´ comer en:',true),'rel'=>__('city',true), 'selected' => $selectedCity)); ?>
	<?php echo $this -> Form -> input('zone_id',array('options' => $zones,'label' => __('Your Zone:',true),'rel'=>__('zone',true), 'selected' => $selectedZone)); ?>
	<?php echo $this -> Form -> input('cuisine_id',array('options' => $cuisines,'label' => __('Cuisine:',true),'rel'=>__('cuisine',true), 'selected' => $selectedCuisine)); ?>
	<?php echo $this -> Form -> input('price_range',array('options' => $prices,'label' => __('Price:',true),'rel'=>__('price',true), 'selected' => $selectedPrice)); ?>
	
</div>