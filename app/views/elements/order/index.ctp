<div class="orders index">
	<h2><?php __('Orders');?></h2>
	<table cellpadding="0" cellspacing="0" >
	<tr  >
		<th><?php echo $this->Paginator->sort('Código', 'code');?></th>
		<th><?php echo $this->Paginator->sort('Usuario', 'user_id');?></th>
		<th><?php echo $this->Paginator->sort('Dirección', 'address_id');?></th>
		<th><?php echo $this->Paginator->sort('Cantidad', 'quantity');?></th>
		<th><?php echo $this->Paginator->sort('Promoción', 'deal_id');?></th>
		<th><?php echo $this->Paginator->sort('Estado', 'order_state_id');?></th>
		<th><?php echo $this->Paginator->sort('Creada', 'created');?></th>
		<th><?php echo $this->Paginator->sort('Actualizada', 'updated');?></th>
		<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($orders as $order):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?> id='<?php echo $order['Order']['id'] ?>'>
		<td><?php echo $order['Order']['code']; ?>&nbsp;</td>
		<td>
			<?php
				if($this -> Session -> read('Auth.User.role_id') == 1) {
					echo $this->Html->link($order['User']['email'], array('controller' => 'users', 'action' => 'view', $order['User']['id']));
				} else {
					echo $order['User']['email'];
				}
			?>
		</td>
		<td>
			<?php echo $order['Address']['address']; ?>
		</td>
		<td><?php echo $order['Order']['quantity']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($order['Deal']['name'], array('controller' => 'deals', 'action' => 'view', $order['Deal']['slug'])); ?>
		</td>
		<td>
			<?php echo $order['OrderState']['name']; ?>
		</td>
		<td><?php echo $order['Order']['created']; ?>&nbsp;</td>
		<td><?php echo $order['Order']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php
				echo $this->Html->link(__('Ver', true), array('action' => 'view', $order['Order']['id']),array('class'=>'view icon','title'=>__('View',true)));
				if($this -> Session -> read('Auth.User.role_id') == 4) {
					echo $this->Html->link(__('Editar', true), array('action' => 'edit', $order['Order']['id']),array('class'=>'edit icon','title'=>__('Edit',true)));
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
</div>