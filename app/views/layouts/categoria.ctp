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
	<?php echo $this -> Html -> charset();?>
		<title><?php
		$model = $this -> params['models'][0];
		$singularVar = strtolower($model);
		if (isset(${$singularVar}[$model]['name'])) {
			echo ${$singularVar}[$model]['name'];
		} else {
			echo $title_for_layout;
		}
			?></title>
		<?php
		if (isset(${$singularVar}[$model]['keywords']))
			echo $this -> Html -> meta('keywords', ${$singularVar}[$model]['keywords']);
		if (isset(${$singularVar}[$model]['description']))
			echo $this -> Html -> meta('keywords', ${$singularVar}[$model]['description']);
		echo $this -> Html -> meta('icon');
		echo $this -> Html -> css('reset.css');
		echo $this -> Html -> css('ie.css');
		echo $this -> Html -> css('styles.css');
		echo $this -> Html -> css('/bcart/css/bcart.css');
		echo $this -> Html -> css('users.css');
		echo $this -> Html -> script('jquery');
		echo $this -> Html -> script('jquery.tools.min');
		echo $this -> Html -> script('bjs');
		echo $this -> Html -> script('/bcart/js/bcart');
		echo $this -> Html -> script('front');
		echo $scripts_for_layout;
		?>
		<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
	
</head>
<body id="categoria">
	
	<?php echo $this->element("header");?> 		
    <div id="container">
    	<div id="second_nav">
	    	<div id="producto_destacado" class="border_radius" rel='<?php echo $tag['Tag']['id'] ?>'>
	    		
		
        	</div>
        	 <div id="listado_fltro" class="border_radius" rel='<?php echo $tag['Tag']['id'] ?>'>
        	 	
        	</div>
    	</div>
    	<div id="main_content">
    		<?php if(isset($slides) && !empty($slides)) echo $this->element('slider',array('slides'=>$slides,'model'=>'TagSlider'));?>
    			
    	
        	<div id="content" class="border_radius">
        	<?php echo $content_for_layout; ?>
        	</div>
    		
    	</div>
 
    </div>
   	<?php echo $this->element("footer");?> 
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>