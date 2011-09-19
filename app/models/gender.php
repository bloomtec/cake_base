<?php
class Gender extends AppModel {
	var $name = 'Gender';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasOne = array(
		'UserField' => array(
			'className' => 'UserField',
			'foreignKey' => 'gender_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
