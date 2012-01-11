<?php
class PrizesController extends AppController {

	var $name = 'Prizes';
	
	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}
	
	function index() {
		$this->Prize->recursive = 0;
		$this->set('prizes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid prize', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('prize', $this->Prize->read(null, $id));	
		$this->set('prizes', $this->paginate());
	}
	
	
	function admin_index() {
		$this->Prize->recursive = 0;
		$this->set('prizes', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid prize', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('prize', $this->Prize->read(null, $id));	
	}
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->Prize->create();
			if ($this->Prize->save($this->data)) {
				$this->Session->setFlash(__('The prize has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The prize could not be saved. Please, try again.', true));
			}
		}
	}
	
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid prize', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Prize->save($this->data)) {
				$this->Session->setFlash(__('The prize has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The prize could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Prize->read(null, $id);
		}
	}
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for prize', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Prize->delete($id)) {
			$this->Session->setFlash(__('Prize deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Prize was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	

}
