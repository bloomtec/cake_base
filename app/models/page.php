<?php
class Page extends AppModel {
	var $name = 'Page';
	var $displayField = 'title';
	var $validate = array(
		'page_type_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'Menu' => array(
			'className' => 'Menu',
			'foreignKey' => 'menu_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PageType' => array(
			'className' => 'PageType',
			'foreignKey' => 'page_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
