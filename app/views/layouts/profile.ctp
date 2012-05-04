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
		<meta property="og:title" content="<?php __('Este es el titulo')?>" />
		<meta property="og:description" content="<?php __('Este es la descipcion')?>" />
		<meta property="og:image" content="http://clickneat.bloomweb.co/img/logo_header.png" />
	</head>
	<body id="profile">
		<?php
		if ($this -> Session -> read('Auth.User.id')) {
			echo $this -> element('score-box');
		}
		?>
		<div id="container">
			<?php echo $this -> element('header');?>
			<div id="content">
				<?php echo $this -> element('filtros-2'); ?>
				
				<div class="wrapperContent <?php echo $class; ?>">
					<?php echo $this -> element('menu_usuario');?>
					<?php echo $this -> Session -> flash(); ?>

					<?php echo $content_for_layout; ?>
				</div>
				<div style="clear: both"></div>
			</div>
			<h1 style="height: 30px;text-indent: -1000000em;">zczxc</h1>
			<div id="footer" style="margin: 0">
				<div class="wrapper">
					<div class="izquierda">
						<h1><?php __('Políticas'); ?></h1>
						<p>
							<?php __('Esta página recoge los términos y condiciones en virtud de los cuáles le proporcionamos nuestros servicios (“Términos y condiciones de la Web”). Por favor, lea atentamente estos términos y condiciones antes de realizar un pedido en nuestra página Web.'); ?> 
							<br/>
							<br/>
							<?php __('Deberá entender, que mediante la realización de un pedido, acepta someterse a los presentes términos y condiciones.'); ?>
							<br/>
							<a class="ver_mas" href="/pages/politicas"><?php __('Ver Más'); ?></a>
						</p>
						<div style="clear: both"></div>
						<a href="/pages/comoComprar"><?php __('Cómo comprar'); ?></a>
						<a href="/pages/nuestraEmpresa"><?php __('Nuestra empresa'); ?></a>
						<a href="/pages/dudas"><?php __('¿Tienes alguna sugerencia, queja o reclamo?'); ?></a>
						<a href="/pages/sugierenos"><?php __('Sugierenos un restaurante'); ?></a>
						<a href="/pages/privacidad"><?php __('Privacidad'); ?></a>
						<a href="/pages/contacto"><?php __('Contáctenos'); ?></a>
					</div>
					<div class="derecha">
						<h1><?php __('Recomienda esta página a tus amigos'); ?></h1>
						<?php $code = $this -> requestAction('/users/getCode');?>
						<a class="compartir"href="javascript: void(0);" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php echo urlencode("http://".Configure::read('site_domain').'/users/register/').$code;?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');"><img src="/img/facebook.png" /></a>
						<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
						 <!-- <a href="http://twitter.com/share?url=http%3A%2F%2Fdev.twitter.com&amp;via=your_screen_name" class="boton-twitter">Compartir en twitter</a>--> 
						<a  onclick="window.open('http://twitter.com/share?url=<?php echo rawurlencode(urlencode("http://".Configure::read('site_domain').'/users/register/').$code);?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');"class="boton-twitter" target="_blank" style='cursor:pointer;'><img src="/img/twitter.png" /></a>
					</div>
					<a class="volver_arriba" href="#"><?php __('Volver Arriba'); ?></a>
					<div style="clear: both"></div>
				</div>
			</div>
		</div>
		<?php echo $this -> element('sql_dump');?>
	</body>
</html>