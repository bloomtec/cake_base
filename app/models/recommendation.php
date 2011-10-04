<?php
class Recommendation extends AppModel {
	var $name = 'Recommendation';
	var $displayField = 'id';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'ProductA' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ProductB' => array(
			'className' => 'Product',
			'foreignKey' => 'recommended_product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
