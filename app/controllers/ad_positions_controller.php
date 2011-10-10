<?php
class AdPositionsController extends AppController {

	var $name = 'AdPositions';

	function index() {
		$this->AdPosition->recursive = 0;
		$this->set('adPositions', $this->paginate());
	}
	function getAds($id){
		return $this->AdPosition->Ad->find('all',array('conditions'=>array('ad_position_id'=>$id)));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ad position', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('adPosition', $this->AdPosition->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->AdPosition->create();
			if ($this->AdPosition->save($this->data)) {
				$this->Session->setFlash(__('The ad position has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ad position could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ad position', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->AdPosition->save($this->data)) {
				$this->Session->setFlash(__('The ad position has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ad position could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AdPosition->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ad position', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->AdPosition->delete($id)) {
			$this->Session->setFlash(__('Ad position deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Ad position was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ad position', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->AdPosition->read(null,$id);
		$oldData["AdPosition"]["active"]=false;
		if ($this->AdPosition->save($oldData)) {
			$this->Session->setFlash(__('Ad position archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Ad position was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ad position', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->AdPosition->read(null,$id);
		$oldData["AdPosition"]["active"]=true;
		if ($this->AdPosition->save($oldData)) {
			$this->Session->setFlash(__('Ad position archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Ad position was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->AdPosition->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->AdPosition->recursive = 0;
		$this->set('adPositions', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ad position', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('adPosition', $this->AdPosition->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->AdPosition->create();
			if ($this->AdPosition->save($this->data)) {
				$this->Session->setFlash(__('The ad position has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ad position could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ad position', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->AdPosition->save($this->data)) {
				$this->Session->setFlash(__('The ad position has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ad position could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AdPosition->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ad position', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->AdPosition->delete($id)) {
			$this->Session->setFlash(__('Ad position deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Ad position was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ad position', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->AdPosition->read(null,$id);
		$oldData["AdPosition"]["active"]=false;
		if ($this->AdPosition->save($oldData)) {
			$this->Session->setFlash(__('Ad position archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Ad position was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ad position', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->AdPosition->read(null,$id);
		$oldData["AdPosition"]["active"]=true;
		if ($this->AdPosition->save($oldData)) {
			$this->Session->setFlash(__('Ad position archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Ad position was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->AdPosition->find($type, $findParams);
	}else{
		return null;
	}
}
}
