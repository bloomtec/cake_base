<?php
class AppController extends Controller {
	
	var $components = array(
		'Session',
		'Auth' => array(
			'fields' => array(
				'username' => 'email',
				'password' => 'password'
			)
		)
	);
	
	function beforeFilter() {
		if(isset($this->params["prefix"]) && $this->params["prefix"] == "admin"){
			$this->layout="ez";
			$this->Auth->loginRedirect = array("controller" => "pages", "action" => "ez", "admin" => true);
			$this->Auth->deny($this->action);
		} else {
			$this->Auth->allow($this->action);
		}
	}
	
	function getList(){	
		return $this->$this->modelNames[0]->find("list");
	}
	
}
