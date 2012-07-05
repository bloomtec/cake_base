<div class="orderFilter">
	<?php echo $this -> Form -> create(null, array('style' => 'width: 100%;')); ?>
	<table id="TableFilters">
		<tbody>
			<tr>
				<td style="max-width: 100px;">
					<?php echo $this -> Form -> input('Filtros.email', array('label' => __('Correo', true), 'value' => '')); ?>
				</td>
				<td style="max-width: 100px;">
					<?php echo $this -> Form -> input('Filtros.nombres', array('label' => __('Nombres', true), 'value' => '')); ?>
				</td>
				<td style="max-width: 100px;">
					<?php echo $this -> Form -> input('Filtros.apellidos', array('label' => __('Apellidos', true), 'value' => '')); ?>
				</td>
				<td style="max-width: 100px;">
					<?php echo $this -> Form -> input('Filtros.rol', array('label' => __('Rol', true), 'options' => $roles, 'empty' => 'Seleccione...', 'value' => '')); ?>
				</td>
				<td style="max-width: 100px;">
					<?php echo $this -> Form -> input('Filtros.ciudad', array('label' => __('Ciudad', true), 'options' => $cities, 'empty' => 'Seleccione...', 'value' => '')); ?>
				</td>
				<td><?php echo $this -> Form -> end('Filtrar'); ?></td>
			</tr>
		</tbody>
	</table>
</div>
<div class="users index">
	<h2><?php __('Usuarios');?></h2>
	<table cellpadding="0" cellspacing="0" >
	<tr  >
		<th><?php echo $this->Paginator->sort(__('Correo Electrónico', true), 'email');?></th>
		<th><?php echo $this->Paginator->sort(__('Nombres', true), 'name');?></th>
		<th><?php echo $this->Paginator->sort(__('Apellidos', true), 'last_name');?></th>
		<th><?php echo $this->Paginator->sort(__('Rol', true), 'role_id');?></th>
		<th><?php echo $this->Paginator->sort(__('Activo', true), 'active');?></th>
		<th><?php echo $this->Paginator->sort(__('Ciudad', true), 'city_id');?></th>
		<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($users as $user):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?> id='<?php echo $user['User']['id'] ?>'>
		<td><?php echo $user['User']['email']; ?>&nbsp;</td>
		<td><?php echo $user['User']['name']; ?>&nbsp;</td>
		<td><?php echo $user['User']['last_name']; ?>&nbsp;</td>
		<td><?php echo $user['Role']['name']; ?>&nbsp;</td>
		<?php if($user['User']['active']){ ?>
		<td><?php echo 'Active'; ?>&nbsp;</td>
		<?php }else{ ?>
		<td><?php echo 'Inactive'; ?>&nbsp;</td>
		<?php } ?>
		<td>
			<?php echo $this->Html->link($user['City']['name'], array('controller' => 'cities', 'action' => 'view', $user['City']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $user['User']['id']),array('class'=>'view icon','title'=>__('Ver',true))); ?>
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $user['User']['id']),array('class'=>'edit icon','title'=>__('Editar',true))); ?>
			<?php echo $this->Html->link(__('Eliminar', true), array('action' => 'delete', $user['User']['id']), array('class'=>'delete icon','title'=>__('Eliminar',true)), sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?>
			<?php if(isset($user['User']['active'])&& $user['User']['active']){
				echo $this->Html->link(__('Poner Inactivo', true), array('action' => 'setInactive', $user['User']['id']), array('class'=>'setInactive icon','title'=>__('Poner Inactivo',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $user['User']['id']));
			}?>
			<?php if(isset($user['User']['active'])&& !$user['User']['active']){
				echo $this->Html->link(__('Poner Activo', true), array('action' => 'setActive', $user['User']['id']), array('class'=>'setActive icon','title'=>__('Poner Activo',true)), sprintf(__('Are you sure you want to set active # %s?', true), $user['User']['id'])); 
			}?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
		<?php
			echo $this->Paginator->counter(array('format' => __('Página %page% de %pages%, mostrando %current% registros de un total de %count%, desde el %start%, hasta el %end%', true)));
		?>
	</p>
	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('anterior', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('siguiente', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
	<div class="actions">
		<ul>
			<li>	<?php echo $this->Html->link(__('Agregar', true), array('action' => 'add'),array('class'=>'add')); ?>
</li>
		</ul>
	</div>
</div>
