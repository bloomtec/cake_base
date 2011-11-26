<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
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
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */
	//PAGINAS
	Router::connect('/', array('controller' => 'pages', 'action' => 'view', 'inicio'));
	Router::connect('/empresa', array('controller' => 'pages', 'action' => 'view', 'empresa'));
	Router::connect('/contacto', array('controller' => 'pages', 'action' => 'contacto'));
	Router::connect('/servicios', array('controller' => 'pages', 'action' => 'view', 'servicios'));
	Router::connect('/proceso-de-pago', array('controller' => 'pages', 'action' => 'view', 'proceso-de-pago'));
	Router::connect('/politicas-de-garantia', array('controller' => 'pages', 'action' => 'view', 'politicas-de-garantia'));
	Router::connect('/quienes-somos', array('controller' => 'pages', 'action' => 'view', 'quienes-somos'));
	Router::connect('/preguntas-frecuentes', array('controller' => 'faqs', 'action' => 'index'));
	
	//CATEGORIAS
	Router::connect('/categorias/*', array('controller' => 'tags', 'action' => 'view'));
	//PRODUCTOS
	Router::connect('/productos/*', array('controller' => 'products', 'action' => 'view'));
	
	//ADMIN
	Router::connect('/admin', array('controller' => 'users', 'action' => 'login', "admin" => true));
	
	//BCART
	Router::connect('/bcart/view', array('controller' => 'shopCarts', 'action' => 'viewCart','plugin'=>'bcart'));
	
	//ARMA TU PC
	Router::connect('/mi-pc', array('controller' => 'makePc', 'action' => 'armaTuComputador'));
	
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	//Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
