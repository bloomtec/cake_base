<?php
class CouponBatchesController extends AppController {

	var $name = 'CouponBatches';

	function index() {
		$this->CouponBatch->recursive = 0;
		$this->set('couponBatches', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid coupon batch', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('couponBatch', $this->CouponBatch->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->CouponBatch->create();
			if ($this->CouponBatch->save($this->data)) {
				$this->Session->setFlash(__('The coupon batch has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The coupon batch could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid coupon batch', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->CouponBatch->save($this->data)) {
				$this->Session->setFlash(__('The coupon batch has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The coupon batch could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CouponBatch->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for coupon batch', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->CouponBatch->delete($id)) {
			$this->Session->setFlash(__('Coupon batch deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Coupon batch was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for coupon batch', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->CouponBatch->read(null,$id);
		$oldData["CouponBatch"]["active"]=false;
		if ($this->CouponBatch->save($oldData)) {
			$this->Session->setFlash(__('Coupon batch archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Coupon batch was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for coupon batch', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->CouponBatch->read(null,$id);
		$oldData["CouponBatch"]["active"]=true;
		if ($this->CouponBatch->save($oldData)) {
			$this->Session->setFlash(__('Coupon batch archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Coupon batch was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->CouponBatch->find($type, $findParams);
	}else{
		return null;
	}
}
	function admin_index() {
		$this->CouponBatch->recursive = 0;
		$this->set('couponBatches', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid coupon batch', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('couponBatch', $this->CouponBatch->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->CouponBatch->create();
			if ($this->CouponBatch->save($this->data)) {
				$this->Session->setFlash(__('The coupon batch has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The coupon batch could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid coupon batch', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->CouponBatch->save($this->data)) {
				$this->Session->setFlash(__('The coupon batch has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The coupon batch could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CouponBatch->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for coupon batch', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->CouponBatch->delete($id)) {
			$this->Session->setFlash(__('Coupon batch deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Coupon batch was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}




	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for coupon batch', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->CouponBatch->read(null,$id);
		$oldData["CouponBatch"]["active"]=false;
		if ($this->CouponBatch->save($oldData)) {
			$this->Session->setFlash(__('Coupon batch archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Coupon batch was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for coupon batch', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->CouponBatch->read(null,$id);
		$oldData["CouponBatch"]["active"]=true;
		if ($this->CouponBatch->save($oldData)) {
			$this->Session->setFlash(__('Coupon batch archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Coupon batch was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
function admin_requestFind($type,$findParams,$key) {
	if($key==Configure::read("key")){
		return $this->CouponBatch->find($type, $findParams);
	}else{
		return null;
	}
}
}
