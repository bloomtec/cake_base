<div class="inventory index">
	<?php $pid = $product['Product']['id']; ?>
	<!-- INFORMACIÓN BÁSICA DEL PRODUCTO -->
	<h2><?php __("Product :: ".$product['Product']['name'] . " :: " . $product['Product']['ref']);?></h2>
	<!-- FIN INFORMACIÓN BÁSICA DEL PRODUCTO -->
	
	<!-- INFORMACIÓN DEL INVENTARIO DEL PRODUCTO -->
	<h2><?php __('Inventory');?></h2>
	<div id="updateInventoryForm">
		<?php e($this->Form->create('Inventory', array('action'=>'/listProductInventory/'. $pid))); ?>
		<table cellpadding="0" cellspacing="0">
			<tr>
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
				<td><?php echo $data['Inventory']['quantity'];?>&nbsp;</td>
				<td><?php e($this->Form->input("$pid", array('label'=>false, 'value'=>0))); ?></td>
			</tr>
			<tr>
				<?php e($this->Form->input('comment', array('value'=>''))); ?>
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