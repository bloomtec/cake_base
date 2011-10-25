<?php
class GalleryPicture extends AppModel {
	var $name = 'GalleryPicture';
	var $order = 'GalleryPicture.sort asc';
	var $isPicture=true;
	var $sluggable=false;
	var $sortable=true;
	var $activable=false;

	var $validate = array(
		'path' => array(
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
		'Gallery' => array(
			'className' => 'Gallery',
			'foreignKey' => 'gallery_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	function beforeSave(){
		return true;	
	}
}
