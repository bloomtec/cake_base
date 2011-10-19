<?php
class ProductPicturesController extends AppController {

	var $name = 'ProductPictures';
	var $components = array('Attachment');
	function index($parentId) {
		$this->ProductPicture->recursive = 0;
				$this->set('productPictures', $this->paginate(array('product_id'=>$parentId)));
		$this->set('parent_id',$parentId);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid product picture', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->ProductPicture->recursive = 0;
				$this->set('productPictures', $this->paginate(array('product_id'=>$id)));
		$this->set('parent_id',$id);
					$parent=$this->ProductPicture->Product->read(null,$id); 
			 if (isset($parent['Product']['name'])){
			 	 $this->set('parentName',$parent['Product']['name']);
			}else{
			  if (isset($parent['Product']['title'])) $this->set('parentName',$parent['Product']['title']);
			}
			 
	}

	function add() {
		if (!empty($this->data)) {
			$this->ProductPicture->create();
			if ($this->ProductPicture->save($this->data)) {
				$this->Session->setFlash(__('The product picture has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product picture could not be saved. Please, try again.', true));
			}
		}
		$products = $this->ProductPicture->Product->find('list');
		$this->set(compact('products'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid product picture', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ProductPicture->save($this->data)) {
				$this->Session->setFlash(__('The product picture has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product picture could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ProductPicture->read(null, $id);
		}
		$products = $this->ProductPicture->Product->find('list');
		$this->set(compact('products'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product picture', true));
			$this->redirect(array('action'=>'index'));
		}
		$toDelete=$this->ProductPicture->read(null,$id);
		if ($this->ProductPicture->delete($id)) {
			$this->Session->setFlash(__('Product picture deleted', true));
						$this->redirect(array('action'=>'view',$toDelete['ProductPicture']['product_id']));
		}
		$this->Session->setFlash(__('Product picture was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product picture', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->ProductPicture->read(null,$id);
		$oldData["ProductPicture"]["active"]=false;
		if ($this->ProductPicture->save($oldData)) {
			$this->Session->setFlash(__('Product picture archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Product picture was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
	function setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product picture', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->ProductPicture->read(null,$id);
		$oldData["ProductPicture"]["active"]=true;
		if ($this->ProductPicture->save($oldData)) {
			$this->Session->setFlash(__('Product picture archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Product picture was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
	function requestFind($type,$findParams,$key) {
		if($key==Configure::read("key")){
			return $this->ProductPicture->find($type, $findParams);
		}else{
			return null;
		}
	}
	function uploadfy_add() {
			if($_POST["name"]&&$_POST["folder"]){
			if(isset($_POST['parent_id'])){
				$picture['ProductPicture']['product_id']=$_POST["parent_id"];
				$picture['ProductPicture']['path']=$_POST["name"];
				$this->ProductPicture->create();
				$this->ProductPicture->save($picture);
				echo $this->ProductPicture->id;
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
	function admin_index($parentId) {
		$this->ProductPicture->recursive = 0;
				$this->set('productPictures', $this->paginate(array('product_id'=>$parentId)));
		$this->set('parent_id',$parentId);
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid product picture', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->ProductPicture->recursive = 0;
				$this->set('productPictures', $this->paginate(array('product_id'=>$id)));
		$this->set('parent_id',$id);
					$parent=$this->ProductPicture->Product->read(null,$id); 
			 if (isset($parent['Product']['name'])){
			 	 $this->set('parentName',$parent['Product']['name']);
			}else{
			  if (isset($parent['Product']['title'])) $this->set('parentName',$parent['Product']['title']);
			}
			 
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->ProductPicture->create();
			if ($this->ProductPicture->save($this->data)) {
				$this->Session->setFlash(__('The product picture has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product picture could not be saved. Please, try again.', true));
			}
		}
		$products = $this->ProductPicture->Product->find('list');
		$this->set(compact('products'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid product picture', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ProductPicture->save($this->data)) {
				$this->Session->setFlash(__('The product picture has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product picture could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ProductPicture->read(null, $id);
		}
		$products = $this->ProductPicture->Product->find('list');
		$this->set(compact('products'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product picture', true));
			$this->redirect(array('action'=>'index'));
		}
		$toDelete=$this->ProductPicture->read(null,$id);
		if ($this->ProductPicture->delete($id)) {
			$this->Session->setFlash(__('Product picture deleted', true));
						$this->redirect(array('action'=>'view',$toDelete['ProductPicture']['product_id']));
		}
		$this->Session->setFlash(__('Product picture was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_setInactive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product picture', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->ProductPicture->read(null,$id);
		$oldData["ProductPicture"]["active"]=false;
		if ($this->ProductPicture->save($oldData)) {
			$this->Session->setFlash(__('Product picture archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Product picture was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_setActive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product picture', true));
			$this->redirect(array('action'=>'index'));
		}
		$oldData=$this->ProductPicture->read(null,$id);
		$oldData["ProductPicture"]["active"]=true;
		if ($this->ProductPicture->save($oldData)) {
			$this->Session->setFlash(__('Product picture archived', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Product picture was not archived', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_requestFind($type,$findParams,$key) {
		if($key==Configure::read("key")){
			return $this->ProductPicture->find($type, $findParams);
		}else{
			return null;
		}
	}
	function admin_uploadfy_add() {
			if($_POST["name"]&&$_POST["folder"]){
			if(isset($_POST['parent_id'])){
				$picture['ProductPicture']['product_id']=$_POST["parent_id"];
				$picture['ProductPicture']['path']=$_POST["name"];
				$this->ProductPicture->create();
				$this->ProductPicture->save($picture);
				echo $this->ProductPicture->id;
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
}
