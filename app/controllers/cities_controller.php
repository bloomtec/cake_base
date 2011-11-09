<?php
class CitiesController extends AppController {

	var $name = 'Cities';
	
	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}
	
	function index() {
		$this->City->recursive = 0;
		$this->set('cities', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid city', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('city', $this->City->read(null, $id));	
	}
	
	
	function admin_index() {
		$this->City->recursive = 0;
		$this->set('cities', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid city', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('city', $this->City->read(null, $id));	
	}
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->City->create();
			if ($this->City->save($this->data)) {
				$this->Session->setFlash(__('The city has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The city could not be saved. Please, try again.', true));
			}
		}
		$countries = $this->City->Country->find('list');
		$this->set(compact('countries'));
	}
	
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid city', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->City->save($this->data)) {
				$this->Session->setFlash(__('The city has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The city could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->City->read(null, $id);
		}
		$countries = $this->City->Country->find('list');
		$this->set(compact('countries'));
	}
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for city', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->City->delete($id)) {
			$this->Session->setFlash(__('City deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('City was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	

}
