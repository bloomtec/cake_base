<div class="zones index">
	<h2><?php __('Barrios');?></h2>
	<table cellpadding="0" cellspacing="0" >
	<tr  >
		<th><?php echo $this->Paginator->sort(__('Ciudad', true), 'city_id');?></th>
		<th><?php echo $this->Paginator->sort(__('Nombre', true), 'name');?></th>
		<th><?php echo $this->Paginator->sort(__('Descripción', true), 'description');?></th>
		<th><?php echo $this->Paginator->sort(__('Imagen', true), 'image');?></th>
		<!--
		<th><?php echo $this->Paginator->sort('lat');?></th>
		<th><?php echo $this->Paginator->sort('long');?></th>
		<th><?php echo $this->Paginator->sort('created');?></th>
		<th><?php echo $this->Paginator->sort('updated');?></th>
		-->
		<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($zones as $zone):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?> id='<?php echo $zone['Zone']['id'] ?>'>
		<td>
			<?php echo $this->Html->link($zone['City']['name'], array('controller' => 'cities', 'action' => 'view', $zone['City']['id'])); ?>
		</td>
		<td><?php echo $zone['Zone']['name']; ?>&nbsp;</td>
		<td><?php echo $zone['Zone']['description']; ?>&nbsp;</td>
		<td><?php echo $this->Html->image('uploads/100x100/'.$zone['Zone']['image']); ?>&nbsp;</td>
		<!--
		<td><?php echo $zone['Zone']['lat']; ?>&nbsp;</td>
		<td><?php echo $zone['Zone']['long']; ?>&nbsp;</td>
		<td><?php echo $zone['Zone']['created']; ?>&nbsp;</td>
		<td><?php echo $zone['Zone']['updated']; ?>&nbsp;</td>
		-->
		<td class="actions">
			<?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $zone['Zone']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $zone['Zone']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__('Eliminar', true), array('action' => 'delete', $zone['Zone']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $zone['Zone']['id'])); ?>
			<?php if(isset($zone['Zone']['active'])&& $zone['Zone']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $zone['Zone']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $zone['Zone']['id']));
}?>
			<?php if(isset($zone['Zone']['active'])&& !$zone['Zone']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $zone['Zone']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $zone['Zone']['id'])); 
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
