<div class="products view">
<h2><?php  __('Product');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Image'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->image('uploads/100x100/'.$product['Product']['image']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Clasification'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['clasification']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Collection'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($product['Collection']['name'], array('controller' => 'collections', 'action' => 'view', $product['Collection']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Subcategory'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($product['Subcategory']['name'], array('controller' => 'subcategories', 'action' => 'view', $product['Subcategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>


<div class="related">
	<h3><?php __('Related Inventories');?></h3>
	<?php if (!empty($product['Inventory'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Product Id'); ?></th>
		<th><?php __('Size Id'); ?></th>
		<th><?php __('Quantity'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Updated'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($product['Inventory'] as $inventory):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $inventory['id'];?></td>
			<td><?php echo $inventory['product_id'];?></td>
			<td><?php echo $inventory['size_id'];?></td>
			<td><?php echo $inventory['quantity'];?></td>
			<td><?php echo $inventory['created'];?></td>
			<td><?php echo $inventory['updated'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'inventories', 'action' => 'view', $inventory['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'inventories', 'action' => 'edit', $inventory['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'inventories', 'action' => 'delete', $inventory['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $inventory['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Inventory', true), array('controller' => 'inventories', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Product Pictures');?></h3>
	<?php if (!empty($product['ProductPicture'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Image Path'); ?></th>
		<th><?php __('Product Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Updated'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($product['ProductPicture'] as $productPicture):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $productPicture['id'];?></td>
			<td><?php echo $productPicture['name'];?></td>
			<td><?php echo $productPicture['image_path'];?></td>
			<td><?php echo $productPicture['product_id'];?></td>
			<td><?php echo $productPicture['created'];?></td>
			<td><?php echo $productPicture['updated'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'product_pictures', 'action' => 'view', $productPicture['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'product_pictures', 'action' => 'edit', $productPicture['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'product_pictures', 'action' => 'delete', $productPicture['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $productPicture['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Product Picture', true), array('controller' => 'product_pictures', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
