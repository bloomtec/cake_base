<?php
class Challenge extends AppModel {
	var $name = 'Challenge';
	var $displayField = 'title';
	var $validate = array(
		'challenge_status_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'team_challenger_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'team_challenged_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_challenger_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'place' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'title' => array(
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
		'ChallengeStatus' => array(
			'className' => 'ChallengeStatus',
			'foreignKey' => 'challenge_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'TeamChallenger' => array(
			'className' => 'Team',
			'foreignKey' => 'team_challenger_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'TeamChallenged' => array(
			'className' => 'Team',
			'foreignKey' => 'team_challenged_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'UserChallenger' => array(
			'className' => 'User',
			'foreignKey' => 'user_challenger_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'UserDecided' => array(
			'className' => 'User',
			'foreignKey' => 'user_decided_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
