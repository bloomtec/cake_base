<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under Thehttps://panel.dreamhost.com/index.cgi? MIT License
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
		echo $this->Html->css('supersized.core.css');
		echo $this->Html->script('jquery');
		echo $this->Html->script('supersized.3.1.3.min');
		echo $this->Html->script('jquery.tools.min');
		echo $this->Html->script('front');

		echo $scripts_for_layout;
	?>

	<script type="text/javascript">
	<?php 
		if($session->read("Auth.User.id")){
			echo "var isMember=true;";
		}else{
			echo "var isMember=false;";
		}
	?>
	var imagenes=<?php echo  json_encode($this->requestAction("/pictures/getBackgrounds"));?>;
	</script>
</head>
<body>
	<div id="container">
		<div id="header">
			<div class="logo">
				
			</div>
			<?php  echo $this->element("menu"); ?>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>
			<?php echo $content_for_layout; ?>

		</div>
	</div>
	<ul id="footer" style="<?php if(isset($menu["Menu"]["background_code"])) echo 'background-color:'.$menu["Menu"]["background_code"];?>">
		<li> <a href="/view/accomodation">Acomodation</a> /</li>
		<li> <a href="/view/activities">Activities</a> /</li>
		<li> <a href="/view/information_reservation">information and reservation</a> </li>
		<li> <a href="/view/about">About us</a> /</li>
		<li> <a href="/view/contact">Contact</a> /</li>
		<li> <a href="/view/policies">Policies</a> /</li>
		<li> <a href="/view/disclaimer">Disclaimer</a> /</li>
		<li> <a href="/view/warranty">Warranty and consumer Satisfaction</a> </li>
	</ul>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>