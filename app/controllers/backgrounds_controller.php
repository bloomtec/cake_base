<?php
class BackgroundsController extends AppController {

	var $name = 'Backgrounds';
	
	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}
	
	function index() {
		$this->Background->recursive = 0;
		$this->set('backgrounds', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid background', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('background', $this->Background->read('null', $id));	
	}
	
	
	
	function admin_index() {
		$this->Background->recursive = 0;
		$this->set('backgrounds', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid background', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('background', $this->Background->read(null, $id));	
	}
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->Background->create();
			if ($this->Background->save($this->data)) {
				$this->Session->setFlash(__('The background has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The background could not be saved. Please, try again.', true));
			}
		}
	}
	
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid background', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Background->save($this->data)) {
				$this->Session->setFlash(__('The background has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The background could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Background->read(null, $id);
		}
	}
	
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for background', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Background->delete($id)) {
			$this->Session->setFlash(__('Background deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Background was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	
	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for background', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Background->read(null,$id);
		$oldData["Background"]['is_active']=false;
		if ($this->Background->save($oldData)) {
			$this->Session->setFlash(__('Background archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Background was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
	
	
	function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for background', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Background->read(null,$id);
		$oldData["Background"]['is_active']=true;
		if ($this->Background->save($oldData)) {
			$this->Session->setFlash(__('Background archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Background was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
	
	
	function admin_reOrder(){
    	foreach($this->data["Item"] as $id=>$position){
    		$this->Background->id=$id;
    		$this->Background->saveField("sort",$position); 
    	}
		echo true;
		Configure::write('debug', 0);
		$this->autoRender = false;
		exit();
	}

}
