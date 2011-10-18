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
		echo $this -> Html -> css('styles.css');
		echo $this -> Html -> css('ie.css');
		echo $this -> Html -> script('jquery');
		echo $this -> Html -> script('jquery.tools.min');
		echo $this -> Html -> script('cufon-yui');
		echo $this -> Html -> script('HaloHandLetter_500.font');
		echo $this -> Html -> script('Japan_500.font');
		echo $this -> Html -> script('TwCenMt_400.font');
		echo $this -> Html -> script('Tahoma_400.font');
		echo $this -> Html -> script('front');

		echo $scripts_for_layout;
		?>
	</head>
	<body id="home">
		<div id="container">
			<?php echo $this -> element("header");?>
			<div id="content">
				<?php echo $this -> Session -> flash();?>
				<form class="buscador" name="buscador">
					<span class="subtitulos_gris twCenMt">&iquest;NECESITAS ALGO ESPEC&Iacute;FICO? UTILIZA NUESTRO BUSCADOR</span>
					<input placeholder="BUSCAR" type="text" />
					<input type="submit" value="Ir" />
					&nbsp;
				</form>
				<div style="clear:both">
				</div>
				<?php echo $content_for_layout;?>
			</div>
			<?php echo $this -> element("footer");?>

			<?php echo $this -> element('sql_dump');?>
			<div class="apple_overlay" id="overlay2">
				<!-- the external content is loaded inside this tag -->
				<div class="contentWrap"></div>
			</div>
	</body>
</html>