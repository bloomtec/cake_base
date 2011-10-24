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
	<div id="comentario">
		<a class="icono"></a>
		<form>
			<label><span>*</span>Nombre:</label>
			<input type="text" required="required" />
			<label><span>*</span>E-mail:</label>
			<input type="email" required="required" />
			<label><span>*</span>Comentario:</label>
			<textarea required="required"></textarea>
			<input type="checkbox" class="check_box"/>
			<label class="newslwtter">Suscribirme al newsletter de BLOOMWEB</label>
			<input type="submit" class="submit" value=""/>
		</form>
		<p>
			Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut 
		</p>
	</div>
	<div id="header">
		<div class="menu_wrapper">
		<ul>
			<li><a href="#" >INICIO<span>Quienes somos</span></a> </li>
			<li><a href="#" >SERVICIOS<span>Lo que ofrecemos</span></a> 
				<ul class="desplegable">
					<li>
						<div class="imagen_menu">
							<a href=""><img  src="/img/movil_menu.jpg"/></a>
							<div style="clear: both"></div>
						</div>
						<div class="titulos_wrapper">
							<a href="">Aplicaciones Móviles</a>
							<br />
							<span>slogan del servicio</span>
						</div>
						
					</li>
					<li>
						<div class="imagen_menu">
							<a href=""><img  src="/img/e-shop_menu.jpg"/></a>
							<div style="clear: both"></div>
						</div>
						<div class="titulos_wrapper">
							<a href="">Tiendas Virtuales</a>
							<br />
							<span>slogan del servicio</span>
						</div>
						
					</li>
					<li>
						<div class="imagen_menu">
							<a href=""><img src="/img/diseno-flexible-menu.jpg"/></a>
							<div style="clear: both"></div>
						</div>
						<div class="titulos_wrapper">
							<a href="">Diseño Web a la Medida</a>
							<br />
							<span>slogan del servicio</span>
						</div>
						
					</li>
					<li>
						<div class="imagen_menu">
							<a href=""><img src="/img/blog.png" /></a>
							<div style="clear: both"></div>
						</div>
						<div class="titulos_wrapper">
							<a href="">Blog</a>
							<br />
							<span>slogan del servicio</span>
						</div>
						
					</li>
				</ul>	
			</li>
			<li><a href="#" >CLIENTES<span>Que hacemos</span></a> </li>
			<!--
			<li><a href="#" >PROCESOS<span>Como lo hacemos</span></a> </li>
			-->
			<li><a href="#" >BLOG<span>Ninja master</span></a> </li>
			
		</ul>
		<h1></h1>
		</div>
	</div>
	<div id="container">
		<div id="slide">
		</div>		
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>
			<?php echo $this -> element("blog");?>

		</div>
		<div id="footer">
			<ul>
				<li><h1></h1></li>
				<li>
					<h2>Info:</h2>
					<p>Teléfono: 326 59 68</p>
					<p>Celular: 301 356 5896</p>
					<p>Dirección:</p>
					<p>E-mail: gerencia@blooweb.co</p>
				</li>
				<li>
					<ul class="redes">
						<li><a class="facebook" href="#" title="Página de Facebook">facebook</a></li>
						<li><a class="twitter" href="#" title="Sígenos en Twitter">twitter</a></li>
					</ul>
				</li>
				
			</ul>
		</div>


	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>