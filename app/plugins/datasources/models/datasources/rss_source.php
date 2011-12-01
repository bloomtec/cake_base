<?php
/**
 * RSS Feed Datasource
 *
 * Helps reading RSS feeds in CakePHP as if it were a model.
 *
 * PHP versions 4 and 5
 *
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2009, Loadsys Consulting, Inc. (http://www.loadsys.com)
 * @version       $1.0$
 * @modifiedby    $LastChangedBy: Donatas Kairys (Loadsys) $
 * @lastmodified  $Date: 2009-06-01$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

App::import('Core',  'Xml');

class RssSource extends DataSource {
/**
 * Default configuration.
 *
 * @var array
 * @access private
 */
	var $_baseConfig = array(
		'url' => false,
		'encoding' => null,
		'cache' => 'default',
		'version' => '2.0'
	);
/**
 * Fields that have dates in them.
 *
 * @var array
 * @access protected
 */
	var $_dateFields = array('lastBuildDate', 'pubDate');
/**
 * Constructor
 *
 * @param string $config Configuration array
 * @param boolean $autoConnect Automatically connect to / open the file
 * @access public
 */
	function __construct($config = null, $autoConnect = true) {
		parent::__construct($config, $autoConnect);
		if (empty($this->config['encoding'])) {
			$this->config['encoding'] = Configure::read('App.encoding');
		}
		if ($autoConnect) {
			$this->connect();
		}
	}
/**
 * Connects to the mailbox using options in the given configuration array.
 *
 * @return boolean True if the file could be opened.
 * @access public
 */
	function connect() {
		$this->connected = true;
		$this->connection =& new Xml(null, array(
			'version' => $this->config['version'],
			'encoding' => $this->config['encoding']
		));
		return $this->connected;
	}
/**
 * Close file handle
 *
 * @return null
 * @access public
 */
	function close() {
		if ($this->connected) {
			unset($this->connection);
			$this->connected = false;
		}
	}
/**
 * Returns true if the DataSource supports the given interface (method)
 *
 * @param string $interface The name of the interface (method)
 * @return boolean True on success
 * @access public
 */
	function isInterfaceSupported($interface) {
		if (in_array($interface, array('listSources'))) {
			return false;
		}
		return parent::isInterfaceSupported($interface);
	}
/**
 * Returns a Model description (metadata) or null if none found.
 *
 * @return mixed
 * @access public
 */
	function describe($model) {
		return array();
	}
/**
 * Read Data
 *
 * @param Model $model
 * @param array $queryData
 * @return mixed
 */
	function read(&$model, $queryData = array()) {
		$url = !empty($queryData['url']) ? $queryData['url'] : $this->config['url'];
		$data = $this->_fetch($url);
		if (empty($data) || empty($data['Rss']) || empty($data['Rss']['Channel'])) {
			return false;
		}

		$channel = array_diff_key($data['Rss']['Channel'], array('Item'=>null));
		$items = !empty($data['Rss']['Channel']['Item']) ? $data['Rss']['Channel']['Item'] : array();

		if (!empty($items)) {
			$items = $this->_filter($items, $queryData['conditions']);
			$items = $this->_sort($model, $items, $queryData['order']);
			if (!empty($queryData['limit'])) {
				$limit = $queryData['limit'];
				$page = $queryData['page'];
				$offset = $limit * ($page-1);
				$items = array_slice($items, $offset, $limit);
			}
		}

		if ($model->findQueryType == 'count') {
			return array(array(array('count' => count($items))));
		}

		$result = array();
		foreach($items as $item) {
			$result[] = array(
				$model->alias => $item,
				'Channel' => $channel
			);
		}

		return $result;
	}
/**
 * Fetches feed contents
 *
 * @param string $url Feed URL
 * @return array Data
 * @access protected
 */
	function _fetch($url) {
		$data = false;
		if (!empty($this->config['cache'])) {
			$cacheKey = 'rss_'.md5($url);
			$data = Cache::read($cacheKey, $this->config['cache']);
		}

		if ($data === false) {
			if ($this->connected) {
				$this->close();
			}
			$this->connect();
			if (!$this->connected || !$this->connection->load($url)) {
				return false;
			}

			$data = Set::reverse($this->connection->toArray());
			if (!empty($this->config['cache'])) {
				Cache::write($cacheKey, serialize($data), $this->config['cache']);
			}
		} else {
			$data = unserialize($data);
		}
		return $data;
	}

/**
 * Private helper method to check conditions.
 *
 * @param array $record
 * @param array $conditions
 * @return bool
 * @access protected
 */
	function _filter($items, $conditions = null) {
		foreach($items as $i => $item) {
			foreach($item as $field => $value) {
				if (in_array($field, $this->_dateFields)) {
					$item[$field] = strtotime($value);
				}
			}
			foreach ($conditions as $name => $value) {
				$matches = false;
				if (strtolower($name) === 'or') {
					$condition = $value;
					foreach ($condition as $name => $value) {
						if (Set::matches($this->__rule($name, $value), $item)) {
							$matches = true;
							break;
						}
					}
				} elseif (Set::matches($this->_rule($name, $value), $item)) {
					$matches = true;
				}

				if (!$matches) {
					unset($items[$i]);
				}
			}
		}
		return array_values($items);
	}
/**
 * Helper method to crete rule.
 *
 * @param string $name
 * @param string $value
 * @return array
 * @access protected
 */
	function _rule($name, $value) {
		$name = preg_replace('/\s+/', '', $name);
		$field = preg_match('/[<>!=]+/', $name) ? preg_replace('/[<>!=]+/', '', $name) : $name;
		if (in_array($field, $this->_dateFields)) {
			$value = strtotime($value);
		}

		$condition = "{$name}={$value}";
		if (preg_match('/[<>!=]+/', $name)) {
			$condition = $name . $value;
		}
		return (array) $condition;
	}
/**
 * Sort items
 *
 * @param Model $model Model
 * @param array $items Items
 * @param array $order Order
 * @return array Items
 * @access protected
 */
	function _sort(&$model, $items, $order) {
		if (empty($order) || empty($order[0])) {
			return $items;
		}

		$sorting = array();
		foreach ($order as $orderItem ) {
			if (is_string($orderItem) ) {
				$field = $orderItem;
				$direction = 'asc';
			} else {
				$direction = end($orderItem);
				$field = key($orderItem);
			}

			$field = str_replace($model->alias.'.', '', $field);
			$values =  Set::extract($items, '/'.$field);
			if (in_array($field, $this->_dateFields)) {
				foreach($values as $i => $value) {
					$values[$i] = strtotime($value);
				}
			}

			$sorting[] = $values;
			switch(strtolower($direction)) {
				case 'asc':
					$direction = SORT_ASC;
					break;
				case 'desc':
					$direction = SORT_DESC;
					break;
				default:
					trigger_error('Invalid sorting direction '. Model($direction));
			}
			$sorting[] = $direction;
		}

		$sorting[] = &$items;
		$sorting[] = $direction;
		call_user_func_array('array_multisort', $sorting);
		return $items;
	}
/**
 * Calculate
 *
 * @param Model $model
 * @param mixed $func
 * @param array $params
 * @return array
 * @access public
 */
	function calculate(&$model, $func, $params = array()) {
		return array('count' => true);
	}
}

?>