<?php
/**
 *
 * PHP versions 4 and 5
 *
 * EZ: the esiest CMS powered by www.bloomweb.co
 */
?>
<?php if(strpos($action,"admin")===0){?>
<?php 
	echo "<?php echo \$this->Html->css('pictures'); ?>\n"; 
	echo "<?php echo \$this->Html->script('sortable');?>";
?>
<div class="gallery_view">
	<div class="pictures">
	<h2><?php echo "<?php if(isset(\$parentName)) echo \$this->Html->link(\$parentName,array('controller'=>'".$associations['belongsTo'][substr($modelClass,0,strpos($modelClass, 'Picture'))]['controller']."','action'=>'view', \$parent_id)) ?>" ?> </h2>
		<ul id='sortable' controller="<?php echo $pluralVar ?>">
		<?php echo "<?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n"; ?>
			<li class='image-container ui-state-default'  id="<?php echo "<?php echo \${$singularVar}['{$modelClass}']['id'];?>"; ?>">
				<div class="image">
					<?php echo "<?php echo  \$html->image('uploads/'. \${$singularVar}['{$modelClass}']['path']); ?>\n" ?>
				</div>
				<div class='actions'>
					<?php echo "<?php echo  \$this->Html->link(__('Delete', true), array('action' => 'delete',  \${$singularVar}['{$modelClass}']['{$primaryKey}']), null, sprintf(__('Are you sure you want to delete # %s?', true), \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?> \n" ?>
				</div>
			</li>
		<?php echo "<?php endforeach; ?> \n"; ?>
		</ul>
	</div>
	<div class="uploader-container">
		<input id="pictures-uploader" controller="<?php echo $pluralVar ?>" rel="<?php echo "<?php echo \$parent_id; ?>"; ?>">
	</div>
</div>
<?php }else{?>
<div class="gallery_view">
	<?php echo "<?php \$this->element('gallery-slider',array('modelClass'=>'".$modelClass."','pictures'=>\$$pluralVar));?>\n"; ?>
</div>
<?php } ?>

