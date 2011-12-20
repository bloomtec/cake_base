<div class="products index">
	<div class="form-filtrar">
		<?php e($this->Form->create('Product')); ?>
		<table class="table-filtrar" cellpadding="0" cellspacing="0" >
			<tr>
				<td class="td-label"><label for="ProductProductTypeId">Tipo De Producto</label></td><td><?php e($this->Form->input('product_type_id', array('empty'=>'Seleccione...', 'label'=>false))); ?></td>
				<td class="td-label"><label for="ProductPalabraClave">Palabra Clave</label></td><td><?php e($this->Form->input('palabra_clave', array('label'=>false))); ?></td>
				<td class="td-submit"><?php e($this->Form->end('Filtrar')); ?></td>
			</tr>
		</table>
	</div>
	<h2 class="h2-filtrar"><?php __('Products');?></h2>
	<table cellpadding="0" cellspacing="0" >
	<tr  >
		<th><?php echo $this->Paginator->sort('product_type_id');?></th>
		<th><?php echo $this->Paginator->sort('name');?></th>
		<th><?php echo $this->Paginator->sort('ref');?></th>
		<th><?php echo $this->Paginator->sort('price');?></th>
		<th><?php echo $this->Paginator->sort('image');?></th>
		<th><?php echo $this->Paginator->sort(_('Gamers'), 'is_gamers');?></th>
		<th><?php echo $this->Paginator->sort(__('Activo'),'is_active');?></th>
		<th><?php echo $this->Paginator->sort(__('Visitas'), 'times_visited');?></th>
		<th><?php __('Inventario'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($products as $product):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?> id='<?php echo $product['Product']['id'] ?>'>
		<td><?php echo $product['ProductType']['name']; ?>&nbsp;</td>
		<td><?php echo $product['Product']['name']; ?>&nbsp;</td>
		<td><?php echo $product['Product']['ref']; ?>&nbsp;</td>
		<td>$<?php echo number_format($product['Product']["price"], 0, ' ', '.'); ?>&nbsp;</td>
		<td><?php echo $this->Html->image('uploads/100x100/'.$product['Product']['image']); ?>&nbsp;</td>
		<td><?php if($product['Product']['is_gamers']){echo "Sí";}else{echo "No";} ?>&nbsp;</td>
		<td><?php if($product['Product']['is_active']){echo "Sí";}else{echo "No";} ?>&nbsp;</td>
		<td><?php echo $product['Product']['times_visited']; ?>&nbsp;</td>
		<td><?php echo $this->requestAction('/inventories/checkProductAvailability/'.$product['Product']['id']); ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $product['Product']['slug']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $product['Product']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__('Gallery', true), array('controller' => 'product_pictures','action'=>'view', $product['Product']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Inventory', true), array('controller' => 'inventories','action'=>'listProductInventory', $product['Product']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $product['Product']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $product['Product']['id'])); ?>
			<?php
				if(isset($product['Product']['active'])&& $product['Product']['active']){
					echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $product['Product']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $product['Product']['id']));
				}
				if(isset($product['Product']['active'])&& !$product['Product']['active']){
					echo $this->Html->link(__(' ', true), array('action' => 'setActive', $product['Product']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $product['Product']['id']));
				}
			?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
	<div class="actions">
		<ul>
			<li>	<?php echo $this->Html->link(__('Add', true), array('action' => 'add'),array('class'=>'add')); ?>
</li>
		</ul>
	</div>
</div>
