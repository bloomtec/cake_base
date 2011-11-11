<?php
class Page extends AppModel {
	var $name = 'Page';
	var $displayField = 'name';
	var $wysiwygFields = array('wysiwyg_content');
	
	var $isPicture = false;
	var $sluggable = true;
	var $sortable = false;
	var $activable = true;

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

	var $hasMany = array(
		'PageSlider' => array(
			'className' => 'PageSlider',
			'foreignKey' => 'page_id',
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

	function beforeSave(){
		if($this->sluggable){
			$this->data['Page']['slug'] = strtolower(str_ireplace(" ", "-", $this->data['Page']['name']));
		}
		return true;	
	}
}
