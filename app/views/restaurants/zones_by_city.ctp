<?php 
	if(!isset($restaurant_zones)){
		echo $this -> Form -> input('Zone.Zone', array('label' => __('Barrios con domicilio', true), 'multiple' => 'checkbox','options'=>$zones)); 
	}else{
		echo $this -> Form -> input('Zone.Zone', array('label' => __('Barrios con domicilio', true), 'multiple' => 'checkbox','options'=>$zones,'selected'=>$restaurant_zones)); 
	}
?>