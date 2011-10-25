<?php
class Horario extends AppModel {
	var $name = 'Horario';
	var $displayField = 'name';
	var $order = 'Horario.sort asc';
 	var $imagesFields = array('image');
	var $isPicture=false;
	var $sluggable=false;
	var $sortable=true;
	var $activable=true;

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
	function beforeSave(){
		return true;	
	}
}
