<?php
/**
 *
 * PHP versions 4 and 5
 *
 * EZ: the esiest CMS powered by www.bloomweb.co
 */
?>
<div class="gallery_view">
	<div class="fotos">
	<h1><?php echo "PAPA" ?> </h1>
	<?php echo "<?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n"; ?>
		<div class='image-container'>;
			<div class="image">
				<?php echo "<?php echo  \$html->image('uploads/'. \${$singularVar}['path']); ?>\n" ?>
			</div>
			<div class='actions'>
				<?php echo "<?php echo  \$this->Html->link(__('Delete', true), array('action' => 'delete',  \${$singularVar}['{$modelClass}']['{$primaryKey}']), null, sprintf(__('Are you sure you want to delete # %s?', true), \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?> \n" ?>
			</div>
		</div>
	<?php echo "<?php endforeach; ?> \n"; ?>
	</div>
	<div class="images">
		<input id="multiple-upload" controller="<?php echo $pluralVar ?>" rel="<?php echo "<?php echo \$parent_id; ?>"; ?>">
	</div>
</div>