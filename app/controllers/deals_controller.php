<?php
class DealsController extends AppController {

	var $name = 'Deals';

	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}

	function index() {
		$this -> Deal -> recursive = 0;
		$this -> set('deals', $this -> paginate());
	}

	function view($slug = null) {
		if (!$slug) {
			$this -> Session -> setFlash(__('Invalid deal', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('deal', $this -> Deal -> findBySlug($slug));
	}

	function admin_index() {
		$this -> Deal -> recursive = 0;
		$this -> set('deals', $this -> paginate());
	}

	function admin_view($slug = null) {
		if (!$slug) {
			$this -> Session -> setFlash(__('Invalid deal', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('deal', $this -> Deal -> findBySlug($slug));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> Deal -> create();
			if ($this -> Deal -> save($this -> data)) {
				$this -> Session -> setFlash(__('The deal has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The deal could not be saved. Please, try again.', true));
			}
		}
		$restaurants = $this -> Deal -> Restaurant -> find('list');
		$cuisines = $this -> Deal -> Cuisine -> find('list');
		$this -> set(compact('restaurants', 'cuisines'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid deal', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Deal -> save($this -> data)) {
				$this -> Session -> setFlash(__('The deal has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The deal could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Deal -> read(null, $id);
		}
		$restaurants = $this -> Deal -> Restaurant -> find('list');
		$cuisines = $this -> Deal -> Cuisine -> find('list');
		$this -> set(compact('restaurants', 'cuisines'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for deal', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Deal -> delete($id)) {
			$this -> Session -> setFlash(__('Deal deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Deal was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function manager_index() {
		$this -> Deal -> recursive = 0;
		$this -> set('deals', $this -> paginate());
	}

	function manager_view($slug = null) {
		if (!$slug) {
			$this -> Session -> setFlash(__('Invalid deal', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('deal', $this -> Deal -> findBySlug($slug));
	}

	function manager_add() {
		if (!empty($this -> data)) {
			$this -> Deal -> create();
			if ($this -> Deal -> save($this -> data)) {
				$this -> Session -> setFlash(__('The deal has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The deal could not be saved. Please, try again.', true));
			}
		}
		$restaurants = $this -> Deal -> Restaurant -> find('list');
		$cuisines = $this -> Deal -> Cuisine -> find('list');
		$this -> set(compact('restaurants', 'cuisines'));
	}

	function manager_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid deal', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Deal -> save($this -> data)) {
				$this -> Session -> setFlash(__('The deal has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The deal could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Deal -> read(null, $id);
		}
		$restaurants = $this -> Deal -> Restaurant -> find('list');
		$cuisines = $this -> Deal -> Cuisine -> find('list');
		$this -> set(compact('restaurants', 'cuisines'));
	}

	function manager_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for deal', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Deal -> delete($id)) {
			$this -> Session -> setFlash(__('Deal deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Deal was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

}
