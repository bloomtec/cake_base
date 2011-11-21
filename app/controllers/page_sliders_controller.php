<?php
class PageSlidersController extends AppController {

	var $name = 'PageSliders';
	
	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}
	
	function admin_index($pageId = null) {
		$this->PageSlider->recursive = 0;
		$this->set('pageSliders', $this->paginate(array('page_id'=>$pageId)));
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid page slider', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('pageSlider', $this->PageSlider->read(null, $id));	
	}
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->PageSlider->create();
			if ($this->PageSlider->save($this->data)) {
				$this->Session->setFlash(__('The page slider has been saved', true));
				$this->redirect(array('action' => 'index',$this->data['PageSlider']['page_id']));
			} else {
				$this->Session->setFlash(__('The page slider could not be saved. Please, try again.', true));
				$this->params['pass'][0]=$this->data['PageSlider']['page_id'];
			}
		}
		$pages = $this->PageSlider->Page->find('list');
		$this->set(compact('pages'));
	}
	
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid page slider', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PageSlider->save($this->data)) {
				$this->Session->setFlash(__('The page slider has been saved', true));
				$this->redirect(array('action' => 'index',$this->data['PageSlider']['page_id']));
			} else {
				$this->Session->setFlash(__('The page slider could not be saved. Please, try again.', true));
				$this->params['pass'][0]=$this->data['PageSlider']['page_id'];
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PageSlider->read(null, $id);
		}
		$pages = $this->PageSlider->Page->find('list');
		$this->set(compact('pages'));
	}
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for page slider', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldPage=$this-> PageSlider -> read(null,$id);
		if ($this->PageSlider->delete($id)) {
			$this->Session->setFlash(__('Page slider deleted', true));
			$this->redirect(array('action'=>'index',$oldPage['PageSlider']['id']));
		}
		$this->Session->setFlash(__('Page slider was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	
	function admin_reOrder(){
    	foreach($this->data["Item"] as $id=>$position){
    		$this->PageSlider->id=$id;
    		$this->PageSlider->saveField("sort",$position); 
    	}
		echo true;
		Configure::write('debug', 0);
		$this->autoRender = false;
		exit();
	}

}
