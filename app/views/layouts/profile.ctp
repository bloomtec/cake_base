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
<html xmlns="http://www.w3.org/1999/xhtml"  xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml">
	<head>
		<?php $code=isset($code)?$code:"";?>
		<?php echo $this -> Html -> charset();?>
		<meta property="og:title" content="Como Promos" />
		<meta property="og:type" content="food" />
		<meta property="og:url" content="<?php echo urlencode("http://".Configure::read('site_domain').'/users/register/').$code;?>" />
		<meta property="og:image" content="http://comopromos.com/img/logo_face.png" />
		<meta property="og:site_name" content="Como Promos" />
		<meta property="fb:admins" content="591245015" />
		<meta property="og:description" content="<?php __('Todas las promociones de comida a domicilio de tu ciudad, en un solo lugar')?>" />
		<title><?php
		$model = $this -> params['models'][0];
		$singularVar = strtolower($model);
		/*
		 if (isset(${$singularVar}[$model]['name'])) {
		 echo ${$singularVar}[$model]['name'];
		 } else {
		 echo $title_for_layout;
		 }
		 */
		echo $PAGE_TITLE;
			?></title>
		<?php
		echo $this -> Html -> meta('icon');

		echo $this -> Html -> css('reset.css');
		echo $this -> Html -> css('ie.css');
		echo $this -> Html -> css('users.css');
		echo $this -> Html -> css('styles.css');
		echo $this -> Html -> css('uploadify');
		//echo $this -> Html -> css('/bcart/css/bcart.css');

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
		
		
	</head>
	<body id="profile">
		<div id="fb-root"></div>
		<script>
			( function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if(d.getElementById(id))
					return;
				js = d.createElement(s);
				js.id = id;
				js.src = "//connect.facebook.net/<?php if(Configure::read('Config.language')=="spa") echo "es_ES"; else echo "en_US";?>/all.js#xfbml=1&appId=420494534634883";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));

		</script>
		<?php
		if ($this -> Session -> read('Auth.User.id')) {
			echo $this -> element('score-box');
		}
		?>
		
		<div id="container">
			<?php echo $this -> element('header');?>
			<div id="content">
				<?php echo $this -> element('filtros-2');?>

				<div class="wrapperContent <?php echo $class;?>">
					<?php echo $this -> element('menu_usuario');?>
					<?php echo $this -> Session -> flash();?>

					<?php echo $content_for_layout;?>
				</div>
				<div style="clear: both"></div>
			</div>
			<h1 style="height: 30px;text-indent: -1000000em;">zczxc</h1>
			<?php echo $this -> element('footer'); ?>
		</div>
		<?php echo $this -> element('sql_dump');?>
	</body>
</html>