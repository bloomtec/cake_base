<?php
class Page extends AppModel {
	var $name = 'Page';
	var $displayField = 'name';
	var $wysiwygFields = array('wysiwyg_content');
	
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
	function beforeSave(){
		if($this->sluggable){
			$this->data['Page']['slug'] = strtolower(str_ireplace(" ", "-", $this->data['Page']['name']));
		}
		return true;	
	}
}
