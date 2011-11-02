<?php
class BrandsController extends AppController {

	var $name = 'Brands';
	
	function admin_index() {
		$this->Brand->recursive = 0;
		$this->paginate=array(
			'order'=>array('Brand.name'=>'ASC')
		);
		$this->set('brands', $this->paginate());
	}

	function admin_view($slug = null) {
		if (!$slug) {
			$this->Session->setFlash(__('Invalid brand', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('brand', $this->Brand->findBySlug($slug));
	}
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->Brand->create();
			if ($this->Brand->save($this->data)) {
				$this->Session->setFlash(__('The brand has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The brand could not be saved. Please, try again.', true));
			}
		}
	}
	
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid brand', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Brand->save($this->data)) {
				$this->Session->setFlash(__('The brand has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The brand could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Brand->read(null, $id);
		}
	}
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for brand', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Brand->delete($id)) {
			$this->Session->setFlash(__('Brand deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Brand was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	
	function admin_reOrder(){
    	foreach($this->data["Item"] as $id=>$position){
    		$this->Brand->id=$id;
    		$this->Brand->saveField("sort",$position); 
    	}
		echo true;
		Configure::write('debug', 0);
		$this->autoRender = false;
		exit();
	}

}
