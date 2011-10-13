<?php
class Page extends AppModel {
	var $name = 'Page';
	var $displayField = 'name';
	var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array(
					'notempty'
				),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isUnique' => array(
				'rule' => array(
					'isUnique'
				),
				'message' => 'The name you entered is already created',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
	);
	function beforeSave(){
		$this->data['Page']['slug']=strtolower(str_ireplace(" ", "-", $this->data['Page']['name']));
		return true;
	}
}