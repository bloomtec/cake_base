<?php
class Deal extends AppModel {
	var $name = 'Deal';
	var $displayField = 'name';
 	var $imagesFields = array('image');
	var $isPicture = false;
	var $sluggable = true;
	var $sortable = false;
	var $activable = false;
	var $actsAs = array(
		'Translate' => array('name','description','conditions')
	);
	var $validate = array(
		'restaurant_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Ingrese un nombre para la promo',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
		'visits' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'price' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Indique el valor de la promo',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'normal_price' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Indique el valor que normalmente tiene sin la promo',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'description' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Ingrese una descripción para la promo',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'image' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'amount' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Ingrese una cantidad',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'El valor debe ser un número',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isPositiveAmount' => array(
				'rule' => array('isPositiveAmount'),
				'message' => 'El valor debe ser mayor o igual a 0',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	function isPositiveAmount() {
		if($this -> data['Deal']['amount'] >= 0) {
			return true;
		} else {
			return false;
		}
	}
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Restaurant' => array(
			'className' => 'Restaurant',
			'foreignKey' => 'restaurant_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'deal_id',
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
		'Cuisine' => array(
			'className' => 'Cuisine',
			'joinTable' => 'cuisines_deals',
			'foreignKey' => 'deal_id',
			'associationForeignKey' => 'cuisine_id',
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

	function beforeSave(){
		if($this->sluggable){
			$this->data['Deal']['slug'] =strtolower(str_ireplace(" ", "-", $this->data['Deal']['name']));
			$this->data['Deal']['slug'] =strtolower(str_ireplace("+", "mas", $this->data['Deal']['slug']));
		}
		if($this->data['Deal']['is_promoted'] && empty($this->data['Deal']['image_large'])) {
			return false;
		}
		return true;	
	}
	
	/**
	 * Retornar las promos de una ciudad especifica
	 */
	function getDeals($city_id = null, $zone_id = null, $cuisine_id = null) {
		if($city_id || $zone_id || $cuisine_id) {
			// Si hay definido un tipo de gastronomía, recoger las promos correspondientes a esa gastronomía.
			$deals=array();
			if($cuisine_id) {$deals = $this->CuisineDeal->find('list',array('conditions'=>array('CuisineDeal.cuisine_id'=>$cuisine_id),'fields'=>array('CuisineDeal.deal_id')));}
			// Obtener las zonas de la ciudad
			$zones = array();
			if(!$zone_id) {
				$zones = $this->Restaurant->Zone->getZones($city_id);
			} else {
				$zones = $this->Restaurant->Zone->find('list', array('conditions'=>array('Zone.id'=>$zone_id), 'fields'=>array('Zone.id')));
			}
			// Obtener los restaurantes de la zona
			$restaurants = $this->Restaurant->find('list', array('fields'=>array('Restaurant.id'), 'conditions'=>array('Restaurant.zone_id'=>$zones)));
			// Obtener las promos
			$deals = $this->find('all', array('conditions'=>array('Deal.restaurant_id'=>$restaurants, 'Deal.id'=>$deals)));
			return $deals;
		} else {
			return array();
		}
	}
	
	function subtractAmount($deal_id = null, $amount = null) {
		if($deal_id && $amount) {
			$deal = $this->read(null, $deal_id);
			if(!empty($deal)) {
				$deal['Deal']['amount'] = $deal['Deal']['amount'] - $amount;
				if($deal['Deal']['amount'] >= 0) {
					$this->save($deal);
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	function getAmount($deal_id = null) {
		$deal = $this->read(null, $deal_id);
		if(!empty($deal)) {
			return $deal['Deal']['amount'];
		} else {
			return -1;
		}		
	}
	
}
