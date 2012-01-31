<?php
class VideosController extends AppController {

	public function index() {
		if (!empty($this -> data)) {
			$videos = $this -> Video -> search($this -> data);
			$this -> set(compact('videos'));
		}
	}

}
