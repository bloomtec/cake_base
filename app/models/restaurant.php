<?php
class Restaurant extends AppModel {
	var $name = 'Restaurant';
	var $displayField = 'name';
 	var $imagesFields = array('image');
	var $isPicture = false;
	var $sluggable = false;
	var $sortable = false;
	var $activable = false;
	var $actsAs = array(
		'Translate' => array('name','description','address','schedule')
	);

	var $validate = array(
		
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe ingresar un nombre para el restaurante',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'service_policies' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe ingresar un nombre para el restaurante',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'image' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe subir una imágen para el restaurante',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'address' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe ingresarle dirección al restaurante',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'phone' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe ingresarle teléfono al restaurante',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Zone' => array(
			'className' => 'Zone',
			'foreignKey' => 'zone_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Owner' => array(
			'className' => 'User',
			'foreignKey' => 'owner_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Deal' => array(
			'className' => 'Deal',
			'foreignKey' => 'restaurant_id',
			'dependent' => true,
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
	
	var $hasAndBelongsToMany = array(
		'Zone' => array(
			'className' => 'Zone',
			'joinTable' => 'restaurants_zones',
			'foreignKey' => 'restaurant_id',
			'associationForeignKey' => 'zone_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}