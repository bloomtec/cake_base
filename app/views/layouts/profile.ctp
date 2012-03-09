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
		<?php echo $this -> Html -> charset(); ?>
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
			echo $this -> Html -> meta('icon');
			
			echo $this -> Html -> css('reset.css');
			echo $this -> Html -> css('ie.css');
			echo $this -> Html -> css('users.css');
			echo $this -> Html -> css('styles.css');
			echo $this -> Html -> css('uploadify');
			echo $this -> Html -> css('/bcart/css/bcart.css');		
			
			echo $this -> Html -> script('jquery');
			echo $this -> Html -> script('jquery.tools.min');
			echo $this -> Html -> Script("swfobject");
			echo $this -> Html -> Script("jquery.uploadify.v2.1.4.min");
			echo $this -> Html -> script('upload');
			echo $this -> Html -> script('bjs');
			//echo $this -> Html -> script('/bcart/js/bcart');
			echo $this -> Html -> script('front');
	
			echo $scripts_for_layout;
		?>
	</head>
	<body id="profile">
		<?php 
			if($this -> Session -> read('Auth.User.id')){
				echo $this -> element('score-box');
			}
		?>
		<div id="container">
			<?php echo $this->element('header'); ?>
			<div id="content">
				<?php echo $this->element('menu_usuario'); ?>
				<div class="wrapperContent">
				<?php echo $this->Session->flash(); ?>
	
				<?php echo $content_for_layout; ?>
				</div>
				<div style="clear: both"></div>	
			</div>
			<div id="footer">
				<div class="wrapper">
					<div class="izquierda">
						<h1>Políticas</h1>
						<p>
							Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
							<br /> nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.
						</p>
						<div style="clear: both"></div>
						<a href="#">Nuestra empresa</a>
						<a href="#">¿Tienes alguna sugerencia, queja o reclamo?</a>
						<a href="#">Contáctenos</a>
					</div>
					<div class="derecha">
						<h1>Recomienda esta página a tus amigos</h1>
						<a href="#"><img src="/img/facebook.png" /></a>
						<a href="#"><img src="/img/twitter.png" /></a>
					</div>
					<a class="volver_arriba" href="#">Volver Arriba</a>
					<div style="clear: both"></div>
				</div>
			</div>
		</div>
		<?php echo $this->element('sql_dump'); ?>
	</body>
</html>