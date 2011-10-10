<?php
class ImagesController extends AppController {

	var $name = 'Images';
	var $components = array('Attachment');
	var $uses=array();
	function resizeImage(){
		
		$this->autoRender = false;
		Configure::write("debug", 0);
			
		if($_POST["name"]) {
			if($_POST["name"]!="defaul-image-profile.jpg"&&$_POST["name"]!="default-image-team.png"){
				$this->Attachment->resize_image(
					"resize",
					"img/uploads/" . $_POST["name"],
					"img/uploads/50x50",
					$_POST["name"],
					50,
					50
				);
				$this->Attachment->resize_image(
					"resize",
					"img/uploads/" . $_POST["name"],
					"img/uploads/100x100",
					$_POST["name"],
					100,
					100
				);
				$this->Attachment->resize_image(
					"resize",
					"img/uploads/" . $_POST["name"],
					"img/uploads/200x200",
					$_POST["name"],
					200,
					200
				);
				$this->Attachment->resize_image(
					"resize",
					"img/uploads/" . $_POST["name"],
					"img/uploads/400x400",
					$_POST["name"],
					400,
					400
				);
				$this->Attachment->resize_image(
					"resize",
					"img/uploads/" . $_POST["name"],
					"img/uploads/640x480",
					$_POST["name"],
					640,
					480
				);
				$this->Attachment->resize_image(
					"resize",
					"img/uploads/" . $_POST["name"],
					"img/uploads/custom",
					$_POST["name"],
					Configure::read("custom_width"),
					Configure::read("custom_height")
				);
			}			
			echo true;
		}else{
			echo false;
		}
		
		exit(0);
	}
	function deleteImage(){
		
		$this->autoRender = false;
		Configure::write("debug", 0);
			
		if($_POST["name"]) {
			$filename=$_POST["name"];
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
			echo true;
		}else{
			echo false;
		}
		
		exit(0);
	}
 	function admin_wysiwyg(){//ESTA FUNCION MUESTRA EL LISTADO DE LAS IMAGENES SUBIDAS POR EL WYSIWYG
	    $this->layout="file_browser";
	    App::import("Folder");
	    $folder= new Folder(WWW_ROOT.DS."wysiwyg");
	    $this->set("folder",$folder->read());
	    $this->set("folderPath",DS."wysiwyg");
  }
	
}
