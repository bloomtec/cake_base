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
		if ($this -> params['action'] == "register") {
			echo "Como Promos";
		} else {

			if (isset(${$singularVar}[$model]['name'])) {
				echo ${$singularVar}[$model]['name'];
			} else {
				echo $title_for_layout;
			}
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
		echo $this -> Html -> css('users.css');
		echo $this -> Html -> css('styles.css');

		echo $this -> Html -> script('jquery');
		echo $this -> Html -> script('jquery.tools.min');
		echo $this -> Html -> script('bjs');

		echo $this -> Html -> script('front');

		echo $scripts_for_layout;
		?>
	</head>
	<body>
		<?php
		if ($this -> Session -> read('Auth.User.id')) {
			echo $this -> element('score-box');
		}
		?>
		<div id="container">
			<?php echo $this -> element('header');?>
			<div id="content">
				<?php echo $this -> element('filtros-2'); ?>
				<?php echo $this -> Session -> flash();?>
				<?php echo $content_for_layout;?>
				<div style="clear: both"></div>
			</div>
			<div id="footer">
				<div class="wrapper">
					<div class="izquierda">
						<h1>Terminos y condiciones</h1>
						<p>
							Esta página recoge los términos y condiciones en virtud de los cuáles le proporcionamos nuestros servicios (“Términos y condiciones de la Web”). Por favor, lea atentamente estos términos y condiciones antes de realizar un pedido en nuestra página Web.
							<br/>
							<br/>
							Deberá entender, que mediante la realización de un pedido, acepta someterse a los presentes términos y condiciones.
							<br/>
							<a class="ver_mas" href="/pages/terminosYCondiciones">Ver Más</a>
						</p>
						<div style="clear: both"></div>
						<a href="/pages/comoComprar">Cómo comprar</a>
						<a href="/pages/nuestraEmpresa">Nuestra empresa</a>
						<a href="/pages/dudas">¿Tienes alguna sugerencia, queja o reclamo?</a>
						<a href="/pages/sugierenos">Sugierenos un restaurante</a>
						<a href="/pages/privacidad">Privacidad</a>
						<a href="/pages/contacto">Contáctenos</a>
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
		<?php echo $this -> element('sql_dump');?>
	</body>
</html>