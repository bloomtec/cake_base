<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @subpackage    cake.cake.libs.model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application model for Cake.
 *
 * This is a placeholder class.
 * Create the same file in app/app_model.php
 * Add your application-wide methods to the class, your models will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.model
 */
class AppModel extends Model {

	function afterSave($created) {
		if (isset($this -> actsAs)) {
			if ($created) {
				$languages = Configure::read('Config.languages');
				$currentLanguage = $this -> locale;
				foreach ($languages as $key => $lang) {
					if ($key == $currentLanguage)
						continue;
					$this -> locale = $key;
					$this -> data[$this -> name]['locale'] = $key;
					$this -> data[$this -> name]['id'] = $this -> id;
					$this -> save($this -> data);
				}
				$this -> locale = $currentLanguage;
			}
		}
		return true;
	}

}
