<?php
class MakePcController extends AppController {

	var $name = 'MakePc';
	var $uses = array('Product');
	
	private $myPC = array(
		'Processor' => array(),
		'Motherboard' => array(),
		'Memory' => array(),
		'HardDrive' => array(),
		'VideoCard' => array(),
		'Casing' => array(),
		'PowerSupply' => array(),
		'Monitor' => array(),
		'Peripherals' => array(),
		'Cards' => array(),
		'Accesories' => array(),
		'Mouse' => array(),
		'Keyboard' => array()
	);
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(
			'getCasings', 'getPowerSupplies', 'getOpticalDrives', 'getHardDrives', 'getMemories',
			'isVideoIncluded', 'getMotherBoards', 'getProcessors','getSocketsByArchitecture',
			'featuredProduct','searchResults', 'getMonitors', 'getPeripherals', 'getOtherCards',
			'getAccesories', 'getOthers', 'getMyPC', 'setMyPC'
		);
	}
	
	function getMyPC() {
		$myPC = $this->Session->read('myPC', $this->myPC);
		if(empty($myPC)) {
			$this->Session->write('myPC', $this->myPC);
		}
		return $this->Session->read('myPC');
	}
	
	function setMyPC($myPC = null) {
		$this->Session->write('myPC', $myPC);
	}
	
	function myPCAddItem($product_type = null, $product_id = null, $position = null) {
		$this->layout="ajax";
		$this->Product->Behaviors->attach('Containable');
		$this->Product->contain(array('Slot', 'Socket', 'Architecture'));
		$product = $this->Product->read(null, $product_id);
		$product['Slot'] = Set::combine($product['Slot'], '{n}.id', '{n}');
		$myPC = $this->getMyPC();
		switch($product_type) {
			case 'HardDrive':
			case 'Monitor':
				$myPC["$product_type"]["$position"] = $product;
				break;
			case 'VideoCard':
			case 'Memory':
				if($position == 1) {
					$myPC["$product_type"]["$position"] = $product;
					if(isset($myPC["$product_type"][2])) {
						unset($myPC["$product_type"][2]);
					}
				} else {
					$myPC["$product_type"]["$position"] = $product;
					if(isset($myPC["$product_type"][1])) {
						unset($myPC["$product_type"][1]);
					}
				}
				break;
			default:
				$myPC["$product_type"] = $product;
				break;
		}
		$this->setMyPC($myPC);
		exit(0);
	}
	
	function getMyPCTotal() {
		$myPC = $this->getMyPC();
		$total = 0;
		foreach($myPC as $categoria=>$producto) {
			switch($categoria) {
				case 'HardDrive':
				case 'Monitor':
					if(isset($producto['1']['Product'])) {
						$total += $producto['1']['Product']['price'];
					}
					if(isset($producto['2']['Product'])) {
						$total += $producto['2']['Product']['price'];
					}
					break;
				case 'VideoCard':
				case 'Memory':
					if(isset($producto['1']['Product'])) {
						$total += $producto['1']['Product']['price'];
					} else {
						if(isset($producto['2']['Product'])) {
							$total += $producto['2']['Product']['price'] * 2;
						}
					}
					break;
				default:
					if(isset($producto['Product']['price'])) {
						$total += $producto['Product']['price'];
					}
					break;
			}
		}
		return $total;
	}

	function myPCRemoveItem($product_type, $position) {
		$this->layout="ajax";
		$myPC = $this->getMyPC();
		if(isset($myPC["$product_type"]["$position"]))
			unset($myPC["$product_type"]["$position"]);
		$this->setMyPC($myPC);
		exit(0);
	}
	
	function armaTuComputador() {
		$this->layout="personaliza";
		$arquitectures = $this->Product->Architecture->find('list');
		$this->set(compact('arquitectures'));
	}	
	/**
	 * $architecture_id : ID de la arquitectura seleccionada
	 */
	function getProcessors($architecture_id = null) {
		$this->layout="ajax";
		$processors = $this->Product->find(
			'list',
			array(
				'recursive'=>-1,
				'conditions'=>array(
					'Product.architecture_id'=>$architecture_id,
					'Product.product_type_id'=>1
				)
			)
		);
		$this -> set('items',$processors);
		
		$myPC = $this->getMyPC();
		if(isset($myPC['Processor']['Product']['id']) && !empty($myPC['Processor']['Product']['id'])) {
			$this -> set('selected_id', $myPC['Processor']['Product']['id']);
		}
		
	}
	
	/**
	 * $product_id : ID del producto (procesador) seleccionado.
	 * De ahí procesar la arquitectura y el tipo de socket
	 */
	function getMotherBoards($product_id = null) {
		$this->layout="ajax";
		$myPC = $this->getMyPC();
		//$datos=Set::combine($slots,'Slot.{n}.id',Slot.{n});
		$processor = $this->Product->find('first', array('recursive'=>1, 'conditions'=>array('Product.id'=>$product_id)));
		$architecture_id = $processor['Socket'][0]['architecture_id'];
		$socket_id = $processor['Socket'][0]['ProductsSocket']['socket_id'];
		$product_ids = $this->Product->ProductsSocket->find(
			'list',
			array(
				'conditions'=>array(
					'ProductsSocket.socket_id' => $socket_id
				),
				'fields'=>array(
					'ProductsSocket.product_id'
				)
			)
		);
		
		$motherboards = $this->Product->find(
			'list',
			array(
				'recursive'=>-1,
				'conditions'=>array(
					'Product.architecture_id'=>$architecture_id,
					'Product.product_type_id'=>2,
					'Product.id'=>$product_ids
				)
			)
		);
		$this -> set('items', $motherboards);
		
		if(isset($myPC['Motherboard']['Product']['id']) && !empty($myPC['Motherboard']['Product']['id'])) {
			$this -> set('selected_id', $myPC['Motherboard']['Product']['id']);
		}
		
	}
	
	/**
	 * $product_id : ID del producto (tarjeta madre) seleccionada.
	 * De ahí procesar si tiene video o no
	 */
	function isVideoIncluded($product_id = null) {
		$this->layout="ajax";
		$motherboard = $this->Product->findById($product_id);
		echo  (bool) $motherboard['Product']['is_video_included'];
		exit(0);
	}
	
	/**
	 * $product_id : ID del producto (tarjeta madre) seleccionada.
	 * De ahí procesar las memorias disponibles compatibles
	 */
	function getVideoCards($product_id = null) {
		$this->layout="ajax";
		$motherboard = $this->Product->findById($product_id);
		$motherboard_slots = array();
		foreach($motherboard['Slot'] as $slot) {
			$motherboard_slots[] = $slot['id'];
		}
		$videoCard = $this->Product->find('all', array('conditions'=>array('Product.product_type_id'=>5)));
		$compatible_cards = array();
		foreach($videoCard as $card) {
			if(in_array($card['Slot'][0]['id'], $motherboard_slots)) {
				$compatible_cards[] = $card['Product']['id'];
			}
		}
		$videoCards = $this->Product->find('list', array('recursive'=>-1, 'conditions'=>array('Product.id'=>$compatible_cards)));
		$this -> set('items',$videoCards);
		$myPC = $this->getMyPC();
		if(isset($myPC['VideoCard'][1]['Product']['id']) && !empty($myPC['VideoCard'][1]['Product']['id'])) {
			$this -> set('selected_id_1', $myPC['VideoCard'][1]['Product']['id']);
		}
		if(isset($myPC['VideoCard'][2]['Product']['id']) && !empty($myPC['VideoCard'][2]['Product']['id'])) {
			$this -> set('selected_id_2', $myPC['VideoCard'][2]['Product']['id']);
		}
	}
	
	/**
	 * $product_id : ID del producto (tarjeta madre) seleccionada.
	 * De ahí procesar las memorias disponibles compatibles
	 */
	function getMemories($product_id = null ) {
		$pc = $this->Session->read('myPC');
		$this->layout="ajax";
		$motherboard = $this->Product->findById($product_id);
		$motherboard_slots = array();
		foreach($motherboard['Slot'] as $slot) {
			$motherboard_slots[] = $slot['id'];
		}
		$memories = $this->Product->find('all', array('conditions'=>array('Product.product_type_id'=>3)));
		$compatible_memories = array();
		foreach($memories as $memory) {
			if(in_array($memory['Slot'][0]['id'], $motherboard_slots)) {
				$compatible_memories[] = $memory['Product']['id'];
			}
		}
		$memories = $this->Product->find('list', array('recursive'=>-1, 'conditions'=>array('Product.id'=>$compatible_memories)));
		$this -> set ('items', $memories);
		
		$myPC = $this->getMyPC();
		if(isset($myPC['Memory'][1]['Product']['id']) && !empty($myPC['Memory'][1]['Product']['id'])) {
			$this -> set('selected_id_1', $myPC['Memory'][1]['Product']['id']);
		}
		if(isset($myPC['Memory'][2]['Product']['id']) && !empty($myPC['Memory'][2]['Product']['id'])) {
			$this -> set('selected_id_2', $myPC['Memory'][2]['Product']['id']);
		}
	}
	
	/**
	 * $product_id : ID del producto (tarjeta madre) seleccionada.
	 * De ahí procesar los discos duros disponibles compatibles
	 */
	function getHardDrives($product_id = null) {
		$this->layout="ajax";
		$motherboard = $this->Product->findById($product_id);
		$motherboard_slots = array();
		foreach($motherboard['Slot'] as $slot) {
			$motherboard_slots[] = $slot['id'];
		}		
		$drives = $this->Product->find('all', array('conditions'=>array('Product.product_type_id'=>4)));
		$compatible_drives = array();
		foreach($drives as $drive) {
			if(in_array($drive['Slot'][0]['id'], $motherboard_slots)) {
				$compatible_drives[] = $drive['Product']['id'];
			}
		}
		$drives = $this->Product->find('list', array('recursive'=>-1, 'conditions'=>array('Product.id'=>$compatible_drives)));
		$this -> set ('items', $drives);
		$myPC = $this->getMyPC();
		if(isset($myPC['HardDrive'][1]['Product']['id']) && !empty($myPC['HardDrive'][1]['Product']['id'])) {
			$this -> set('selected_id_1', $myPC['HardDrive'][1]['Product']['id']);
		}
		if(isset($myPC['HardDrive'][2]['Product']['id']) && !empty($myPC['HardDrive'][2]['Product']['id'])) {
			$this -> set('selected_id_2', $myPC['HardDrive'][2]['Product']['id']);
		}
	}
	
	/**
	 * $product_id : ID del producto (tarjeta madre) seleccionada.
	 * De ahí procesar las unidades opticas disponibles compatibles
	 */
	function getOpticalDrives($product_id = null) {
		$this->layout="ajax";
		$motherboard = $this->Product->findById($product_id);
		$motherboard_slots = array();
		foreach($motherboard['Slot'] as $slot) {
			$motherboard_slots[] = $slot['id'];
		}		
		$drives = $this->Product->find('all', array('conditions'=>array('Product.product_type_id'=>14)));
		$compatible_drives = array();
		foreach($drives as $drive) {
			if(in_array($drive['Slot'][0]['id'], $motherboard_slots)) {
				$compatible_drives[] = $drive['Product']['id'];
			}
		}
		$drives = $this->Product->find('list', array('recursive'=>-1, 'conditions'=>array('Product.id'=>$compatible_drives)));
		$this -> set ('items',$drives);
		$myPC = $this->getMyPC();
		if(isset($myPC['OpticalDrive'][1]['Product']['id']) && !empty($myPC['OpticalDrive'][1]['Product']['id'])) {
			$this -> set('selected_id_1', $myPC['OpticalDrive'][1]['Product']['id']);
		}
		if(isset($myPC['OpticalDrive'][2]['Product']['id']) && !empty($myPC['OpticalDrive'][2]['Product']['id'])) {
			$this -> set('selected_id_2', $myPC['OpticalDrive'][2]['Product']['id']);
		}
	}
	
	/**
	 * $product_id : ID del producto (tarjeta de video) seleccionada.
	 * De ahí procesar las fuentes disponibles compatibles
	 */
	function getPowerSupplies($product_id = null) {
		$this->layout="ajax";
		$supplies = array();
		if($product_id) {
			$video_card = $this->Product->findById($product_id);
			$required = $video_card['Product']['required_power'];
			$compatible_psus = array();
			foreach ($supplies as $supply) {
				$output = $supply['Product']['power_output'];
				if(($output - $required) >= 450) {
					$compatible_psus[] = $supply['Product']['id'];
				}
			}
			$supplies = $this->Product->find('list', array('recursive'=>-1, 'conditions'=>array('Product.id'=>$compatible_psus)));
		} else {
			$supplies = $this->Product->find('list', array('conditions'=>array('Product.product_type_id'=>13)));
		}
		$this -> set ('items',$supplies);
		$myPC = $this->getMyPC();
		if(isset($myPC['PowerSupply']['Product']['id']) && !empty($myPC['PowerSupply']['Product']['id'])) {
			$this -> set('selected_id', $myPC['PowerSupply']['Product']['id']);
		}
	}
	
	/**
	 * Si se incluye $product_id : ID del producto (tarjeta de video) seleccionada.
	 * De ahí procesar las cajas disponibles compatibles
	 * Si no se incluye retornar todas.
	 */
	function getCasings($product_id = null) {
		$this->layout="ajax";
		$casings = array();
		if($product_id) {
			$casings = $this->Product->find('list', array('recursive'=>-1, 'conditions'=>array('Product.product_type_id' => 7, 'Product.is_big_casing' => 1)));
		} else {
			$casings = $this->Product->find('list', array('recursive'=>-1, 'conditions'=>array('Product.product_type_id' => 7)));
		}
		$this -> set('items', $casings);
		$myPC = $this->getMyPC();
		if(isset($myPC['Casing']['Product']['id']) && !empty($myPC['Casing']['Product']['id'])) {
			$this -> set('selected_id', $myPC['Casing']['Product']['id']);
		}
	}
	
	function getMonitors() {
		$items = $this->Product->find('list', array('recursive'=>-1, 'conditions'=>array('Product.product_type_id' => 9)));
		$this -> set(compact('items'));
		$myPC = $this->getMyPC();
		if(isset($myPC['Monitor'][1]['Product']['id']) && !empty($myPC['Monitor'][1]['Product']['id'])) {
			$this -> set('selected_id_1', $myPC['Monitor'][1]['Product']['id']);
		}
		if(isset($myPC['Monitor'][2]['Product']['id']) && !empty($myPC['Monitor'][2]['Product']['id'])) {
			$this -> set('selected_id_2', $myPC['Monitor'][2]['Product']['id']);
		}
	}
	
	function getOtherCards($boardId) {
		$items = $this->Product->find('list', array('recursive'=>-1, 'conditions'=>array('Product.product_type_id' => 10)));
		$this -> set(compact('items', 'boardId'));
	}
	
	function getMice() {
		$this->layout="ajax";
		$myPC = $this->getMyPC();
		$motherboard = $this->Product->findById($myPC['Motherboard']['Product']['id']);
		$motherboard_slots = array();
		foreach($motherboard['Slot'] as $slot) {
			$motherboard_slots[] = $slot['id'];
		}		
		$mice = $this->Product->find('all', array('conditions'=>array('Product.product_type_id'=>17)));
		$compatible_mice = array();
		foreach($mice as $mouse) {
			if(in_array($mouse['Slot'][0]['id'], $motherboard_slots)) {
				$compatible_mice[] = $mouse['Product']['id'];
			}
		}
		$mice = $this->Product->find('list', array('recursive'=>-1, 'conditions'=>array('Product.id'=>$compatible_mice)));
		$this -> set('items',$mice);
		$myPC = $this->getMyPC();
		if(isset($myPC['Mouse']['Product']['id']) && !empty($myPC['Mouse']['Product']['id'])) {
			$this -> set('selected_id', $myPC['Mouse']['Product']['id']);
		}
	}
	
	function getKeyboards() {
		$this->layout="ajax";
		$myPC = $this->getMyPC();
		$motherboard = $this->Product->findById($myPC['Motherboard']['Product']['id']);
		$motherboard_slots = array();
		foreach($motherboard['Slot'] as $slot) {
			$motherboard_slots[] = $slot['id'];
		}		
		$keyboards = $this->Product->find('all', array('conditions'=>array('Product.product_type_id'=>18)));
		$compatible_keyboards = array();
		foreach($keyboards as $keyboard) {
			if(in_array($keyboard['Slot'][0]['id'], $motherboard_slots)) {
				$compatible_keyboards[] = $keyboard['Product']['id'];
			}
		}
		$keyboards = $this->Product->find('list', array('recursive'=>-1, 'conditions'=>array('Product.id'=>$compatible_keyboards)));
		$this -> set('items',$keyboards);
		$myPC = $this->getMyPC();
		if(isset($myPC['Keyboard']['Product']['id']) && !empty($myPC['Keyboard']['Product']['id'])) {
			$this -> set('selected_id', $myPC['Keyboard']['Product']['id']);
		}
	}
}