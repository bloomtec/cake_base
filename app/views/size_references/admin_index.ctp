<div class="sizeReferences index">
	<h2><?php __('Size References');?></h2>
	<table cellpadding="0" cellspacing="0" id="sortable" controller="size_references">
	<tr class='ui-state-disabled'>
		<th>Talla</th>
		<th>Creada</th>
		<th>Actualizada</th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($sizeReferences as $sizeReference):
		$class = ' class="ui-state-default "';
    	if ($i++ % 2 == 0) {
    		$class = ' class="altrow ui-state-default"';
		}
	?>
	<tr<?php echo $class;?> id="<?php echo $sizeReference['SizeReference']['id']?>">
		<td><?php echo $sizeReference['SizeReference']['size']; ?>&nbsp;</td>
		<td><?php echo $sizeReference['SizeReference']['created']; ?>&nbsp;</td>
		<td><?php echo $sizeReference['SizeReference']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $sizeReference['SizeReference']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $sizeReference['SizeReference']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $sizeReference['SizeReference']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $sizeReference['SizeReference']['id'])); ?>
			<?php
				if(isset($sizeReference['SizeReference']['active'])&& $sizeReference['SizeReference']['active']){
			 		echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $sizeReference['SizeReference']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $sizeReference['SizeReference']['id']));
				}
			?>
			<?php
				if(isset($sizeReference['SizeReference']['active'])&& !$sizeReference['SizeReference']['active']) {
					echo $this->Html->link(__(' ', true), array('action' => 'setActive', $sizeReference['SizeReference']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $sizeReference['SizeReference']['id']));
				}
			?>
		</td>
	</tr>
	<?php endforeach; ?>
	</table>
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Add', true), array('action' => 'add'),array('class'=>'add')); ?></li>
		</ul>
	</div>
</div>