<?php
class CollectionsController extends AppController {

	var $name = 'Collections';
	
	function getCollections($product_id = null) {
		$this->autoRender=false;
		$product=$this->Collection->Product->read(null, $product_id);
		if($product) {
			$search = $this->Collection->find(
				'first',
				array(
					'conditions' => array(
						'Collection.id' => $product['Product']['collection_id']
					)
				)
			);
			$search = $this->Collection->Brand->find(
				'first',
				array(
					'conditions' => array(
						'Brand.id' => $search['Brand']['_id']
					)
				)
			);
		} else {
			echo 0;
		}
		exit(0);
	}

	function index() {
		$this->Collection->recursive = 0;
		$this->set('collections', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid collection', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('collection', $this->Collection->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Collection->create();
			if ($this->Collection->save($this->data)) {
				$this->Session->setFlash(__('The collection has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The collection could not be saved. Please, try again.', true));
			}
		}
		$brands = $this->Collection->Brand->find('list');
		$this->set(compact('brands'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid collection', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Collection->save($this->data)) {
				$this->Session->setFlash(__('The collection has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The collection could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Collection->read(null, $id);
		}
		$brands = $this->Collection->Brand->find('list');
		$this->set(compact('brands'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for collection', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Collection->delete($id)) {
			$this->Session->setFlash(__('Collection deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Collection was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for collection', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Collection->read(null,$id);
		$oldData["Collection"]["active"]=false;
		if ($this->Collection->save($oldData)) {
			$this->Session->setFlash(__('Collection archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Collection was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for collection', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Collection->read(null,$id);
		$oldData["Collection"]["active"]=true;
		if ($this->Collection->save($oldData)) {
			$this->Session->setFlash(__('Collection archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Collection was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Collection->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->Collection->recursive = 0;
		$this->set('collections', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid collection', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('collection', $this->Collection->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Collection->create();
			if ($this->Collection->save($this->data)) {
				$this->Session->setFlash(__('The collection has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The collection could not be saved. Please, try again.', true));
			}
		}
		$brands = $this->Collection->Brand->find('list');
		$this->set(compact('brands'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid collection', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Collection->save($this->data)) {
				$this->Session->setFlash(__('The collection has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The collection could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Collection->read(null, $id);
		}
		$brands = $this->Collection->Brand->find('list');
		$this->set(compact('brands'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for collection', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Collection->delete($id)) {
			$this->Session->setFlash(__('Collection deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Collection was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for collection', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Collection->read(null,$id);
		$oldData["Collection"]["active"]=false;
		if ($this->Collection->save($oldData)) {
			$this->Session->setFlash(__('Collection archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Collection was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for collection', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->Collection->read(null,$id);
		$oldData["Collection"]["active"]=true;
		if ($this->Collection->save($oldData)) {
			$this->Session->setFlash(__('Collection archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Collection was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->Collection->find($type, $findParams);
	}else{
		return null;
	}
}
}
