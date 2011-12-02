<div class="inventories view">
<h2><?php  __('Inventory');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inventory['Inventory']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Product'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($inventory['Product']['name'], array('controller' => 'products', 'action' => 'view', $inventory['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Quantity'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inventory['Inventory']['quantity']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inventory['Inventory']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inventory['Inventory']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>


<div class="related">
	<h3><?php __('Related Inventory Movements');?></h3>
	<?php if (!empty($inventory['InventoryMovement'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Inventory Id'); ?></th>
		<th><?php __('Old Quantity'); ?></th>
		<th><?php __('New Quantity'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Comment'); ?></th>
		<th><?php __('Created'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($inventory['InventoryMovement'] as $inventoryMovement):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $inventoryMovement['id'];?></td>
			<td><?php echo $inventoryMovement['inventory_id'];?></td>
			<td><?php echo $inventoryMovement['old_quantity'];?></td>
			<td><?php echo $inventoryMovement['new_quantity'];?></td>
			<td><?php echo $inventoryMovement['user_id'];?></td>
			<td><?php echo $inventoryMovement['comment'];?></td>
			<td><?php echo $inventoryMovement['created'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'inventory_movements', 'action' => 'view', $inventoryMovement['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'inventory_movements', 'action' => 'edit', $inventoryMovement['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'inventory_movements', 'action' => 'delete', $inventoryMovement['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $inventoryMovement['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Inventory Movement', true), array('controller' => 'inventory_movements', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
