<?php
/* Adress Fixture generated on: 2011-11-08 10:05:50 : 1320764750 */
class AdressFixture extends CakeTestFixture {
	var $name = 'Adress';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'adress' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'zip' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'country_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'state_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'city_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'updated' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_addresses_countries_INDEX' => array('column' => 'country_id', 'unique' => 0), 'fk_addresses_cities_INDEX' => array('column' => 'city_id', 'unique' => 0), 'fk_addresses_states_INDEX' => array('column' => 'state_id', 'unique' => 0), 'fk_addresses_users_INDEX' => array('column' => 'user_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'user_id' => 1,
			'adress' => 'Lorem ipsum dolor sit amet',
			'zip' => 'Lorem ipsum dolor sit amet',
			'country_id' => 1,
			'state_id' => 1,
			'city_id' => 1,
			'created' => '2011-11-08 10:05:50',
			'updated' => '2011-11-08 10:05:50'
		),
	);
}
