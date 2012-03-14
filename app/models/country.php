<?php
class Country extends AppModel {
	var $name = 'Country';
	var $displayField = 'name';
 	var $imagesFields = array('image');
	var $isPicture = false;
	var $sluggable = false;
	var $sortable = false;
	var $activable = false;
	var $actsAs = array(
		'Translate' => array('name','description')
	);
	var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'money_symbol' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'price_ranges' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter price ranges for this country',
				//'allowEmpty' => false,
				//'required' => false,
				'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'priceRangeFormat' => array(
				'rule' => array('priceRangeFormat'),
				'message' => 'Current price range format is invalid',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Address' => array(
			'className' => 'Address',
			'foreignKey' => 'country_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'City' => array(
			'className' => 'City',
			'foreignKey' => 'country_id',
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
	
	function priceRangeFormat() {
		$validFormat = true;
		$price_ranges = $this -> data['Country']['price_ranges'];
		$price_ranges = explode(':', $price_ranges);
		if(count($price_ranges) < 1) return false;
		foreach($price_ranges as $key => $price_range) {
			$price_range = explode('-', $price_range);
			if(count($price_range) != 2) return false;
		}
		return $validFormat;
	}

	function beforeSave(){
		return true;	
	}
}
