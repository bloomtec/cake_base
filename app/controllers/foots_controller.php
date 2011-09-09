<?php
class FootsController extends AppController {

	var $name = 'Foots';

	function index() {
		$this->Foot->recursive = 0;
		$this->set('foots', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid foot', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('foot', $this->Foot->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Foot->create();
			if ($this->Foot->save($this->data)) {
				$this->Session->setFlash(__('The foot has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The foot could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid foot', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Foot->save($this->data)) {
				$this->Session->setFlash(__('The foot has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The foot could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Foot->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for foot', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Foot->delete($id)) {
			$this->Session->setFlash(__('Foot deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Foot was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for foot', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Foot->read(null,$id);
		$oldData["Foot"]["active"]=false;
		if ($this->Foot->save($oldData)) {
			$this->Session->setFlash(__('Foot archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Foot was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for foot', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Foot->read(null,$id);
		$oldData["Foot"]["active"]=true;
		if ($this->Foot->save($oldData)) {
			$this->Session->setFlash(__('Foot archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Foot was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Foot->recursive = 0;
		$this->set('foots', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid foot', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('foot', $this->Foot->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Foot->create();
			if ($this->Foot->save($this->data)) {
				$this->Session->setFlash(__('The foot has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The foot could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid foot', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Foot->save($this->data)) {
				$this->Session->setFlash(__('The foot has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The foot could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Foot->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for foot', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Foot->delete($id)) {
			$this->Session->setFlash(__('Foot deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Foot was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for foot', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Foot->read(null,$id);
		$oldData["Foot"]["active"]=false;
		if ($this->Foot->save($oldData)) {
			$this->Session->setFlash(__('Foot archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Foot was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for foot', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Foot->read(null,$id);
		$oldData["Foot"]["active"]=true;
		if ($this->Foot->save($oldData)) {
			$this->Session->setFlash(__('Foot archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Foot was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
}
