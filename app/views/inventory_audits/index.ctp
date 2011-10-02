<div class="inventoryAudits index">
	<h2><?php __('Inventory Audits');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
									
							<th><?php echo $this->Paginator->sort('user_id');?></th>
									
							<th><?php echo $this->Paginator->sort('inventory_id');?></th>
									
							<th><?php echo $this->Paginator->sort('value_change');?></th>
									
							<th><?php echo $this->Paginator->sort('created');?></th>
								<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($inventoryAudits as $inventoryAudit):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $inventoryAudit['InventoryAudit']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($inventoryAudit['User']['username'], array('controller' => 'users', 'action' => 'view', $inventoryAudit['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($inventoryAudit['Inventory']['id'], array('controller' => 'inventories', 'action' => 'view', $inventoryAudit['Inventory']['id'])); ?>
		</td>
		<td><?php echo $inventoryAudit['InventoryAudit']['value_change']; ?>&nbsp;</td>
		<td><?php echo $inventoryAudit['InventoryAudit']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $inventoryAudit['InventoryAudit']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $inventoryAudit['InventoryAudit']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $inventoryAudit['InventoryAudit']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $inventoryAudit['InventoryAudit']['id'])); ?>
			<?php if(isset($inventoryAudit['InventoryAudit']['active'])&& $inventoryAudit['InventoryAudit']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $inventoryAudit['InventoryAudit']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $inventoryAudit['InventoryAudit']['id']));
}?>
			<?php if(isset($inventoryAudit['InventoryAudit']['active'])&& !$inventoryAudit['InventoryAudit']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $inventoryAudit['InventoryAudit']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $inventoryAudit['InventoryAudit']['id'])); 
}?>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
	<div class="actions">
		<ul>
			<li>	<?php echo $this->Html->link(__('Add', true), array('action' => 'add'),array('class'=>'add')); ?>
</li>
		</ul>
	</div>
</div>
