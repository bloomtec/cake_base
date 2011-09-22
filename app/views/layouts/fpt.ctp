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
		echo $this->Html->css('ftp.css');
		echo $this->Html->css('uploadify',true);
		echo $this->Html->script('jquery');
		echo $this->Html->script('jquery.tools.min');
		echo $this->Html->script('cufon-yui');
		echo $this->Html->script('Insaniburger.font');
		echo $this->Html->script('front');
		echo $this->Html->script('fpt');
		echo $this->Html->Script("swfobject");
		echo $this->Html->Script("jquery.uploadify.v2.1.4.min");
		echo $this->Html->Script("upload");	
		
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
		<div id="my-profile">
			<div class="imagen">
				<?php echo $html->image($user["UserField"][0]["image"]); ?>
			</div>
			<div class="info">
				<?php
				//debug($this->data);
				echo $this->Form->create('UserField'); 
			///	echo $this->Form->input('user_id');
				echo $this->Form->input('name');
				echo $this->Form->input('surname');
				echo $this->Form->input('birthday');
				echo $this->Form->input('foot_id',array("options"=>$feets));
				echo $this->Form->input('Position',array("options"=>$positions));
				echo $this->Form->end();
				?>
			</div>
		</div>
		<div id="content">
			<?php echo $content_for_layout; ?>
		</div>
		<div style="clear:both"></div>
		<div id="panes">	
			<?php echo $this->element("tab-profile");?>
			<?php echo $this->element("tab-teams");?>	
			<?php echo $this->element("tab-payfoll");?>	
			<?php echo $this->element("tab-challenges");?>
			<div style="clear:both"></div>
		</div>
		<div class="apple_overlay" id="overlay">
			<div class="header">
				<a href="#" class="close"><? echo $html->image("fpt/cerrar-overlay.png",array("alt"=>"cerrar","title"=>"cerrar")) ?></a>
				<div style="clear:both"></div>
			</div>
			<div class="contentWrap">
			
			</div>
		</div>		
	</div>
	<div id="footer">
			
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>