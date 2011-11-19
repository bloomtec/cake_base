<?php
App::import('Core', 'Router');
class DealRoute extends CakeRoute {
	public function match($url) {
		return parent::match($url);
	}

	public function parse($url) {
		$params = parent::parse($url);
		if(isset($params['_args_'])) $params['_args_']=substr($url, 1);
		/*if (!empty($params) && $this -> _exists($params['userName'])) {
			return $params;
		}*/
		return  $params;//false;
	}

	

}
?>
