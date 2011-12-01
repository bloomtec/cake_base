<?php
class TagSlidersController extends AppController {

	var $name = 'TagSliders';
	
	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}

	function admin_index($tagId = null) {
		$this->TagSlider->recursive = 0;
		$this->set('tagSliders', $this->paginate(array('TagSlider.tag_id'=>$tagId)));
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid tag slider', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tagSlider', $this->TagSlider->read(null, $id));	
	}
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->TagSlider->create();
			if ($this->TagSlider->save($this->data)) {
				$this->Session->setFlash(__('The tag slider has been saved', true));
				$this->redirect(array('action' => 'index',$this->data['TagSlider']['tag_id']));
			} else {
				$this->Session->setFlash(__('The tag slider could not be saved. Please, try again.', true));
				$this->params['pass'][0]=$this->data['TagSlider']['tag_id'];
			}
		}
		$tags = $this->TagSlider->Tag->find('list');
		$this->set(compact('tags'));
	}
	
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid tag slider', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->TagSlider->save($this->data)) {
				$this->Session->setFlash(__('The tag slider has been saved', true));
				$this->redirect(array('action' => 'index',$this->data['TagSlider']['tag_id']));
			} else {
				$this->Session->setFlash(__('The tag slider could not be saved. Please, try again.', true));
				$this->params['pass'][0]=$this->data['TagSlider']['tag_id'];
			}
		}
		if (empty($this->data)) {
			$this->data = $this->TagSlider->read(null, $id);
		}
		$tags = $this->TagSlider->Tag->find('list');
		$this->set(compact('tags'));
	}
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for tag slider', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldTag=$this-> TagSlider -> read(null,$id);
		if ($this->TagSlider->delete($id)) {
			$this->Session->setFlash(__('Tag slider deleted', true));
			$this->redirect(array('action'=>'index',$oldTag['TagSlider']['tag_id']));
		}
		$this->Session->setFlash(__('Tag slider was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	
	function admin_reOrder(){
    	foreach($this->data["Item"] as $id=>$position){
    		$this->TagSlider->id=$id;
    		$this->TagSlider->saveField("sort",$position); 
    	}
		echo true;
		Configure::write('debug', 0);
		$this->autoRender = false;
		exit();
	}

}
