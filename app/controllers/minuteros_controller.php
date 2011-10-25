<?php
class MinuterosController extends AppController {

	var $name = 'Minuteros';
	
	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}
	
	function index() {
		$this->Minutero->recursive = 0;
		$this->set('minuteros', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid minutero', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('minutero', $this->Minutero->read(null, $id));	
	}
	
	
	function admin_index() {
		$this->Minutero->recursive = 0;
		$this->set('minuteros', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid minutero', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('minutero', $this->Minutero->read(null, $id));	
	}
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->Minutero->create();
			if ($this->Minutero->save($this->data)) {
				$this->Session->setFlash(__('The minutero has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The minutero could not be saved. Please, try again.', true));
			}
		}
	}
	
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid minutero', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Minutero->save($this->data)) {
				$this->Session->setFlash(__('The minutero has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The minutero could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Minutero->read(null, $id);
		}
	}
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for minutero', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Minutero->delete($id)) {
			$this->Session->setFlash(__('Minutero deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Minutero was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	
	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for minutero', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Minutero->read(null,$id);
		$oldData["Minutero"]['is_active']=false;
		if ($this->Minutero->save($oldData)) {
			$this->Session->setFlash(__('Minutero archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Minutero was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for minutero', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Minutero->read(null,$id);
		$oldData["Minutero"]['is_active']=true;
		if ($this->Minutero->save($oldData)) {
			$this->Session->setFlash(__('Minutero archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Minutero was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_reOrder(){
    	foreach($this->data["Item"] as $id=>$position){
    		$this->Minutero->id=$id;
    		$this->Minutero->saveField("sort",$position); 
    	}
		echo true;
		Configure::write('debug', 0);
		$this->autoRender = false;
		exit();
	}

}
