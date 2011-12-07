<div class="menus view">
<h2><?php  __('Menu');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menu['Menu']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menu['Menu']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menu['Menu']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menu['Menu']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Menu', true), array('action' => 'edit', $menu['Menu']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Menu', true), array('action' => 'delete', $menu['Menu']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $menu['Menu']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Menus', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Menu Items', true), array('controller' => 'menu_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu Item', true), array('controller' => 'menu_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Menu Items');?></h3>
	<?php if (!empty($menu['MenuItem'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Menu Id'); ?></th>
		<th><?php __('Parent Id'); ?></th>
		<th><?php __('Lft'); ?></th>
		<th><?php __('Rght'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Link'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Updated'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($menu['MenuItem'] as $menuItem):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $menuItem['id'];?></td>
			<td><?php echo $menuItem['menu_id'];?></td>
			<td><?php echo $menuItem['parent_id'];?></td>
			<td><?php echo $menuItem['lft'];?></td>
			<td><?php echo $menuItem['rght'];?></td>
			<td><?php echo $menuItem['name'];?></td>
			<td><?php echo $menuItem['link'];?></td>
			<td><?php echo $menuItem['created'];?></td>
			<td><?php echo $menuItem['updated'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'menu_items', 'action' => 'view', $menuItem['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'menu_items', 'action' => 'edit', $menuItem['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'menu_items', 'action' => 'delete', $menuItem['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $menuItem['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Menu Item', true), array('controller' => 'menu_items', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
