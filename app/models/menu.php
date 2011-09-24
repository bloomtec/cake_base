<?php
class Menu extends AppModel {
	var $name = 'Menu';
	var $displayField = 'wysiwyg_title';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Page' => array(
			'className' => 'Page',
			'foreignKey' => 'menu_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
