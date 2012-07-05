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
		<?php echo $this -> Html -> charset(); ?>
		<title>
		<?php
			$model = $this -> params['models'][0];
			$singularVar = strtolower($model);
			if (isset(${$singularVar}[$model]['name'])) {
				echo ${$singularVar}[$model]['name'];
			} else {
				echo $title_for_layout;
			}
			?>
		</title>
		<?php
			if (isset(${$singularVar}[$model]['keywords']))
				echo $this -> Html -> meta('keywords', ${$singularVar}[$model]['keywords']);
			if (isset(${$singularVar}[$model]['description']))
				echo $this -> Html -> meta('keywords', ${$singularVar}[$model]['description']);
			echo $this -> Html -> meta('icon');
			echo $this -> Html -> css('ez');
			echo $this -> Html -> css('admin');
			echo $this -> Html -> css('/js/jquery-ui/css/start/custom');
			echo $this -> Html -> css('superfish');
			echo $this -> Html -> css('uploadify');
			echo $this -> Html -> Script("jquery");
			echo $this -> Html -> Script("bjs");
			echo $this -> Html -> Script('jquery-ui/custom.min');
			echo $this -> Html -> script('bjs');
			echo $this -> Html -> script('admin');
			echo $this -> Html -> Script("menu");
			echo $this -> Html -> Script("swfobject");
			echo $this -> Html -> Script("jquery.uploadify.v2.1.4.min");
			echo $this -> Html -> Script("upload");
			echo $this -> Html -> Script("ckeditor/ckeditor");
			echo $this -> Html -> Script("fileBrowser");
	
			echo $scripts_for_layout;
		?>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<?php echo $this -> element('languages'); ?>
				<div style='clear:both;'></div>
				<h1 class="logo_interna"></h1>
				<?php echo $this -> element("ez/menu"); ?>
			</div>
			<div id="content">
				<?php echo $this -> Session -> flash(); ?>

				<?php echo $content_for_layout; ?>
			</div>
			<div id="footer">
				powered by <?php echo $this -> Html -> link($this -> Html -> image('../img/cms/bloom_naranja.png', array('alt' => __('Bloom Web Company', true), "height" => 15, 'border' => '0')), 'http://www.bloomweb.co/', array('target' => '_blank', 'escape' => false)); ?>
			</div>
		</div>
		<?php echo $this -> element('sql_dump');?>
	</body>
</html>