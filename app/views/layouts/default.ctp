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
<html xmlns="http://www.w3.org/1999/xhtml"  xmlns:og="http://ogp.me/ns#"     xmlns:fb="http://www.facebook.com/2008/fbml">
	<head>
		<?php echo $this -> Html -> charset();?>
		<title>
			<?php
				$model = $this -> params['models'][0];
				$singularVar = strtolower($model);
				/*
				if ($this -> params['action'] == "register") {
					echo "Como Promos";
				} else {
					if (isset(${$singularVar}[$model]['name'])) {
						echo ${$singularVar}[$model]['name'];
					} else {
						echo $title_for_layout;
					}
				}
				*/
				echo $PAGE_TITLE;
			?>
		</title>
		<META NAME="Description" CONTENT="<?php __('Todas las promociones de comida a domicilio de tu ciudad, en un solo lugar')?>">
		<?php
		if (isset(${$singularVar}[$model]['keywords']))
			echo $this -> Html -> meta('keywords', ${$singularVar}[$model]['keywords']);
		if (isset(${$singularVar}[$model]['description']))
			echo $this -> Html -> meta('keywords', ${$singularVar}[$model]['description']);

		echo $this -> Html -> meta('icon');

		echo $this -> Html -> css('reset.css');
		echo $this -> Html -> css('ie.css');
		echo $this -> Html -> css('users.css');
		echo $this -> Html -> css('styles.css');

		echo $this -> Html -> script('jquery');
		echo $this -> Html -> script('jquery.tools.min');
		echo $this -> Html -> script('bjs');

		echo $this -> Html -> script('front');

		echo $scripts_for_layout;
		?>
		<script type="text/javascript">
			$(function(){
				 $("a.boton[title]").tooltip();
			});
		</script>
		<meta property="og:title" content="<?php __('COMO PROMOS')?>" />
		<meta property="og:description" content="<?php __('Todas las promociones de comida a domicilio de tu ciudad, en un solo lugar')?>" />
		<meta property="og:image" content="<?php urlencode("http://comopromos.com/img/logo como promos curvas.png") ?>" />
		<meta property="fb:admins" content="591245015" />
	</head>
	<body id="<?php echo $this->name ?>">
		<div id="fb-root"></div>
		<script>
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=420494534634883";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
		<?php
			if ($this -> Session -> read('Auth.User.id')) {
				echo $this -> element('score-box');
			}
		?>
		<div id="container">
			<?php
				echo $this -> element('header');
			?>
			<div id="content">
				<?php echo $this -> element('filtros-2'); ?>
				<?php echo $this -> Session -> flash();?>
				<?php echo $content_for_layout;?>
				<div style="clear: both"></div>
			</div>
			<div id="footer">
				<div class="wrapper">
					<div class="izquierda">
						<h1><?php __('Terminos y condiciones'); ?></h1>
						<p>
							<?php __('Esta página recoge los términos y condiciones en virtud de los cuáles le proporcionamos nuestros servicios (“Términos y condiciones de la Web”). Por favor, lea atentamente estos términos y condiciones antes de realizar un pedido en nuestra página Web.'); ?>
							<br/>
							<br/>
							<?php __('Deberá entender, que mediante la realización de un pedido, acepta someterse a los presentes términos y condiciones.'); ?>
							<br/>
							<a class="ver_mas" href="/pages/terminosYCondiciones"><?php __('Ver Más'); ?></a>
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