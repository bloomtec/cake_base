<?php
class ZonesController extends AppController {

	var $name = 'Zones';
	
	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}
	
	function index() {
		$this->Zone->recursive = 0;
		$this->set('zones', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid zone', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('zone', $this->Zone->read(null, $id));	
	}
	
	
	function admin_index() {
		$this->Zone->recursive = 0;
		$this->set('zones', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid zone', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('zone', $this->Zone->read(null, $id));	
	}
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->Zone->create();
			if ($this->Zone->save($this->data)) {
				$this->Session->setFlash(__('The zone has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The zone could not be saved. Please, try again.', true));
			}
		}
		$countries =  $this->Zone->City->Country->find('list');
		$this->set(compact('countries'));
	}
	
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid zone', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Zone->save($this->data)) {
				$this->Session->setFlash(__('The zone has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The zone could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Zone->read(null, $id);
		}
		$countries =  $this->Zone->City->Country->find('list');
		$cities = $this->Zone->City->find('list',array('conditions'=>array('country_id'=>$this->data['City']['country_id'])));
		$this->set(compact('countries','cities'));
	}
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for zone', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Zone->delete($id)) {
			$this->Session->setFlash(__('Zone deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Zone was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	

}
