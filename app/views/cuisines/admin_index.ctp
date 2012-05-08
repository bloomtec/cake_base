
<div class="cuisines index">
	<h2><?php __('Cocinas');?></h2>
	<table cellpadding="0" cellspacing="0" >
	<tr  >
		<th><?php echo $this->Paginator->sort(__('Nombre', true), 'name');?></th>
		<th><?php echo $this->Paginator->sort(__('Descripción', true), 'description');?></th>
		<th><?php echo $this->Paginator->sort(__('Imagen', true), 'image');?></th>
		<!--
		<th><?php echo $this->Paginator->sort('created');?></th>
		<th><?php echo $this->Paginator->sort('updated');?></th>
		-->
		<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($cuisines as $cuisine):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?> id='<?php echo $cuisine['Cuisine']['id'] ?>'>
		<td><?php echo $cuisine['Cuisine']['name']; ?>&nbsp;</td>
		<td><?php echo $cuisine['Cuisine']['description']; ?>&nbsp;</td>
		<td><?php echo $this->Html->image('uploads/50x50/'.$cuisine['Cuisine']['image']); ?>&nbsp;</td>
		<!--
		<td><?php echo $cuisine['Cuisine']['created']; ?>&nbsp;</td>
		<td><?php echo $cuisine['Cuisine']['updated']; ?>&nbsp;</td>
		-->
		<td class="actions">
			<?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $cuisine['Cuisine']['slug']),array('class'=>'view icon','title'=>__('Ver',true))); ?>
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $cuisine['Cuisine']['id']),array('class'=>'edit icon','title'=>__('Editar',true))); ?>
			<?php echo $this->Html->link(__('Eliminar', true), array('action' => 'delete', $cuisine['Cuisine']['id']), array('class'=>'delete icon','title'=>__('Eliminar',true)), sprintf(__('Are you sure you want to delete # %s?', true), $cuisine['Cuisine']['id'])); ?>
			<?php
				if(isset($cuisine['Cuisine']['active'])&& $cuisine['Cuisine']['active']) {
					echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $cuisine['Cuisine']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $cuisine['Cuisine']['id']));
				}
			?>
			<?php
				if(isset($cuisine['Cuisine']['active'])&& !$cuisine['Cuisine']['active']) {
					echo $this->Html->link(__(' ', true), array('action' => 'setActive', $cuisine['Cuisine']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $cuisine['Cuisine']['id']));
				}
			?>
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
