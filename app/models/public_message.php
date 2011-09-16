<?php
class PublicMessage extends AppModel {
	var $name = 'PublicMessage';
	var $displayField = 'subject';
	var $validate = array(
		'to_user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'from_user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'subject' => array(
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

	var $belongsTo = array(
		'ToUser' => array(
			'className' => 'User',
			'foreignKey' => 'to_user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'FromUser' => array(
			'className' => 'User',
			'foreignKey' => 'from_user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
