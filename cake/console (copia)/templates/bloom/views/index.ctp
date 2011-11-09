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
<div class="<?php echo $pluralVar;?> index">
	<h2><?php echo "<?php __('{$pluralHumanName}');?>";?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
	<?php  foreach ($fields as $field):?>
		<?php if($field=="active"){?>
		<th><?php echo "<?php echo \$this->Paginator->sort('Status','{$field}');?>";?></th>
		<?php }else{?>	
			<?php if($field!="id"){?>
		<th><?php echo "<?php echo \$this->Paginator->sort('{$field}');?>";?></th>
			<?php } ?>
		<?php }?>
	<?php endforeach;?>
		<th class="actions"><?php echo "<?php __('Actions');?>";?></th>
	</tr>
	<?php
	echo "<?php
	\$i = 0;
	foreach (\${$pluralVar} as \${$singularVar}):
		\$class = null;
		if (\$i++ % 2 == 0) {
			\$class = ' class=\"altrow\"';
		}
	?>\n";
	echo "\t<tr<?php echo \$class;?>>\n";
		foreach ($fields as $field) {
			$isKey = false;
			$isActiveField=false;
			$isImage=false;
			$picturesController=false;
			$asoc=false;
			$aliases=false;
			if (!empty($associations['belongsTo'])) {
				foreach ($associations['belongsTo'] as $alias => $details) {
					if ($field === $details['foreignKey']) {
						$isKey = true;
						echo "\t\t<td>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t</td>\n";
						break;
					}
				}
			}
			if (!empty($associations['hasMany'])){
				foreach ($associations['hasMany'] as $alias => $details) {
					$asoc[]=$details;
					$aliases=substr($alias,-7, 7);
					if($picturesController) break;
					if ( strlen($alias)>=7 && substr($alias,-7, 7) === "Picture") {
						$picturesController = $details["controller"];
						break;
					}
				}
			}
			if($field=="active"){
				// active case
				$isActiveField=true;
				echo "<?php if(\${$singularVar}['{$modelClass}']['{$field}']){ ?>\n";
					echo "\t\t<td><?php echo 'Active'; ?>&nbsp;</td>\n";
				echo "<?php }else{ ?>\n";
					echo "\t\t<td><?php echo 'Inactive'; ?>&nbsp;</td>\n";
				echo "<?php }\n ?>";
					
			}
			if(strpos($field,"image")===0){
				// Image Case
				$isImage=true;
				echo "\t\t<td><?php echo \$this->Html->image('uploads/100x100/'.\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";			
			}
			if ($isKey !== true && $isActiveField!== true && $isImage!==true && $field!="id") {
				echo "\t\t<td><?php echo \${$singularVar}['{$modelClass}']['{$field}']; ?>&nbsp;</td>\n";
			}
		}

		echo "\t\t<td class=\"actions\">\n";
		
		echo "\t\t\t<?php echo \$this->Html->link(__('View', true), array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}']),array('class'=>'view icon','title'=>__('View',true))); ?>\n";
		echo "\t\t\t<?php echo \$this->Html->link(__('Edit', true), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>\n";
		if($picturesController){
			echo "\t\t\t<?php echo \$this->Html->link(__('Gallery', true), array('controller' => '$picturesController','action'=>'view', \${$singularVar}['{$modelClass}']['{$primaryKey}']),array('class'=>'view icon','title'=>__('View',true))); ?>\n";	
		}
		echo "\t\t\t<?php echo \$this->Html->link(__('Delete', true), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
		
	echo "\t\t\t<?php if(isset(\${$singularVar}['{$modelClass}']['active'])&& \${$singularVar}['{$modelClass}']['active']){\n";
			echo "\t\t\t echo \$this->Html->link(__(' ', true), array('action' => 'setInactive', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), \${$singularVar}['{$modelClass}']['{$primaryKey}']));\n";	
	echo	"}?>\n";
		
	echo "\t\t\t<?php if(isset(\${$singularVar}['{$modelClass}']['active'])&& !\${$singularVar}['{$modelClass}']['active']){\n";
			echo "\t\t\t echo \$this->Html->link(__(' ', true), array('action' => 'setActive', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), \${$singularVar}['{$modelClass}']['{$primaryKey}'])); \n";	
	echo "}?>\n";
	echo "\t\t</td>\n";	
	echo "\t</tr>\n";
	echo "<?php endforeach; ?>\n";
	?>
	</table>
	<p>
	<?php echo "<?php
	echo \$this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>";?>
	</p>

	<div class="paging">
	<?php echo "\t<?php echo \$this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>\n";?>
	 | <?php echo "\t<?php echo \$this->Paginator->numbers();?>\n"?> |
	<?php echo "\t<?php echo \$this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>\n";?>
	</div>
	<div class="actions">
		<ul>
			<li><?php echo "\t<?php echo \$this->Html->link(__('Add', true), array('action' => 'add'),array('class'=>'add')); ?>\n";?></li>
		</ul>
	</div>
</div>
