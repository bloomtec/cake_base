<?php
class Brand extends AppModel {
	var $name = 'Brand';
	var $displayField = 'name';
	var $order = 'Brand.sort asc';
 	var $imagesFields = array('image');
	var $isPicture = false;
	var $sluggable = false;
	var $sortable = true;
	var $activable = false;

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'brand_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	function beforeSave(){
		return true;	
	}
}
