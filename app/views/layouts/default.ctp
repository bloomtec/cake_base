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
		<?php __('Futbol Para Todos:'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('reset.css');
		echo $this->Html->css('ie.css');
		echo $this->Html->css('styles.css');
		echo $this->Html->script('jquery');
		echo $this->Html->script('jquery.tools.min');
		echo $this->Html->script('front');
		echo $this->Html->script('cufon-yui');
		echo $this->Html->script('Insaniburger.font');

		echo $scripts_for_layout;
	?>
	<script type="text/javascript">
		Cufon.replace("body",{
			ignoreClass:"no-cufon",
			trim:"simple"
		});
	</script>
</head>
<body>
	<div id="container">
		<div id="left-col">
			<div class="logo">
				 <?php echo $this->Html->link(
					$this->Html->image('LOGO.png', array('alt'=> 'Futbol Para Todos', 'border' => '0','width'=>'80%')),
					'/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
			</div>
			<div id="main-menu">
				<div class="social">
					
				</div>
				<ul>
					<li><?php echo $html->link("¡REGISTRATE!",array("controller"=>"users","action"=>"register"))?></li>
					<li><?php echo $html->link("RED","#")?></li>
					<li><?php echo $html->link("EVENTOS","#")?></li>
					<li><?php echo $html->link("NOTICIAS","/news")?></li>
					<li><?php echo $html->link("FTP","http://futbolparatodoscali.wordpress.com/")?></li>
				</ul>
			</div>
			
		</div>
		<div id="center-col">

			<?php echo $this->Session->flash(); ?>
			<?php echo $content_for_layout; ?>

		</div>
		<div id="right-col">
			<div class="pauta">
				
			</div>
			<h1>¡PAUTE AQUI!</h1>
			
		</div>
	</div>
	<div id="bloom" class="no-cufon">
		developed by: <?php echo $this->Html->link(
					$this->Html->image('bloom_blanco.png', array('alt'=> __('Bloom Web Company',true), 'border' => '0',"height"=>12)),
					'http://www.bloomweb.co/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>