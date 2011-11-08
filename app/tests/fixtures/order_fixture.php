<?php
/* Order Fixture generated on: 2011-11-08 10:19:31 : 1320765571 */
class OrderFixture extends CakeTestFixture {
	var $name = 'Order';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'code' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'address_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'quantity' => array('type' => 'integer', 'null' => false, 'default' => '1'),
		'deal_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'order_state_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'updated' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_orders_users_INDEX' => array('column' => 'user_id', 'unique' => 0), 'fk_orders_deals_INDEX' => array('column' => 'deal_id', 'unique' => 0), 'fk_orders_address_INDEX' => array('column' => 'address_id', 'unique' => 0), 'fk_orders_order_states_INDEX' => array('column' => 'order_state_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'code' => 'Lorem ipsum dolor sit amet',
			'user_id' => 1,
			'address_id' => 1,
			'quantity' => 1,
			'deal_id' => 1,
			'order_state_id' => 1,
			'created' => '2011-11-08 10:19:31',
			'updated' => '2011-11-08 10:19:31'
		),
	);
}
