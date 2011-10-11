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
<body>
	<div id="container">
		<a class="logo" href="#"></a>
		<?php echo $this->element('main_nav'); ?>
		<div style="clear: both"></div>
		<a class="logo_2y1"></a>
		<img class="ilustracion" src="/img/ilustracion.jpg"/>
		<div id="content">
			<h1>amarillo2</h1>
			<p>cada imagen es un pensamiento, un pequeño fragmento de historias cotidianas plasmadas sobre cartón. toma tu tiempo para leerlas.
			pensamientos que dejan huella,
			que se pueden compartir, tocar y oler.
			pensamientos de color amarillo, 
			¡dale color al tuyo!
			</p>
			<h1>descripción</h1>
			<p>reloj para pared hecho a mano con cartón y papel.
			Las manecillas de colores rompen de modo agradable el trazo de los anillos concéntricos y los ángulos que parecen casi hipnóticos de las diferentes carátulas, generando una armónica propuesta de diseño ideal para hogares y oficinas. Los relojes amarillo2 se presentan en un empaque perfecto para regalar.
			</p>
		</div>

	</div>	
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>