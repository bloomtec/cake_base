<?php
class UsersController extends AppController {

	var $name = 'Users';
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('register');
	}

	function login() {
		
	}
	
	function admin_login() {
		
	}
	
	function logout() {
		
	}
	
	function register() {
		
	}

}
