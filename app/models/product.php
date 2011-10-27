<?php
class Product extends AppModel {
	var $name = 'Product';
	var $displayField = 'name';
 	var $imagesFields = array('image');
	var $isPicture = false;
	var $sluggable = true;
	var $sortable = false;
	var $activable = true;

	function beforeSave(){
		if($this->sluggable){
			$this->data['Product']['slug'] = strtolower(str_ireplace(" ", "-", $this->data['Product']['name']));
		}
		return true;	
	}
}
