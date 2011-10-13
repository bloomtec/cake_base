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
		<title><?php __('Web site:');?>
			<?php echo $title_for_layout;?></title>
		<?php
		echo $this -> Html -> meta('icon');
		echo $this -> Html -> css('reset.css');
		echo $this -> Html -> css('ie.css');
		echo $this -> Html -> css('styles.css');
		echo $this -> Html -> script('jquery');
		echo $this -> Html -> script('front');

		echo $scripts_for_layout;
		?>
	</head>
	<body id="aplicacion">
		<div id="container" class="posicion">
			<div id="header">
				<a class="logo" href="/pages/home"></a>
				<?php echo $this -> element('main_nav_aplicacion');?>
				<div style="clear: both"></div>
			</div>
			<div id="content">
				<?php echo $content_for_layout;?>
			</div>
		</div>
		<div id="background" class="posicion">
			<img src="/img/uploads/caratula1.jpg"/>
		</div>
		<div id="minuteros" class="posicion">
			<img src="/img/minutero1.png" />
		</div>
		<div id="horarios" class="posicion">
			<img src="/img/horario1.png" />
		</div>
		<?php echo $this -> element('sql_dump');?>
	</body>
</html>