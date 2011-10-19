<?php
class TestsController extends AppController {

	var $name = 'Tests';

	function index() {
		$this->Test->recursive = 0;
		$this->set('tests', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid test', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('test', $this->Test->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Test->create();
			if ($this->Test->save($this->data)) {
				$this->Session->setFlash(__('The test has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The test could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid test', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Test->save($this->data)) {
				$this->Session->setFlash(__('The test has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The test could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Test->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for test', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Test->delete($id)) {
			$this->Session->setFlash(__('Test deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Test was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for test', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Test->read(null,$id);
		$oldData["Test"]["active"]=false;
		if ($this->Test->save($oldData)) {
			$this->Session->setFlash(__('Test archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Test was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for test', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Test->read(null,$id);
		$oldData["Test"]["active"]=true;
		if ($this->Test->save($oldData)) {
			$this->Session->setFlash(__('Test archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Test was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Test->recursive = 0;
		$this->set('tests', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid test', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('test', $this->Test->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Test->create();
			if ($this->Test->save($this->data)) {
				$this->Session->setFlash(__('The test has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The test could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid test', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Test->save($this->data)) {
				$this->Session->setFlash(__('The test has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The test could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Test->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for test', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Test->delete($id)) {
			$this->Session->setFlash(__('Test deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Test was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for test', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Test->read(null,$id);
		$oldData["Test"]["active"]=false;
		if ($this->Test->save($oldData)) {
			$this->Session->setFlash(__('Test archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Test was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for test', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Test->read(null,$id);
		$oldData["Test"]["active"]=true;
		if ($this->Test->save($oldData)) {
			$this->Session->setFlash(__('Test archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Test was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
}
