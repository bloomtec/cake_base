<div class="orderFilter">
	<?php echo $this -> Form -> create(null, array('style' => 'width: 100%;')); ?>
	<table id="TableFilters">
		<tbody>
			<tr>
				<td style="max-width: 100px;">
					<?php echo $this -> Form -> input('Filtros.nombre', array('label' => __('Nombre', true), 'value' => '')); ?>
				</td>
				<td style="max-width: 100px;">
					<?php echo $this -> Form -> input('Filtros.barrio', array('label' => __('Barrio', true), 'value' => '')); ?>
				</td>
				<td style="max-width: 100px;">
					<?php echo $this -> Form -> input('Filtros.telefono', array('label' => __('Telefono', true), 'value' => '')); ?>
				</td>
				<td><?php echo $this -> Form -> end('Filtrar'); ?></td>
			</tr>
		</tbody>
	</table>
</div>
<div class="restaurants index">
	<h2><?php __('Restaurantes');?></h2>
	<table cellpadding="0" cellspacing="0" >
	<tr>
		<th><?php echo $this->Paginator->sort(__('Barrio', true), 'zone_id');?></th>
		<th><?php echo $this->Paginator->sort(__('Nombre', true), 'name');?></th>
		<th><?php echo $this->Paginator->sort(__('Descripción', true), 'description');?></th>
		<th><?php echo $this->Paginator->sort(__('Teléfono', true), 'phone');?></th>
		<th><?php echo $this->Paginator->sort(__('Imagen', true), 'image');?></th>
		<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($restaurants as $restaurant):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?> id='<?php echo $restaurant['Restaurant']['id'] ?>'>
		<td>
			<?php
				if($this -> Session -> read('Auth.User.role_id') != 4) {
					echo $this->Html->link($restaurant['Zone']['name'], array('controller' => 'zones', 'action' => 'view', $restaurant['Zone']['id']));
				} else {
					echo $restaurant['Zone']['name'];
				}
			?>
		</td>
		<td><?php echo $restaurant['Restaurant']['name']; ?>&nbsp;</td>
		<td><?php echo $restaurant['Restaurant']['description']; ?>&nbsp;</td>
		<td><?php echo $restaurant['Restaurant']['phone']; ?>&nbsp;</td>
		<td><?php echo $this->Html->image('uploads/100x100/'.$restaurant['Restaurant']['image']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $restaurant['Restaurant']['id']),array('class'=>'view icon','title'=>__('Ver',true))); ?>
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $restaurant['Restaurant']['id']),array('class'=>'edit icon','title'=>__('Editar',true))); ?>
			<?php
				if($this -> Session -> read('Auth.User.role_id') != 4) {
					echo $this->Html->link(__('Eliminar', true), array('action' => 'delete', $restaurant['Restaurant']['id']), array('class'=>'delete icon','title'=>__('Eliminar',true)), sprintf(__('Are you sure you want to delete # %s?', true), $restaurant['Restaurant']['id']));
				}
			?>
			<?php if(isset($restaurant['Restaurant']['active'])&& $restaurant['Restaurant']['active']){
				echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $restaurant['Restaurant']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $restaurant['Restaurant']['id']));
			}?>
			<?php if(isset($restaurant['Restaurant']['active'])&& !$restaurant['Restaurant']['active']){
				echo $this->Html->link(__(' ', true), array('action' => 'setActive', $restaurant['Restaurant']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $restaurant['Restaurant']['id'])); 
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
			<li>
				<?php
					if($this -> Session -> read('Auth.User.role_id') != 4) {
						echo $this->Html->link(__('Agregar', true), array('action' => 'add'),array('class'=>'add'));
					}
				?>
			</li>
		</ul>
	</div>
</div>