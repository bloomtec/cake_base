
<div class="cities index">
	<h2><?php __('Ciudades');?></h2>
	<table cellpadding="0" cellspacing="0" >
	<tr  >
		<th><?php echo $this->Paginator->sort(__('País', true), 'country_id');?></th>
		<th><?php echo $this->Paginator->sort(__('Nombre', true), 'name');?></th>
		<th><?php echo $this->Paginator->sort(__('Descripción', true), 'description');?></th>
		<th><?php echo $this->Paginator->sort(__('Imagen', true), 'image');?></th>
		<th><?php echo $this->Paginator->sort(__('Presente', true), 'is_present');?></th>
		<th><?php echo $this->Paginator->sort(__('Código', true), 'code');?></th>
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
	foreach ($cities as $city):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?> id='<?php echo $city['City']['id'] ?>'>
		<td>
			<?php echo $this->Html->link($city['Country']['name'], array('controller' => 'countries', 'action' => 'view', $city['Country']['id'])); ?>
		</td>
		<td><?php echo $city['City']['name']; ?>&nbsp;</td>
		<td><?php echo $city['City']['description']; ?>&nbsp;</td>
		<td><?php echo $this->Html->image('uploads/100x100/'.$city['City']['image']); ?>&nbsp;</td>
		<td>
			<?php
				// echo $city['City']['is_present'];
				if($city['City']['is_present']) {
					echo '<input type="checkbox" disabled checked />';
				} else {
					echo '<input type="checkbox" disabled />';
				}
			?>
			&nbsp;
		</td>
		<td><?php echo $city['City']['code']; ?>&nbsp;</td>
		<!--
		<td><?php echo $city['City']['lat']; ?>&nbsp;</td>
		<td><?php echo $city['City']['long']; ?>&nbsp;</td>
		<td><?php echo $city['City']['created']; ?>&nbsp;</td>
		<td><?php echo $city['City']['updated']; ?>&nbsp;</td>
		-->
		<td class="actions">
			<?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $city['City']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $city['City']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__('Eliminar', true), array('action' => 'delete', $city['City']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $city['City']['id'])); ?>
			<?php if(isset($city['City']['active'])&& $city['City']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $city['City']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $city['City']['id']));
}?>
			<?php if(isset($city['City']['active'])&& !$city['City']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $city['City']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $city['City']['id'])); 
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
				<?php echo $this->Html->link(__('Agregar', true), array('action' => 'add'),array('class'=>'add')); ?>
			</li>
		</ul>
	</div>
</div>
