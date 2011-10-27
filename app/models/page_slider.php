<?php
class PageSlider extends AppModel {
	var $name = 'PageSlider';
	var $displayField = 'name';
	var $order = 'PageSlider.sort asc';
	var $wysiwygFields = array('wysiwyg_content');
	
	var $isPicture = false;
	var $sluggable = false;
	var $sortable = true;
	var $activable = false;

	var $validate = array(
		'page_id' => array(
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
		'Page' => array(
			'className' => 'Page',
			'foreignKey' => 'page_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	function beforeSave(){
		return true;	
	}
}
