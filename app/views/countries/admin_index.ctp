
<div class="countries index">
	<h2><?php __('Countries');?></h2>
	<table cellpadding="0" cellspacing="0" >
	<tr  >
		<th><?php echo $this->Paginator->sort(__('Nombre', true), 'name');?></th>
		<th><?php echo $this->Paginator->sort(__('Descripción', true), 'description');?></th>
		<th><?php echo $this->Paginator->sort(__('Imagen', true), 'image');?></th>
		<th><?php echo $this->Paginator->sort(__('Lenguaje', true), 'language');?></th>
		<th><?php echo $this->Paginator->sort(__('Presente', true), 'is_present');?></th>
		<th><?php echo $this->Paginator->sort(__('Código', true), 'code');?></th>
		<!--
		<th><?php echo $this->Paginator->sort('created');?></th>
		<th><?php echo $this->Paginator->sort('updated');?></th>
		-->
		<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($countries as $country):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?> id='<?php echo $country['Country']['id'] ?>'>
		<td><?php echo $country['Country']['name']; ?>&nbsp;</td>
		<td><?php echo $country['Country']['description']; ?>&nbsp;</td>
		<td><?php echo $this->Html->image('uploads/100x100/'.$country['Country']['image']); ?>&nbsp;</td>
		<td><?php echo $country['Country']['language']; ?>&nbsp;</td>
		<td>
			<?php
				// echo $country['Country']['is_present'];
				if($country['Country']['is_present']) {
					echo '<input type="checkbox" disabled checked />';
				} else {
					echo '<input type="checkbox" disabled />';
				}
			?>
			&nbsp;
		</td>
		<td><?php echo $country['Country']['code']; ?>&nbsp;</td>
		<!--
		<td><?php echo $country['Country']['created']; ?>&nbsp;</td>
		<td><?php echo $country['Country']['updated']; ?>&nbsp;</td>
		-->
		<td class="actions">
			<?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $country['Country']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $country['Country']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__('Eliminar', true), array('action' => 'delete', $country['Country']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $country['Country']['id'])); ?>
			<?php if(isset($country['Country']['active'])&& $country['Country']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $country['Country']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $country['Country']['id']));
}?>
			<?php if(isset($country['Country']['active'])&& !$country['Country']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $country['Country']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $country['Country']['id'])); 
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
