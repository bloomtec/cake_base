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
 * @subpackage    cake.cake.console.libs.templates.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<?php 
// VERIFICAR TIPO FORM
$tipForm=1;
$image=null;
$wysiwyg=array();
foreach ($fields as $field) {
	if(strpos($field,"image")===0){
		$tipForm=2;
		$image=$field;
	}
	if(strpos($field,"wysiwyg")===0){
		$wysiwyg[]=$field;
	}
}
?>
<?php if($tipForm===1)://TIPO FORMULARIO POR DEFECTO CAKE?>
<div class="<?php echo $pluralVar;?> form">
<?php echo "<?php echo \$this->Form->create('{$modelClass}');?>\n";?>
	<fieldset>
		<legend><?php printf("<?php __('%s %s'); ?>", Inflector::humanize($action), $singularHumanName); ?></legend>
<?php
		echo "\t<?php\n";
		foreach ($fields as $field) {
			if (strpos($action, 'add') !== false && $field == $primaryKey) {
				continue;
			} elseif (!in_array($field, array('created', 'modified', 'updated','sort','slug'))) {
				if(strpos($field,"wysiwyg")===0){
						echo "\t\techo \$this->Form->input('{$field}',array('label'=>false));\n";	
					}else{
						echo "\t\techo \$this->Form->input('{$field}');\n";		
				}
			}
		}
		if (!empty($associations['hasAndBelongsToMany'])) {
			foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
				echo "\t\techo \$this->Form->input('{$assocName}');\n";
			}
		}
		echo "\t?>\n";
?>
	</fieldset>
<?php
	echo "<?php echo \$this->Form->end(__('Submit', true));?>\n";
?>
</div>
<?php endif; ?>
<?php if($tipForm===2):// TIPO FORMULARIO CON UPLOADER AL LADO?>	
<div class="<?php echo $pluralVar;?> form2">
<?php echo "<?php echo \$this->Form->create('{$modelClass}');?>\n";?>
	<fieldset>
		<legend><?php printf("<?php __('%s %s'); ?>", Inflector::humanize($action), $singularHumanName); ?></legend>
<?php
		echo "\t<?php\n";
		foreach ($fields as $field) {
			if (strpos($action, 'add') !== false && $field == $primaryKey) {
				continue;
			} elseif (!in_array($field, array('created', 'modified', 'updated','sort','slug'))) {
				if(strpos($field,"image")===0){
					echo "\t\techo \$this->Form->hidden('{$field}',array('id' => 'single-field'));\n";
				}else{
					if(strpos($field,"wysiwyg")===0){
						echo "\t\techo \$this->Form->input('{$field}',array('label'=>false));\n";	
					}else{
						echo "\t\techo \$this->Form->input('{$field}');\n";
					}
				}
			}
		}
		if (!empty($associations['hasAndBelongsToMany'])) {
			foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
				echo "\t\techo \$this->Form->input('{$assocName}');\n";
			}
		}
		echo "\t?>\n";
?>
	</fieldset>
<?php
	echo "<?php echo \$this->Form->end(__('Submit', true));?>\n";
?>
</div>

<div class="images">
		<h2><?php __("Image") ?></h2>
		<div class="preview">
			<div class="wrapper">
			<?php
			if($action=='edit'){
				echo "\t\t<?php echo \$this->Html->image('uploads/400x400/'.\$this->data['{$modelClass}']['{$field}']);?>";
			}else{
				echo "\t\t <?php echo \$this->Html->image('preview.png');?>\n";
			}
			?>
			</div>
		</div>
		<div id="single-upload" controller="<?php echo $pluralVar; ?>">
		</div>			
</div>
<?php endif ?>

<?php if(!empty($wysiwyg)):?>
	<script type="text/javascript">
	<?php foreach($wysiwyg as $field):?>
		CKEDITOR.replace('<?php echo "data[{$modelClass}][{$field}]"; ?>',{
        	filebrowserUploadUrl : '/upload.php',
        	filebrowserBrowseUrl : '/admin/pages/wysiwyg',
		} );
	<?php endforeach ?>
	</script>
<?php endif;?>
