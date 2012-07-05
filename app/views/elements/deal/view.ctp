<div class="deals view">
<h2><?php  __('Promo');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Restaurante'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($deal['Restaurant']['name'], array('controller' => 'restaurants', 'action' => 'view', $deal['Restaurant']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $deal['Deal']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripción'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $deal['Deal']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Imagen'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->image('uploads/100x100/'.$deal['Deal']['image']); ?>
			&nbsp;
		</dd>
	
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Precio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $deal['Deal']['price']; ?>
			&nbsp;
		</dd>
	
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Visitas'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $deal['Deal']['visits']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Creado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $deal['Deal']['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>


<div class="related">
	<h3><?php __('Related Orders');?></h3>
	<?php if (!empty($deal['Order'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Código'); ?></th>
		<th><?php __('Usuario'); ?></th>
		<th><?php __('Dirección'); ?></th>
		<th><?php __('Cantidad'); ?></th>
		<th><?php __('Estado'); ?></th>
		<th><?php __('Creada'); ?></th>
		<th><?php __('Actualizada'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($deal['Order'] as $key => $order):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $order['code'];?></td>
			<td><?php echo $users[$key]['User']['email'];?></td>
			<td><?php echo $addresses[$key]['Address']['address'];?></td>
			<td><?php echo $order['quantity'];?></td>
			<td><?php echo $order['state'];?></td>
			<td><?php echo $order['created'];?></td>
			<td><?php echo $order['updated'];?></td>
			<td class="actions">
				<?php
					echo $this->Html->link(__('Ver', true), array('controller' => 'orders', 'action' => 'view', $order['id']));
					if($this -> Session -> read('Auth.User.role_id') == 4) {
						echo $this->Html->link(__('Editar', true), array('controller' => 'orders', 'action' => 'edit', $order['id']));
					}
				?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>
</div>
<div class="related">
	<h3><?php __('Cocinas Relacionadas');?></h3>
	<?php if (!empty($deal['Cuisine'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Nombre'); ?></th>
		<th><?php __('Descripción'); ?></th>
		<th><?php __('Imagen'); ?></th>
		<?php if($this -> Session -> read('Auth.User.role_id') != 4) : ?>
		<th class="actions"><?php __('Acciones');?></th>
		<?php endif; ?>
	</tr>
	<?php
		$i = 0;
		foreach ($deal['Cuisine'] as $cuisine):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $cuisine['name'];?></td>
			<td><?php echo $cuisine['description'];?></td>
			<td><?php echo $this -> Html -> image('uploads/100x100/' . $cuisine['image']);?></td>
			<?php if($this -> Session -> read('Auth.User.role_id') != 4) : ?>
			<td class="actions">
				<?php echo $this->Html->link(__('Ver', true), array('controller' => 'cuisines', 'action' => 'view', $cuisine['id'])); ?>
				<?php echo $this->Html->link(__('Editar', true), array('controller' => 'cuisines', 'action' => 'edit', $cuisine['id'])); ?>
				<?php echo $this->Html->link(__('Eliminar', true), array('controller' => 'cuisines', 'action' => 'delete', $cuisine['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $cuisine['id'])); ?>
			</td>
			<?php endif; ?>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>
	<?php if($this -> Session -> read('Auth.User.role_id') != 4) : ?>
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Agregar', true), array('controller' => 'cuisines', 'action' => 'add'));?> </li>
		</ul>
	</div>
	<?php endif; ?>
</div>