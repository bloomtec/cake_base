<?php
class ImagesController extends AppController {

	var $name = 'Images';
	var $components = array('Attachment');
	var $uses=array();
	function resizeImage(){
		
		$this->autoRender = false;
		Configure::write("debug", 0);
			
		if($_POST["name"] && $_POST["folder"]) {
			
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
			echo true;
		}else{
			echo false;
		}
		
		exit(0);
	}
	
}
