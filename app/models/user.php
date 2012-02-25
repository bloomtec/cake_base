<?php
class User extends AppModel {
	var $name = 'User';
	var $displayField = 'email';
	var $isPicture = false;
	var $sluggable = false;
	var $sortable = false;
	var $activable = false;

	var $validate = array(
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'enter an email',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'the email is already registered',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'enter an email',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'enter a password',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'role_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'active' => array(
			'boolean' => array(
				'rule' => array('boolean'),
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
		'Role' => array(
			'className' => 'Role',
			'foreignKey' => 'role_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'City' => array(
			'className' => 'City',
			'foreignKey' => 'city_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Address' => array(
			'className' => 'Address',
			'foreignKey' => 'user_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'user_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Restaurant' => array(
			'className' => 'Restaurant',
			'foreignKey' => 'owner_id',
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
	
	function user_registered($id = null) { $this -> addScore($id, 'score_by_registering'); }
	
	function user_bought($id = null) { $this -> addScore($id, 'score_for_buying'); }
	
	function user_invited($id = null) { $this -> addScore($id, 'score_by_invitations'); }
	
	function addScore($id = null,$reason = null) {
		App::import('model','Config');
		$Config = new Config();
		$config = $Config -> read(null,1);
		$user = $this -> read(null,$id);
		$return = false;
		switch ($reason) {
			case 'score_by_registering':
			case 'score_for_buying':
				$this -> recursive = -1;
				$user['User']['score'] += $config['Config'][$reason];
				$return = $this -> save($user);
				break;
			case 'score_by_invitations':
				if($user['User']['score_by_invitations'] < $config['Config']['max_score_by_invitations']){
					$user['User']['score'] += $config['Config'][$reason];
					$user['User']['score_by_invitations'] += $config['Config'][$reason];
					$return = $this -> save($user);
				}else{
					$return = false;	
				}
				break;
			default:
				break;
		}
		return $return;
	}
	
	function redeemScore($deal_id = null) {
		
	}
	
}
