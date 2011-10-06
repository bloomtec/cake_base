<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @link http://book.cakephp.org/view/957/The-App-Controller
 */
class AppController extends Controller {
	var $components = array('Auth', 'Acl', 'Session');
	
	function beforeFilter() {
		if(isset($this->params["prefix"]) && $this->params["prefix"] == "admin"){
			$this->layout="bloom";
			$this->Auth->loginRedirect =array("controller"=>"pages","action"=>"ez","admin"=>true);
			$this->Auth->deny($this->action);
		} else {
			$this->Auth->allow($this->action);
		}
		/**
		 * Cookie
		 * $this->Cookie->name = 'Colors';
		 * $this->Cookie->time = '5 Days'; // or '1 hour'
		 * $this->Cookie->path = '/';
		 * $this->Cookie->domain = 'localhost';
		 * $this->Cookie->secure = false; //i.e. only sent if using secure HTTPS
		 * $this->Cookie->key = 'sfWQAFgg5as57ees344ddhyuj31sXOw!';
		 * $this->Cookie->write('_data', $this->Session->read('Auth.User.id'));
		 * $user_id = $_COOKIE["_data"];
		*/
	}
	
	function getList(){
		$modelName=$this->modelNames[0];
		return $this->$modelName->find("list");
	}
	
}