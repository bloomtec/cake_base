<div class="inventory index">
	<?php $pid = $product['Product']['id']; ?>
	<!-- INFORMACIÓN BÁSICA DEL PRODUCTO -->
	<h2><?php __("Product :: ".$product['Product']['name'] . " :: " . $product['Product']['clasification']);?></h2>
	<!-- FIN INFORMACIÓN BÁSICA DEL PRODUCTO -->
	
	<!-- FORMULARIO PARA AGREGAR UN INVENTARIO -->
	<div id="addInventoryForm">
		<?php e($this->Form->create('Inventory', array('action'=>'/listProductInventory/'. $pid .'/update:0'))); ?>
		<table cellpadding="0" cellspacing="0">
			<tr>
				<td><?php e($this->Form->hidden('product_id', array('value'=>$pid))); ?></td>
				<td><?php e($this->Form->input('size_id', array('options'=>$size_id))); ?></td>
				<td><?php e($this->Form->input('quantity', array('value'=>0))); ?></td>
				<td id="col-submit"><?php e($this->Form->end('Add Inventory')); ?></td>
			</tr>
		</table>
	</div>
	<!-- FIN FORMULARIO PARA AGREGAR UN INVENTARIO -->
	
	<!-- INFORMACIÓN DEL INVENTARIO DEL PRODUCTO -->
	<h2><?php __('Inventory');?></h2>
	<div id="updateInventoryForm">
		<?php e($this->Form->create('Inventory', array('action'=>'/listProductInventory/'. $pid .'/update:1'))); ?>
		<table cellpadding="0" cellspacing="0">
			<tr>
				<th><?php echo $this -> Paginator -> sort('size_id');?></th>
				<th><?php echo $this -> Paginator -> sort('quantity');?></th>
				<th><?php __('Cantidad a sumar (59)/restar (-59)');?></th>
			</tr>
			<?php 
				$i = 0;
				foreach ($inventory as $data):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
			?>
			<tr<?php echo $class;?>>
				<td><?php echo $this->requestAction('/size_references/getSize/' . $data['Size']['size_reference_id']);?></td>
				<td><?php echo $data['Inventory']['quantity'];?>&nbsp;</td>
				<td><?php $iid=$pid.",".$data['Size']['id']; e($this->Form->input("$iid", array('label'=>false, 'value'=>0))); ?></td>
			</tr>
			<?php endforeach;?>	
		</table>
		<?php e($this->Form->end('Actualizar Inventario')); ?>
		<p>
			<?php echo $this -> Paginator -> counter(array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true))); ?>
		</p>
		<div class="paging">
			<?php echo $this -> Paginator -> prev('<< ' . __('previous', true), array(), null, array('class' => 'disabled'));?> | <?php echo $this -> Paginator -> numbers();?> | <?php echo $this -> Paginator -> next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
		</div>
		<div class="actions">
			<ul>
				<li>
					<?php e($this->Html->link('Back', array('controller'=>'products', 'action'=>'index'))); ?>
				</li>
			</ul>
		</div>
	</div>
	<!-- FIN INFORMACIÓN DEL INVENTARIO DEL PRODUCTO -->
</div>