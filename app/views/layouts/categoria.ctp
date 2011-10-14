<?php
/**
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
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php __('Web site:'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('reset.css');
		echo $this->Html->css('ie.css');
		echo $this->Html->css('styles.css');
		echo $this->Html->script('jquery');
		echo $this->Html->script('front');

		echo $scripts_for_layout;
	?>
</head>
<body id="categoria">
	
	<?php echo $this->element("header");?> 		
    <div id="container">
    	<div id="second_nav">
	    	<div id="producto_destacado" class="border_radius">
	    		<h1>Computador portátil hp Core i5 
				pantalla de 20”
				</h1>
				<img src="/img/producto_destacado.jpg" />
				<div class="info_destacado">
					<p>
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat 
					</p>
					<a href=""><img src="/img/facebook.png" /></a>
					<a href=""><img src="/img/twitter.png" /></a>
					<a href=""><img src="/img/btn_agregar.png"/></a>
					<?php echo $this->element("estrellas_categoria");?> 
				</div>
        	</div>
        	 <div id="listado_fltro" class="border_radius">
        	 	<h1>Buscar por:</h1>
        		<ul>
        			<li></li>
        		</ul>
        	</div>
    	</div>
    	<div id="main_content">
    		<div id="slide" class="border_radius">
    			
    			
    		</div>
        	<div id="content" class="border_radius">
        	<?php echo $content_for_layout; ?>
        	</div>
    		
    	</div>
 
    </div>
   	<?php echo $this->element("footer");?> 
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>