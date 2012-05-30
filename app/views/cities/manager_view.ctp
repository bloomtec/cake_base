<div class="cities view">
<h2><?php  __('Ciudad');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('País'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($city['Country']['name'], array('controller' => 'countries', 'action' => 'view', $city['Country']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $city['City']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripción'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $city['City']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Imagen'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->image('uploads/100x100/'.$city['City']['image']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Presente'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php //if($city['City']['is_present']){echo __('Yes', true);}else{echo __('No', true);}; ?>
			<?php
				// echo $city['City']['is_present'];
				if($city['City']['is_present']) {
					echo '<input type="checkbox" disabled checked />';
				} else {
					echo '<input type="checkbox" disabled />';
				}
			?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Código'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $city['City']['code']; ?>
			&nbsp;
		</dd>
		<!--
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lat'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $city['City']['lat']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Long'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $city['City']['long']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $city['City']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $city['City']['updated']; ?>
			&nbsp;
		</dd>
		-->
	</dl>
</div>
<div class="related">
	<h3><?php __('Direcciones Relacionadas');?></h3>
	<?php if (!empty($city['Address'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Nombre'); ?></th>
		<th><?php __('Ususario'); ?></th>
		<th><?php __('Dirección'); ?></th>
		<th><?php __('Código Postal'); ?></th>
		<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($city['Address'] as $address):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $address['name'];?></td>
			<td><?php echo $address['user_id'];?></td>
			<td><?php echo $address['address'];?></td>
			<td><?php echo $address['zip'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('Ver', true), array('controller' => 'addresses', 'action' => 'view', $address['id'])); ?>
				<?php echo $this->Html->link(__('Editar', true), array('controller' => 'addresses', 'action' => 'edit', $address['id'])); ?>
				<?php echo $this->Html->link(__('Eliminar', true), array('controller' => 'addresses', 'action' => 'delete', $address['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $address['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Agregar', true), array('controller' => 'addresses', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Usuarios Relacionados');?></h3>
	<?php if (!empty($city['User'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Nombre'); ?></th>
		<th><?php __('Apellido'); ?></th>
		<th><?php __('Correo'); ?></th>
		<th><?php __('Rol'); ?></th>
		<th><?php __('Activo'); ?></th>
		<th><?php __('Teléfono'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($city['User'] as $user):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $user['name'];?></td>
			<td><?php echo $user['last_name'];?></td>
			<td><?php echo $user['email'];?></td>
			<td><?php echo $user['Role']['name'];?></td>
			<td>
				<?php
					if($user['active']) {
						echo '<input type="checkbox" disabled checked />';
					} else {
						echo '<input type="checkbox" disabled />';
					}
				?>
			</td>
			<td><?php echo $user['phone'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('Ver', true), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Editar', true), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Html->link(__('Eliminar', true), array('controller' => 'users', 'action' => 'delete', $user['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Agregar', true), array('controller' => 'users', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Barrios Relacionados');?></h3>
	<?php if (!empty($city['Zone'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Nombre'); ?></th>
		<th><?php __('Descripción'); ?></th>
		<th><?php __('Imagen'); ?></th>
		<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($city['Zone'] as $zone):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $zone['name'];?></td>
			<td><?php echo $zone['description'];?></td>
			<td><?php echo $this->Html->image('/img/uploads/100x100/'.$zone['image']); ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'zones', 'action' => 'view', $zone['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'zones', 'action' => 'edit', $zone['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'zones', 'action' => 'delete', $zone['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $zone['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Agregar', true), array('controller' => 'zones', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>