<?php
class TagSlider extends AppModel {
	var $name = 'TagSlider';
	var $displayField = 'name';
	var $order = 'TagSlider.sort asc';
	var $wysiwygFields = array('wysiwyg_content');
	
	var $isPicture = false;
	var $sluggable = false;
	var $sortable = true;
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
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Tag' => array(
			'className' => 'Tag',
			'foreignKey' => 'tag_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	function beforeSave(){
		return true;	
	}
}
