<?php
/* User Fixture generated on: 2011-11-08 10:15:43 : 1320765343 */
class UserFixture extends CakeTestFixture {
	var $name = 'User';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 40, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'role_id' => array('type' => 'integer', 'null' => false, 'default' => '2', 'key' => 'index'),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'city_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'phone' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'updated' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'email_UNIQUE' => array('column' => 'email', 'unique' => 1), 'fk_users_roles_INDEX' => array('column' => 'role_id', 'unique' => 0), 'fk_users_cities_INDEX' => array('column' => 'city_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'email' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'role_id' => 1,
			'active' => 1,
			'city_id' => 1,
			'phone' => 'Lorem ipsum dolor ',
			'created' => '2011-11-08 10:15:43',
			'updated' => '2011-11-08 10:15:43'
		),
	);
}
