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
		echo $this->Html->css('styles.css');
		echo $this->Html->css('ie.css');
		echo $this->Html->script('jquery');
		echo $this->Html->script('cufon-yui');
		echo $this->Html->script('HaloHandLetter_500.font');
		echo $this->Html->script('Japan_500.font');
		echo $this->Html->script('TwCenMt_400.font');
		echo $this->Html->script('Tahoma_400.font');
		echo $this->Html->script('front');

		echo $scripts_for_layout;
	?>
</head>
<body id="pages">
<div id="container">
		<?php echo $this->element("header");?>    
		<div id="content">
			<ul class="nav_estaticas twCenMt">
				<li><a href="/pages/nosotros">NOSOTROS</a></li>
				<li><a href="#">TIENDAS</a></li>
				<li><a href="/pages/ayuda">AYUDA</a></li>
				<li><a href="/pages/contacto">CONTACTO</a></li>
			</ul>
			<div style="clear: both"></div>
			<?php echo $this->Session->flash(); ?>
			<?php echo $content_for_layout; ?>
			<div class="social_estaticas">
				<h3 class="subtitulos_gris twCenMt">Visita nuestra</h3>
                <h1 class="fan_page twCenMt"><a href="#">fans page</a></h1>
			</div>
			<div class="social_estaticas">
				<h2 class="titulos_rosado twCenMt">Síguenos también en</h2>
                <ul class="social">
                	<li><a class="facebook" href="#">facebook</a></li>
                    <li><a class="twitter" href="#">twitter</a></li>
                </ul>
			</div>
			<div class="social_estaticas">
				<h3 class="subtitulos_gris tahoma">DISFRUTA DE NUESTRO GRUPO EN BLACKBERRY</h3>
                <p>Agrega nuestro pin 26C8DFF8 <br />y conoce las promociones desde tu móvil.
                </p>
			</div>
			<div style="clear: both"></div>


		</div>
		<?php echo $this->element("footer");?>
		
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>