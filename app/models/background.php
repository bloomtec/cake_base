<?php
class Background extends AppModel {
	var $name = 'Background';
	var $displayField = 'name';
	var $order = 'Background.sort asc';
 	var $imagesFields = array('image');
	var $isPicture = false;
	var $sluggable = false;
	var $sortable = true;
	var $activable = true;
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
		'image' => array(
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

	function beforeSave(){
		return true;	
	}
	
}
