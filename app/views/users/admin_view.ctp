<div class="users view">
<h2><?php  __('Usuario'); ?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Correo Electrónico'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['email']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Apellido'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['last_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rol'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['Role']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Activo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php
				if($user['User']['active']) {
					echo '<input type="checkbox" checked disabled>';
				} else {
					echo '<input type="checkbox" disabled>';
				}
			?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ciudad'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($user['City']['name'], array('controller' => 'cities', 'action' => 'view', $user['City']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Teléfono'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['phone']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Creado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Actualizado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>


<div class="related">
	<h3><?php __('Direcciones Relacionadas');?></h3>
	<?php if (!empty($user['Address'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Nombre'); ?></th>
		<th><?php __('Dirección'); ?></th>
		<th><?php __('Código Postal'); ?></th>
		<th><?php __('País'); ?></th>
		<th><?php __('Ciudad'); ?></th>
		<th><?php __('Creada'); ?></th>
		<th><?php __('Actualizada'); ?></th>
		<!-- <th class="actions"><?php __('Actions');?></th> -->
	</tr>
	<?php
		$i = 0;
		foreach ($user['Address'] as $address):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $address['name'];?></td>
			<td><?php echo $address['address'];?></td>
			<td><?php echo $address['zip'];?></td>
			<td><?php echo $address['Country']['name'];?></td>
			<td><?php echo $address['City']['name'];?></td>
			<td><?php echo $address['created'];?></td>
			<td><?php echo $address['updated'];?></td>
			<!-- <td class="actions">
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'addresses', 'action' => 'edit', $address['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'addresses', 'action' => 'delete', $address['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $address['id'])); ?>
			</td> -->
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>
	<!-- <div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Address', true), array('controller' => 'addresses', 'action' => 'add'));?> </li>
		</ul>
	</div> -->
</div>
<div class="related">
	<h3><?php __('Ordenes Relacionadas');?></h3>
	<?php if (!empty($user['Order'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Código'); ?></th>
		<th><?php __('Dirección'); ?></th>
		<th><?php __('Cantidad'); ?></th>
		<th><?php __('Promoción'); ?></th>
		<th><?php __('Estado'); ?></th>
		<th><?php __('Creada'); ?></th>
		<th><?php __('Actualizada'); ?></th>
		<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Order'] as $order):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $order['code'];?></td>
			<td><?php echo $order['Address']['address'];?></td>
			<td><?php echo $order['quantity'];?></td>
			<td><?php echo $order['Deal']['name'];?></td>
			<td><?php echo $order['OrderState']['name'];?></td>
			<td><?php echo $order['created'];?></td>
			<td><?php echo $order['updated'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'orders', 'action' => 'view', $order['id'])); ?>
				<?php //echo $this->Html->link(__('Edit', true), array('controller' => 'orders', 'action' => 'edit', $order['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>
</div>