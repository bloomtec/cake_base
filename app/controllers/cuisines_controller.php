<?php
class CuisinesController extends AppController {

	var $name = 'Cuisines';

	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}

	function index() {
		$this -> Cuisine -> recursive = 0;
		$this -> set('cuisines', $this -> paginate());
	}

	function view($slug = null) {
		if (!$slug) {
			$this -> Session -> setFlash(__('Invalid cuisine', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('cuisine', $this -> Cuisine -> findBySlug($slug));
	}

	function admin_index() {
		$this -> Cuisine -> recursive = 0;
		$this -> set('cuisines', $this -> paginate());
	}

	function admin_view($slug = null) {
		if (!$slug) {
			$this -> Session -> setFlash(__('Invalid cuisine', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('cuisine', $this -> Cuisine -> findBySlug($slug));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> Cuisine -> create();
			if ($this -> Cuisine -> save($this -> data)) {
				$this -> Session -> setFlash(__('The cuisine has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The cuisine could not be saved. Please, try again.', true));
			}
		}
		$deals = $this -> Cuisine -> Deal -> find('list');
		$this -> set(compact('deals'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid cuisine', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Cuisine -> save($this -> data)) {
				$this -> Session -> setFlash(__('The cuisine has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The cuisine could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Cuisine -> read(null, $id);
		}
		$deals = $this -> Cuisine -> Deal -> find('list');
		$this -> set(compact('deals'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for cuisine', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Cuisine -> delete($id)) {
			$this -> Session -> setFlash(__('Cuisine deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Cuisine was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

}
