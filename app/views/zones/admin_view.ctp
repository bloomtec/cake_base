<div class="zones view">
<h2><?php  __('Barrio');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ciudad'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($zone['City']['name'], array('controller' => 'cities', 'action' => 'view', $zone['City']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $zone['Zone']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripción'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $zone['Zone']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Imagen'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->image('uploads/100x100/'.$zone['Zone']['image']); ?>
			&nbsp;
		</dd>
		<!--
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
		-->
	</dl>
</div>


<div class="related">
	<h3><?php __('Restaurantes Relacionados');?></h3>
	<?php if (!empty($zone['Restaurant'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Nombre'); ?></th>
		<th><?php __('Descripción'); ?></th>
		<th><?php __('Imagen'); ?></th>
		<!--
		<th><?php __('Lat'); ?></th>
		<th><?php __('Long'); ?></th>
		-->
		<th class="actions"><?php __('Acciones');?></th>
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
			<td><?php echo $restaurant['name'];?></td>
			<td><?php echo $restaurant['description'];?></td>
			<td><?php echo $this -> Html -> image('/img/uploads/100x100/' . $restaurant['image']);?></td>
			<!--
			<td><?php echo $restaurant['lat'];?></td>
			<td><?php echo $restaurant['long'];?></td>
			-->
			<td class="actions">
				<?php echo $this->Html->link(__('Ver', true), array('controller' => 'restaurants', 'action' => 'view', $restaurant['id'])); ?>
				<?php echo $this->Html->link(__('Editar', true), array('controller' => 'restaurants', 'action' => 'edit', $restaurant['id'])); ?>
				<?php echo $this->Html->link(__('Eliminar', true), array('controller' => 'restaurants', 'action' => 'delete', $restaurant['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $restaurant['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Crear Restaurante', true), array('controller' => 'restaurants', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
