<?php
class CountriesController extends AppController {

	var $name = 'Countries';

	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}

	function getCities($id) {
		echo json_encode($this -> Country -> City -> find('list', array('conditions' => array('country_id' => $id, 'is_present' => true))));
		Configure::write('debug', 0);
		$this -> autoRender = false;
		exit(0);
	}

	function index() {
		$this -> Country -> recursive = 0;
		$this -> set('countries', $this -> paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid country', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('country', $this -> Country -> read(null, $id));
	}

	function admin_index() {
		$this -> Country -> recursive = 0;
		$this -> set('countries', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid country', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('country', $this -> Country -> read(null, $id));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> Country -> create();
			if ($this -> Country -> save($this -> data)) {
				$this -> Session -> setFlash(__('The country has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The country could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid country', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Country -> save($this -> data)) {
				$this -> Session -> setFlash(__('The country has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The country could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Country -> read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for country', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Country -> delete($id)) {
			$this -> Session -> setFlash(__('Country deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Country was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

}
