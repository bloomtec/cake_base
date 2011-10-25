<?php
class HorariosController extends AppController {

	var $name = 'Horarios';
	
	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}
	
	function index() {
		$this->Horario->recursive = 0;
		$this->set('horarios', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid horario', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('horario', $this->Horario->read(null, $id));	
	}
	
	
	function admin_index() {
		$this->Horario->recursive = 0;
		$this->set('horarios', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid horario', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('horario', $this->Horario->read(null, $id));	
	}
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->Horario->create();
			if ($this->Horario->save($this->data)) {
				$this->Session->setFlash(__('The horario has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The horario could not be saved. Please, try again.', true));
			}
		}
	}
	
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid horario', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Horario->save($this->data)) {
				$this->Session->setFlash(__('The horario has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The horario could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Horario->read(null, $id);
		}
	}
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for horario', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Horario->delete($id)) {
			$this->Session->setFlash(__('Horario deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Horario was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	
	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for horario', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Horario->read(null,$id);
		$oldData["Horario"]['is_active']=false;
		if ($this->Horario->save($oldData)) {
			$this->Session->setFlash(__('Horario archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Horario was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for horario', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Horario->read(null,$id);
		$oldData["Horario"]['is_active']=true;
		if ($this->Horario->save($oldData)) {
			$this->Session->setFlash(__('Horario archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Horario was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_reOrder(){
    	foreach($this->data["Item"] as $id=>$position){
    		$this->Horario->id=$id;
    		$this->Horario->saveField("sort",$position); 
    	}
		echo true;
		Configure::write('debug', 0);
		$this->autoRender = false;
		exit();
	}

}
