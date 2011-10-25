<?php
class GalleryPicturesController extends AppController {

	var $name = 'GalleryPictures';
	var $components = array('Attachment');	
	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}
	
	function index() {
		$this->GalleryPicture->recursive = 0;
		$this->set('galleryPictures', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid gallery picture', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->GalleryPicture->recursive = 0;
				$this->set('galleryPictures', $this->GalleryPicture->find('all',array('conditions'=>array('gallery_id'=>$id))));
		$this->set('parent_id',$id);
					$parent=$this->GalleryPicture->Gallery->read(null,$id); 
			 if (isset($parent['Gallery']['name'])){
			 	 $this->set('parentName',$parent['Gallery']['name']);
			}else{
			  if (isset($parent['Gallery']['title'])) $this->set('parentName',$parent['Gallery']['title']);
			}		 
	}
	
	
	function admin_index() {
		$this->GalleryPicture->recursive = 0;
		$this->set('galleryPictures', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid gallery picture', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->GalleryPicture->recursive = 0;
				$this->set('galleryPictures', $this->GalleryPicture->find('all',array('conditions'=>array('gallery_id'=>$id))));
		$this->set('parent_id',$id);
					$parent=$this->GalleryPicture->Gallery->read(null,$id); 
			 if (isset($parent['Gallery']['name'])){
			 	 $this->set('parentName',$parent['Gallery']['name']);
			}else{
			  if (isset($parent['Gallery']['title'])) $this->set('parentName',$parent['Gallery']['title']);
			}		 
	}
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->GalleryPicture->create();
			if ($this->GalleryPicture->save($this->data)) {
				$this->Session->setFlash(__('The gallery picture has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The gallery picture could not be saved. Please, try again.', true));
			}
		}
		$galleries = $this->GalleryPicture->Gallery->find('list');
		$this->set(compact('galleries'));
	}
	
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid gallery picture', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->GalleryPicture->save($this->data)) {
				$this->Session->setFlash(__('The gallery picture has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The gallery picture could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->GalleryPicture->read(null, $id);
		}
		$galleries = $this->GalleryPicture->Gallery->find('list');
		$this->set(compact('galleries'));
	}
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for gallery picture', true));
			$this->redirect(array('action'=>'index'));
		}
		$toDelete=$this->GalleryPicture->read(null,$id);
		if ($this->GalleryPicture->delete($id)) {
			$this->Session->setFlash(__('Gallery picture deleted', true));
						$this->redirect(array('action'=>'view',$toDelete['GalleryPicture']['gallery_id']));
		}
		$this->Session->setFlash(__('Gallery picture was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	
	function admin_reOrder(){
    	foreach($this->data["Item"] as $id=>$position){
    		$this->GalleryPicture->id=$id;
    		$this->GalleryPicture->saveField("sort",$position); 
    	}
		echo true;
		Configure::write('debug', 0);
		$this->autoRender = false;
		exit();
	}
	
	function admin_uploadfy_add() {
			if($_POST["name"]&&$_POST["folder"]){
			if(isset($_POST['parent_id'])){
				$picture['GalleryPicture']['gallery_id']=$_POST["parent_id"];
				$picture['GalleryPicture']['path']=$_POST["name"];
				$this->GalleryPicture->create();
				$this->GalleryPicture->save($picture);
				echo $this->GalleryPicture->id;
			}else{
				
				echo false;
			}
			
		}else{function admin_uploadfy_add() {
			if($_POST["name"]&&$_POST["folder"]){
			if(isset($_POST['parent_id'])){
				$picture['GalleryPicture']['gallery_id']=$_POST["parent_id"];
				$picture['GalleryPicture']['path']=$_POST["name"];
				$this->GalleryPicture->create();
				$this->GalleryPicture->save($picture);
				echo $this->GalleryPicture->id;
			}else{
				
				echo false;
			}
			
		}else{
			echo false;
		}
		
		Configure::write("debug",0);
		$this->autoRender=false;
		exit(0);
	}
			echo false;
		}
		Configure::write("debug",0);
		$this->autoRender=false;
		exit(0);
	}

}
