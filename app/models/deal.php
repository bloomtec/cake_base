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
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'amount' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'max_buys' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
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
	);
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
			$this->data['Deal']['slug'] = strtolower(str_ireplace(" ", "-", $this->data['Deal']['name']));
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
	
	function filter($city = null, $zone = null, $cuisine = null, $price) {
		$conditions = array();
		$zones = $deals = null;
		if($city) {
			$zones = $this->Restaurant->Zone->find('list', array('conditions'=>array('Zone.city_id'=>$city), 'fields'=>array('Zone.id')));
		} else {
			$zones = $this->requestAction('/zones/getList');
		}
		if($zone) {
			$zones = $zone;
		}
		if($cuisine) {
			$deals = $this->CuisinesDeal->find('list', array('conditions'=>array('CuisinesDeal.cuisine_id'=>$cuisine), 'fields'=>array('CuisinesDeal.deal_id')));
		} else {
			$deals = $this->requestAction('/deals/getList');
		}
		$restaurants = $this->Restaurant->find('list', array('conditions'=>array('Restaurant.zone_id'=>$zones), 'fields'=>array('Restaurant.id')));
		$other_deals = $this ->find('list', array('conditions'=>array('Deal.restaurant_id'=>$restaurants), 'fields'=>array('Deal.id')));
		$deals = array_merge($deals, $other_deals);
		$conditions['conditions'] = array('Deal.id'=>$deals);
		if($price) {
			$conditions['order']=array('Deal.price'=>$price);
		}
		return $conditions;
	}
	
}
