<div class="orderFilter">
	<?php echo $this -> Form -> create(null, array('style' => 'width: 100%;')); ?>
	<table id="TableFilters">
		<tbody>
			<tr>
				<td style="max-width: 100px;">
					<?php echo $this -> Form -> input('Filtros.restaurante', array('label' => __('Restaurante', true), 'value' => '')); ?>
				</td>
				<td style="max-width: 100px;">
					<?php echo $this -> Form -> input('Filtros.nombre', array('label' => __('Nombre', true), 'value' => '')); ?>
				</td>
				<td>
					<table>
						<tbody>
							<tr>
								<td><?php echo $this -> Form -> input('Filtros.usar_fecha_creacion', array('label' => __('Filtrar', true), 'type' => 'checkbox')); ?></td>
								<td><?php echo $this -> Form -> input('Filtros.fecha_inicio_creacion', array('label' => __('Fecha Inicio (creación)', true), 'type' => 'date')); ?></td>
								<td><?php echo $this -> Form -> input('Filtros.fecha_fin_creacion', array('label' => __('Fecha Fin (creación)', true), 'type' => 'date')); ?></td>
							</tr>
							<tr>
								<td><?php echo $this -> Form -> input('Filtros.usar_fecha_vencimiento', array('label' => __('Filtrar', true), 'type' => 'checkbox')); ?></td>
								<td><?php echo $this -> Form -> input('Filtros.fecha_inicio_vencimiento', array('label' => __('Fecha Inicio (vencimiento)', true), 'type' => 'date')); ?></td>
								<td><?php echo $this -> Form -> input('Filtros.fecha_fin_vencimiento', array('label' => __('Fecha Fin (vencimiento)', true), 'type' => 'date')); ?></td>
							</tr>
						</tbody>
					</table>
				</td>
				<td><?php echo $this -> Form -> end('Filtrar'); ?></td>
			</tr>
		</tbody>
	</table>
</div>
<div class="deals index">
	<h2><?php __('Promos');?></h2>
	<table cellpadding="0" cellspacing="0" >
	<tr  >
		<th><?php echo $this->Paginator->sort(__('Restaurante', true), 'restaurant_id');?></th>
		<th><?php echo $this->Paginator->sort(__('Nombre', true), 'name');?></th>
		<!--<th><?php echo $this->Paginator->sort(__('Descripción', true), 'description');?></th>-->
		<th><?php echo $this->Paginator->sort(__('Imagen', true), 'image');?></th>
		<th><?php echo $this->Paginator->sort(__('Cantidad', true), 'amount');?></th>
		<th><?php echo $this->Paginator->sort(__('Precio', true), 'price');?></th>
		<!--<th><?php echo $this->Paginator->sort(__('Limite', true), 'max_buys');?></th>-->
		<th><?php echo $this->Paginator->sort(__('Visitas', true), 'visits');?></th>
		<th><?php echo $this->Paginator->sort(__('Creado', true), 'created');?></th>
		<th><?php echo $this->Paginator->sort(__('Vence', true), 'expires');?></th>
		<th class="actions" style="max-width: 100px;"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($deals as $deal):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?> id='<?php echo $deal['Deal']['id'] ?>'>
		<td>
			<?php echo $this->Html->link($deal['Restaurant']['name'], array('controller' => 'restaurants', 'action' => 'view', $deal['Restaurant']['id'])); ?>
		</td>
		<td><?php echo $deal['Deal']['name']; ?>&nbsp;</td>
		<!--<td><?php echo $deal['Deal']['description']; ?>&nbsp;</td>-->
		<td><?php echo $this->Html->image('uploads/100x100/'.$deal['Deal']['image']); ?>&nbsp;</td>
		<td><?php echo $deal['Deal']['amount']; ?>&nbsp;</td>
		<td><?php echo $deal['Deal']['price']; ?>&nbsp;</td>
		<!--<td><?php echo $deal['Deal']['max_buys']; ?>&nbsp;</td>-->
		<td><?php echo $deal['Deal']['visits']; ?>&nbsp;</td>
		<td><?php echo $deal['Deal']['created']; ?>&nbsp;</td>
		<td><?php echo $deal['Deal']['expires']; ?>&nbsp;</td>
		<td class="actions" style="max-width: 100px;">
			<?php
				echo $this->Html->link(__('Ver', true), array('action' => 'view', $deal['Deal']['slug']),array('style' => 'margin-bottom: 4px; min-width: 50px; float: left; text-align: center;', 'class'=>'view icon','title'=>__('Ver',true)));
				if($this -> Session -> read('Auth.User.role_id') != 4) {
					echo $this->Html->link(__('Editar', true), array('action' => 'edit', $deal['Deal']['id']),array('style' => 'margin-bottom: 4px; min-width: 50px; float: left; text-align: center;', 'class'=>'edit icon','title'=>__('Editar',true)));
					echo $this->Html->link(__('Eliminar', true), array('action' => 'delete', $deal['Deal']['id']), array('style' => 'margin-bottom: 4px; min-width: 50px; float: left; text-align: center;', 'class'=>'delete icon','title'=>__('Eliminar',true)), sprintf(__('Are you sure you want to delete # %s?', true), $deal['Deal']['id']));
				}
			?>
			<?php if(isset($deal['Deal']['active'])&& $deal['Deal']['active']) {
				echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $deal['Deal']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $deal['Deal']['id']));
			} ?>
			<?php if(isset($deal['Deal']['active'])&& !$deal['Deal']['active']) {
				echo $this->Html->link(__(' ', true), array('action' => 'setActive', $deal['Deal']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $deal['Deal']['id'])); 
			} ?>
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
	<?php if($this -> Session -> read('Auth.User.role_id') != 4) : ?>
	<div class="actions">
		<ul>
			<li>
				<?php echo $this->Html->link(__('Agregar', true), array('action' => 'add'),array('class'=>'add')); ?>
			</li>
		</ul>
	</div>
	<?php endif; ?>
</div>