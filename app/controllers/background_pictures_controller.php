<?php
class BackgroundPicturesController extends AppController {

	var $name = 'BackgroundPictures';
	var $components = array('Attachment');	
	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}
	
	function index() {
		$this->BackgroundPicture->recursive = 0;
		$this->set('backgroundPictures', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid background picture', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->BackgroundPicture->recursive = 0;
				$this->set('backgroundPictures', $this->BackgroundPicture->find('all',array('conditions'=>array('background_id'=>$id))));
		$this->set('parent_id',$id);
					$parent=$this->BackgroundPicture->Background->read(null,$id); 
			 if (isset($parent['Background']['name'])){
			 	 $this->set('parentName',$parent['Background']['name']);
			}else{
			  if (isset($parent['Background']['title'])) $this->set('parentName',$parent['Background']['title']);
			}		 
	}
	
	
	function admin_index() {
		$this->BackgroundPicture->recursive = 0;
		$this->set('backgroundPictures', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid background picture', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->BackgroundPicture->recursive = 0;
				$this->set('backgroundPictures', $this->BackgroundPicture->find('all',array('conditions'=>array('background_id'=>$id))));
		$this->set('parent_id',$id);
					$parent=$this->BackgroundPicture->Background->read(null,$id); 
			 if (isset($parent['Background']['name'])){
			 	 $this->set('parentName',$parent['Background']['name']);
			}else{
			  if (isset($parent['Background']['title'])) $this->set('parentName',$parent['Background']['title']);
			}		 
	}
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->BackgroundPicture->create();
			if ($this->BackgroundPicture->save($this->data)) {
				$this->Session->setFlash(__('The background picture has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The background picture could not be saved. Please, try again.', true));
			}
		}
		$backgrounds = $this->BackgroundPicture->Background->find('list');
		$this->set(compact('backgrounds'));
	}
	
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid background picture', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->BackgroundPicture->save($this->data)) {
				$this->Session->setFlash(__('The background picture has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The background picture could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->BackgroundPicture->read(null, $id);
		}
		$backgrounds = $this->BackgroundPicture->Background->find('list');
		$this->set(compact('backgrounds'));
	}
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for background picture', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->BackgroundPicture->delete($id)) {
			$this->Session->setFlash(__('Background picture deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Background picture was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	
	function admin_reOrder(){
    	foreach($this->data["Item"] as $id=>$position){
    		$this->BackgroundPicture->id=$id;
    		$this->BackgroundPicture->saveField("sort",$position); 
    	}
		echo true;
		Configure::write('debug', 0);
		$this->autoRender = false;
		exit();
	}

}
