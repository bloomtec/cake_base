<div class="zones view">
<h2><?php  __('Zone');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('City'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($zone['City']['name'], array('controller' => 'cities', 'action' => 'view', $zone['City']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $zone['Zone']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $zone['Zone']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Image'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->image('uploads/100x100/'.$zone['Zone']['image']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lat'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $zone['Zone']['lat']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Long'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $zone['Zone']['long']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $zone['Zone']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $zone['Zone']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>


<div class="related">
	<h3><?php __('Related Restaurants');?></h3>
	<?php if (!empty($zone['Restaurant'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Manager'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Image'); ?></th>
		<th><?php __('Lat'); ?></th>
		<th><?php __('Long'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($zone['Restaurant'] as $restaurant):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $restaurant['Manager']['name'] . ' ' . $restaurant['Manager']['last_name'];?></td>
			<td><?php echo $restaurant['name'];?></td>
			<td><?php echo $restaurant['description'];?></td>
			<td><?php echo $this->Html->image('/img/uploads/50x50/'.$restaurant['image']); ?></td>
			<td><?php echo $restaurant['lat'];?></td>
			<td><?php echo $restaurant['long'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'restaurants', 'action' => 'view', $restaurant['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'restaurants', 'action' => 'edit', $restaurant['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'restaurants', 'action' => 'delete', $restaurant['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $restaurant['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Restaurant', true), array('controller' => 'restaurants', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
