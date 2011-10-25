<?php
class BackgroundPicture extends AppModel {
	var $name = 'BackgroundPicture';
	var $displayField = 'name';
	var $order = 'BackgroundPicture.sort asc';
	var $isPicture=true;
	var $sluggable=false;
	var $sortable=true;
	var $activable=false;

	var $validate = array(
		'id' => array(
			'y' => array(
				'rule' => array('y'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Background' => array(
			'className' => 'Background',
			'foreignKey' => 'background_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	function beforeSave(){
		return true;	
	}
}
