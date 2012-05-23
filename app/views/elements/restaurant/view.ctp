<div class="restaurants view">
<h2><?php  __('Restaurante');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Barrio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php
				if($this -> Session -> read('Auth.User.role_id') != 4) {
					echo $this->Html->link($restaurant['Zone']['name'], array('controller' => 'zones', 'action' => 'view', $restaurant['Zone']['id']));
				} else {
					echo $restaurant['Zone']['name'];
				}
			?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $restaurant['Restaurant']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripción'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $restaurant['Restaurant']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Teléfono'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $restaurant['Restaurant']['phone']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Imagen'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->image('uploads/100x100/'.$restaurant['Restaurant']['image']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Creado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $restaurant['Restaurant']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modificado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $restaurant['Restaurant']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>


<div class="related">
	<h3><?php __('Related Deals');?></h3>
	<?php if (!empty($restaurant['Deal'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Name'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Image'); ?></th>
		<th><?php __('Price'); ?></th>
		<th><?php __('Max Buys'); ?></th>
		<th><?php __('Visits'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Updated'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($restaurant['Deal'] as $deal):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $deal['name'];?></td>
			<td><?php echo $deal['description'];?></td>
			<td><?php echo $this->Html->image('/img/uploads/50x50/'.$deal['image']); ?></td>
			<td><?php echo $deal['price'];?></td>
			<td><?php echo $deal['max_buys'];?></td>
			<td><?php echo $deal['visits'];?></td>
			<td><?php echo $deal['created'];?></td>
			<td><?php echo $deal['updated'];?></td>
			<td class="actions">
				<?php
					echo $this->Html->link(__('View', true), array('controller' => 'deals', 'action' => 'view', $deal['slug']));
					if($this -> Session -> read('Auth.User.role_id') != 4) {
						echo $this->Html->link(__('Edit', true), array('controller' => 'deals', 'action' => 'edit', $deal['id']));
						echo $this->Html->link(__('Delete', true), array('controller' => 'deals', 'action' => 'delete', $deal['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $deal['id']));
					}					
				?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Deal', true), array('controller' => 'deals', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>