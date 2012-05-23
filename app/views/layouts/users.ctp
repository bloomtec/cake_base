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
		<title><?php echo $PAGE_TITLE; ?></title>
		<?php
		echo $this -> Html -> meta('icon');
		echo $this -> Html -> css('reset.css');
		echo $this -> Html -> css('ie.css');
		echo $this -> Html -> css('styles.css');
		echo $this -> Html -> css('uploadify');
		echo $this -> Html -> css('/bcart/css/bcart.css');
		echo $this -> Html -> css('users.css');
		echo $this -> Html -> script('jquery');

		echo $this -> Html -> script('jquery.tools.min');
		echo $this -> Html -> Script("swfobject");
		echo $this -> Html -> Script("jquery.uploadify.v2.1.4.min");
		echo $this -> Html -> script('upload');
		echo $this -> Html -> script('bjs');
		echo $this -> Html -> script('/bcart/js/bcart');
		echo $this -> Html -> script('front');

		echo $scripts_for_layout;
		?>
	</head>
	<body id="personaliza">
		<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=420494534634883";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
		<div id="container">
			<div id="content" class="border_radius">
				<div class='users'>
					<?php echo $content_for_layout;?>
				</div>
			</div>
		</div>
		<?php echo $this -> element('sql_dump');?>
	</body>
</html>