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
		<div id="header">
    	<div class="wrapper">
        	<a class="logo_header" href="#">Excelenter</a>
            <form name="buscador">
            <input type="text" class="input_buscar" placeholder="Buscar..."/>
            <input type="submit" class="submit" value="" />
            </form>
            <ul id="main_menu">
            	<li><a href="" style="background-image: url(/img/inicio.png); width: 54px;"></a></li>
                <li><a href="" style="background-image: url(/img/productos.png); width: 111px;"></a></li>
                <li><a href="" style="background-image: url(/img/empresas.png); width: 98px;"></a></li>
                <li class="ultimo"><a href="" style="background-image: url(/img/contactenos.png); width: 136px; height: 18px;"></a></li>
                <div style="clear: both"></div>
            </ul>                
        </div>
    </div>
    <div id="container">
    	<div id="zona_gamers" class="border_radius">
        	<a class="border_radius" href="#">zona gamers</a>
        </div>
        <div id="slide" class="border_radius"></div>
        <div id="login" class="border_radius">
        	<h1 class="titulos_lateral">Área de clientes</h1>
            <form name="login">
            <h2>Usuario:</h2>
            <input type="text" class="input"/>
            <h2>Password:</h2>
            <input type="text" class="input"/>
            <h3><a href="#">¿Olvido su contraseña?</a></h3>
            <a href="">registrarse</a>
            <input type="submit" class="submit" />
            </form>
            
        </div>
        <div id="content" class="border_radius">
        	<?php echo $content_for_layout; ?>
        </div>
        <div id="respaldados" class="border_radius"></div>
        <div style="clear:both"></div>
    </div>
    <div id="footer">
    	<span class="logo_footer">logo footer</span>
        <span class="linea_footer">linea footer</span>
        <div class="wrapper">
        	<ul>
            	<li><h1>Nuestra Empresa</h1></li>
                <li><a href="#">¿Quienes somos?</a></li>
                <li><a href="#">Servicios</a></li>
                <li><a href="#">Procesos de pago</a></li>
                <li><a href="#">Políticas de Garantía</a></li>
            </ul>
            <ul id="menu_footer">
            	<li><h1>Encuentranos también en:</h1></li>
                <li class="facebook"><a href="#">facebook</a></li>
                <li class="twitter"><a href="#">twitter</a></li>
            </ul>
	        <h3>Excelenter.com.co  2011 Copyright        Todos los derechos reservados - Diseño y desarrollo por Bloom</h3>            
        </div> 

    </div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>