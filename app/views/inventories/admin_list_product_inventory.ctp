<div class="inventory index">
	<?php $pid = $product['Product']['id']; ?>
	<div class="info" style="margin-left: 22%; margin-right: 22%;">
		<h2><?php __('Inventory');?></h2>
		<h2><?php __("Product :: ".$product['Product']['name']);?></h2>
		<h2><?php __("Ref :: ".$product['Product']['ref']);?></h2>
	</div>	
	<div id="updateInventoryForm">
		<?php e($this->Form->create('Inventory', array("style"=>"width: 50%; margin-left: auto; margin-right: auto;", 'id'=>'UpdateInventory', 'action'=>"listProductInventory/$pid"))); ?>
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
				<td style="text-align: center;"><?php echo $data['Inventory']['quantity'];?>&nbsp;</td>
				<td><?php e($this->Form->input("$pid", array('label'=>false, 'value'=>0, 'style'=>'text-align: center;'))); ?></td>
			</tr>
			<tr>
				<?php //e($this->Form->input('comment', array('value'=>''))); ?>
				<div class="input text">
					<label for="InventoryComment">Comment</label>
					<textarea id="InventoryComment" value="" name="data[Inventory][comment]" ></textarea>
				</div>
			</tr>
			<?php endforeach;?>
		</table>
		<?php //e($this->Form->end('Actualizar Inventario')); ?>
		<div class="submit">
			<input type="submit" value="Actualizar Inventario" style="width: 220px;">
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