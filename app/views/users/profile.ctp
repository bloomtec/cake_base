<h1><?php __('Mis pedidos'); ?></h1>
<?php if($orders){?>
<table id="ordenes" cellpadding="0" cellspacing="0" >
	<tr>
		<th><?php echo $this -> Paginator -> sort(__('Código', true), 'Order.code');?></th>
		<th><?php echo $this -> Paginator -> sort(__('Estado', true), 'OrderState.name');?></th>		
		<th><?php echo $this -> Paginator -> sort(__('Promocion', true), 'Deal.name');?></th>
		<th><?php echo $this -> Paginator -> sort(__('Restaurante', true), 'Deal.Restaurant.name');?></th>
		<th><?php echo $this -> Paginator -> sort(__('Fecha', true), 'Order.created');?></th>
	</tr>

<?php foreach($orders as $order):?>
	<tr>
		<td><?php echo $order['Order']['code']; ?></td>
		<td><?php echo $order['OrderState']['name']; ?></td>		
		<td>
			<?php echo $html->image("uploads/".$order['Deal']['image'],array('width'=>250)); ?>
			<?php echo $order['Deal']['name']; ?>
		</td>
		<td style='text-align:left;'>
			<h1 style='padding-left:0;'><?php echo $order['Deal']['Restaurant']['name']?></h1>
			<br style='clear:both;' />
			<span> <?php __('Teléfono: ') ?> </span><?php echo $order['Deal']['Restaurant']['phone']?><br />
			<span> <?php __('Dirección: ') ?> </span><?php echo $order['Deal']['Restaurant']['address']?><br />
		</td>
		<td><?php echo $order['Order']['created']; ?></td>
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
<?php }else{ ?>
	<p class="message"><?php __('NO TIENES ORDENES');?></p>
<?php } ?>