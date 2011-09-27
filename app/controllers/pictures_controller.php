<?php
class PicturesController extends AppController {

	var $name = 'Pictures';
	var $components = array('Attachment');

	function index() {
		$this -> Picture -> recursive = 0;
		$this -> set('pictures', $this -> paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid picture', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('picture', $this -> Picture -> read(null, $id));
	}
	
	function getBackground() {
		// si esta logeuado devuelve una imagen el album members id=2
		// si no está logueado devuelve una imagen del album publico id=1
		$image="";
		if ($this -> Auth -> user()) {//logueado
			$image = $this -> Picture -> find("first", array("order" =>'RAND()', "conditions" => array("gallery_id" => 2)));
		} else {
			$image = $this -> Picture -> find("first", array("order" => 'RAND()', "conditions" => array("gallery_id" => 1)));
		}
		echo json_encode($image);
		$this->autoRender=false;
		exit(0);

	}
	function getBackgrounds() {
		// si esta logeuado devuelve el album members id=2
		// si no está logueado devuelve el album publico id=1
		$image="";
		$imagenes=array();
		if ($this -> Auth -> user()) {//logueado
			$image = $this -> Picture -> find("all", array( "conditions" => array("gallery_id" => 2)));
			foreach($image as $pic){
				$imagenes[]["image"]="/img/uploads/".$pic["Picture"]["image"];
			}
		} else {
			$image = $this -> Picture -> find("all", array("conditions" => array("gallery_id" => 1)));
			foreach($image as $pic){
				$imagenes[]["image"]="/img/uploads/".$pic["Picture"]["image"];
			}
		}
		return $imagenes;
	

	}
	function add() {
		if (!empty($this -> data)) {
			$this -> Picture -> create();
			if ($this -> Picture -> save($this -> data)) {
				$this -> Session -> setFlash(__('The picture has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The picture could not be saved. Please, try again.', true));
			}
		}
		$galleries = $this -> Picture -> Gallery -> find('list');
		$this -> set(compact('galleries'));
	}
	function uploadfy_add() {
		if($_POST["name"]&&$_POST["folder"]){
			// Datos dados por Felipe son:
			// thumbs --> 180x135
			// caratulas --> 392x243
			// grandes --> 625x467
			$this->Attachment->resize_image("resize","img/".$_POST["folder"]."/".$_POST["name"],"img/".$_POST["folder"]."/50x50",$_POST["name"],50,50);
			$this->Attachment->resize_image("resize","img/".$_POST["folder"]."/".$_POST["name"],"img/".$_POST["folder"]."/100x100",$_POST["name"],100,100);
			$this->Attachment->resize_image("resize","img/".$_POST["folder"]."/".$_POST["name"],"img/".$_POST["folder"]."/200x200",$_POST["name"],200,200);
			$this->Attachment->resize_image("resize","img/".$_POST["folder"]."/".$_POST["name"],"img/".$_POST["folder"]."/400x400",$_POST["name"],400,400);
			$this->Attachment->resize_image("resize","img/".$_POST["folder"]."/".$_POST["name"],"img/".$_POST["folder"]."/640x480",$_POST["name"],640,480);
			$this->Attachment->resize_image("resize","img/".$_POST["folder"]."/".$_POST["name"],"img/".$_POST["folder"]."/custom",$_POST["name"],Configure::read("custom_width"),Configure::read("custom_height"));
			if(isset($_POST["galleryId"])){
				$picture["Picture"]["gallery_id"]=$_POST["galleryId"];
				$picture["Picture"]["image"]=$_POST["name"];
				$this->Picture->create();
				$this->Picture->save($picture);
				echo $this->Picture->id;
			}else{
				echo true;
			}
			
		}else{
			echo false;
		}
		
		Configure::write("debug",0);
		$this->autoRender=false;
		exit(0);
	}
	function edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid picture', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Picture -> save($this -> data)) {
				$this -> Session -> setFlash(__('The picture has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The picture could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Picture -> read(null, $id);
		}
		$galleries = $this -> Picture -> Gallery -> find('list');
		$this -> set(compact('galleries'));
	}

	function delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for picture', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Picture -> delete($id)) {
			$this -> Session -> setFlash(__('Picture deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Picture was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for picture', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Picture -> read(null, $id);
		$oldData["Picture"]["active"] = false;
		if ($this -> Picture -> save($oldData)) {
			$this -> Session -> setFlash(__('Picture archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Picture was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for picture', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Picture -> read(null, $id);
		$oldData["Picture"]["active"] = true;
		if ($this -> Picture -> save($oldData)) {
			$this -> Session -> setFlash(__('Picture archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Picture was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> Picture -> find($type, $findParams);
		} else {
			return null;
		}
	}

	function admin_index() {
		$this -> Picture -> recursive = 0;
		$this -> set('pictures', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid picture', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('picture', $this -> Picture -> read(null, $id));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> Picture -> create();
			if ($this -> Picture -> save($this -> data)) {
				$this -> Session -> setFlash(__('The picture has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The picture could not be saved. Please, try again.', true));
			}
		}
		$galleries = $this -> Picture -> Gallery -> find('list');
		$this -> set(compact('galleries'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid picture', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Picture -> save($this -> data)) {
				$this -> Session -> setFlash(__('The picture has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The picture could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Picture -> read(null, $id);
		}
		$galleries = $this -> Picture -> Gallery -> find('list');
		$this -> set(compact('galleries'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for picture', true));
			$this->redirect($this->referer());
		}
		$picture=$this->Picture->read(null,$id);
		if ($this -> Picture -> delete($id)) {
			$this -> Session -> setFlash(__('Picture deleted', true));
			$filename=$picture["Picture"]["image"];
			if (is_file(WWW_ROOT.'img'.DS.'uploads'.DS.$filename)) {
				unlink(WWW_ROOT.'img'.DS.'uploads'.DS.$filename);
			}
			if (is_file(WWW_ROOT.'img'.DS.'uploads'.DS.'50x50'.DS.$filename)) {
				unlink(WWW_ROOT.'img'.DS.'uploads'.DS.'50x50'.DS.$filename);
			}
			if (is_file(WWW_ROOT.'img'.DS.'uploads'.DS.'100x100'.DS.$filename)) {
				unlink(WWW_ROOT.'img'.DS.'uploads'.DS.'100x100'.DS.$filename);
			}

			if (is_file(WWW_ROOT.'img'.DS.'uploads'.DS.'200x200'.DS.$filename)) {
				unlink(WWW_ROOT.'img'.DS.'uploads'.DS.'200x200'.DS.$filename);
			}
			if (is_file(WWW_ROOT.'img'.DS.'uploads'.DS.'400x400'.DS.$filename)) {
				unlink(WWW_ROOT.'img'.DS.'uploads'.DS.'400x400'.DS.$filename);
			}
			if (is_file(WWW_ROOT.'img'.DS.'uploads'.DS.'640x480'.DS.$filename)) {
				unlink(WWW_ROOT.'img'.DS.'uploads'.DS.'640x480'.DS.$filename);
			}
			if (is_file(WWW_ROOT.'img'.DS.'uploads'.DS.'custom'.DS.$filename)) {
				unlink(WWW_ROOT.'img'.DS.'uploads'.DS.'custom'.DS.$filename);
			}	
			$this->redirect($this->referer());
		}
		$this -> Session -> setFlash(__('Picture was not deleted', true));
		$this->redirect($this->referer());
	}

	function admin_setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for picture', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Picture -> read(null, $id);
		$oldData["Picture"]["active"] = false;
		if ($this -> Picture -> save($oldData)) {
			$this -> Session -> setFlash(__('Picture archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Picture was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for picture', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Picture -> read(null, $id);
		$oldData["Picture"]["active"] = true;
		if ($this -> Picture -> save($oldData)) {
			$this -> Session -> setFlash(__('Picture archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Picture was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> Picture -> find($type, $findParams);
		} else {
			return null;
		}
	}

}
