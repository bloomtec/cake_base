<?php
App::import('Core', 'HttpSocket');
class Video extends AppModel {
	public $useTable = false;
	protected $_httpSocket;
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		$this -> _httpSocket = new HttpSocket();
	}

	public function search($data) {
		$query = !empty($data[$this -> alias]['q']) ? $data[$this -> alias]['q'] : '';
		$this -> _httpSocket -> reset();
		$response = $this -> _httpSocket -> get('http://gdata.youtube.com/feeds/api/videos', array('v' => '2', 'alt' => 'jsonc', 'q' => $query, 'orderby' => 'updated'));
		$videos = array();
		if (!empty($response)) {
			$response = json_decode($response);
			if (empty($response) || empty($response -> data -> items)) {
				return $videos;
			}
			foreach ($response->data->items as $item) {
				$videos[] = array('Video' => array('url' => $item -> player -> default, 'title' => $item -> title, 'uploaded' => strtotime($item -> uploaded), 'category' => $item -> category, 'description' => $item -> description, 'thumbnail' => $item -> thumbnail -> sqDefault));
			}
		}
		return $videos;
	}

}
?>