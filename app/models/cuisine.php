<?php
class Cuisine extends AppModel {
	var $name = 'Cuisine';
	var $displayField = 'name';
 	var $imagesFields = array('image');
	var $isPicture = false;
	var $sluggable = true;
	var $sortable = false;
	var $activable = false;

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
		'slug' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasAndBelongsToMany = array(
		'Deal' => array(
			'className' => 'Deal',
			'joinTable' => 'cuisines_deals',
			'foreignKey' => 'cuisine_id',
			'associationForeignKey' => 'deal_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

	function beforeSave(){
		if($this->sluggable){
			$this->data['Cuisine']['slug'] = strtolower(str_ireplace(" ", "-", $this->data['Cuisine']['name']));
		}
		return true;	
	}
}
