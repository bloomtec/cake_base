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
		<?php
		$model = $this -> params['models'][0];
		$singularVar = strtolower($model);
		if (isset(${$singularVar}[$model]['name'])) {
			echo ${$singularVar}[$model]['name'];
		} else {
			echo $title_for_layout;
		}
			?>
		</title>
		<?php
		if (isset(${$singularVar}[$model]['keywords'])) echo $this -> Html -> meta('keywords', ${$singularVar}[$model]['keywords']);
		if (isset(${$singularVar}[$model]['description'])) echo $this -> Html -> meta('keywords', ${$singularVar}[$model]['description']);
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
	<div id="trama_menu"></div>
	<div id="container">
		
		<div id="header">
			<ul id="main_nav">
				<li class="primero"><a href="">INICIO</a></li>
				<li><a href="">PRODUCTOS</a></li>
				<li class="ultimo"><a href="">NOVEDADES</a></li>
				<div style="clear: both"></div>
			</ul>
			<div class="destacado">
				<div class="producto_destacado">
					<a href=""><img src="/img/juego.jpg" /></a>
					<p>
						Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
					</p>
					<span class="precio">$120.000</span>
					<a class="comprar" href="#"></a>
					
				</div>
				<div class="producto_destacado segundo">
					<a href=""><img src="/img/juego.jpg" /></a>
					<p>
						Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
					</p>
					<span class="precio">$120.000</span>
					<a class="comprar" href="#"></a>
					
				</div>
				<div class="producto_destacado">
					<a href=""><img src="/img/juego.jpg" /></a>
					<p>
						Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
					</p>
					<span class="precio">$120.000</span>
					<a class="comprar" href="#"></a>
					
				</div>
				
			</div>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					"developed by:".$this->Html->image('bloom_negro.png', array('alt'=> __('Bloom Web Company'), 'border' => '0')),
					'http://www.bloomweb.co/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>