<?php
class AddressesController extends AppController {

	var $name = 'Addresses';

	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}

	function index() {
		$this -> Address -> recursive = 0;
		$this -> set('addresses', $this -> paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Dirección no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('address', $this -> Address -> read(null, $id));
	}
	function getJSON($id){
		$this -> Address -> recursive = -1;
		echo json_encode($this -> Address -> read(null,$id));
		$this -> autorender = false;
		exit(0);
	}
	function edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Dirección no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Address -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se guardó la dirección', true));
				$this -> redirect(array('controller' => 'users', 'action' => 'updateAddresses', $this -> data['Address']['user_id']));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar la dirección. Por favor, intente de nuevo.', true));
				$this -> redirect(array('controller' => 'users', 'action' => 'updateAddresses', $this -> data['Address']['user_id']));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Address -> read(null, $id);
		}
		$users = $this -> Address -> User -> find('list');
		$countries = $this -> Address -> Country -> find('list');
		$cities = $this -> Address -> City -> find('list');
		$this -> set(compact('users', 'countries', 'cities'));
	}

	function add() {
		if (!empty($this -> data)) {
			$this -> Address -> create();
			if ($this -> Address -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se guardó la dirección', true));
				$this -> redirect(array('controller' => 'users', 'action' => 'updateAddresses', $this -> data['Address']['user_id']));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar la dirección. Por favor, intente de nuevo.', true));
				$this -> redirect(array('controller' => 'users', 'action' => 'updateAddresses', $this -> data['Address']['user_id']));
			}
		}
		$users = $this -> Address -> User -> find('list');
		$countries = $this -> Address -> Country -> find('list');
		$cities = $this -> Address -> City -> find('list');
		$this -> set(compact('users', 'countries', 'cities'));
	}

	function admin_index() {
		$this -> Address -> recursive = 0;
		$this -> set('addresses', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Dirección no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('address', $this -> Address -> read(null, $id));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> Address -> create();
			if ($this -> Address -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se guardó la dirección', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar la dirección. Por favor, intente de nuevo.', true));
			}
		}
		$users = $this -> Address -> User -> find('list');
		$countries = $this -> Address -> Country -> find('list');
		$cities = $this -> Address -> City -> find('list');
		$this -> set(compact('users', 'countries', 'cities'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Dirección no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Address -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se guardó la dirección', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar la dirección. Por favor, intente de nuevo.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Address -> read(null, $id);
		}
		$users = $this -> Address -> User -> find('list');
		$countries = $this -> Address -> Country -> find('list');
		$cities = $this -> Address -> City -> find('list');
		$this -> set(compact('users', 'countries', 'cities'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('ID de dirección no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Address -> delete($id)) {
			$this -> Session -> setFlash(__('Dirección eliminada', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('La dirección no fue eliminada', true));
		$this -> redirect(array('action' => 'index'));
	}

}
