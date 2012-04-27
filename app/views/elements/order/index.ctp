<?php $mapColor=array("1"=>"pendiente",'2'=>'despachado','3'=>'rechazado','4'=>'entregado')?>
<div class="orders index">
	<h2><?php __('Ordenes');?></h2>
	<table cellpadding="0" cellspacing="0" id ="orders" >
	<tr  >
		<th><?php echo $this->Paginator->sort('Código', 'code');?></th>
		<th><?php echo $this->Paginator->sort('Usuario', 'user_id');?></th>
		<th><?php echo $this->Paginator->sort('Dirección', 'address_id');?></th>
		<th><?php echo $this->Paginator->sort('Cantidad', 'quantity');?></th>
		<th><?php echo $this->Paginator->sort('Promoción', 'deal_id');?></th>
		<!--<th><?php echo $this->Paginator->sort('Aprobada', 'is_approved');?></th>-->
		<th><?php echo $this->Paginator->sort('Estado', 'order_state_id');?></th>
		<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($orders as $order):
		$class =  ' class="'.$mapColor[$order['OrderState']['id']].'"';
		
		if ($i++ % 2 == 0) {
			$class = ' class="altrow '.$mapColor[$order['OrderState']['id']].'"';
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
		<!--
		<td>
			<?php
				if($order['Order']['is_approved']) {
					echo '<input type="checkbox" disabled checked />';
				} else {
					echo '<input type="checkbox" disabled />';
				}
			?>
		</td>
		-->
		<td>
			<?php echo $this -> Form -> input('order_state_id',array('options'=>$orderStates,'value'=>$order['OrderState']['id'],'label'=>false,'rel'=>$order['Order']['id']));  ?>
		</td>
		<td class="actions">
			<?php
				echo $this->Html->link(__('Ver', true), array('action' => 'view', $order['Order']['id']),array('class'=>'view icon','title'=>__('View',true)));
				if($this -> Session -> read('Auth.User.role_id') == 4) {
					if(!$order['Order']['is_approved']) {
						echo $this->Html->link(__('Aprovar', true), array('action' => 'approve', $order['Order']['id']),array('class'=>'edit icon','title'=>__('Approve',true)));
					} else {
						echo $this->Html->link(__('Editar', true), array('action' => 'edit', $order['Order']['id']),array('class'=>'edit icon','title'=>__('Edit',true)));
					}
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
</div>
<?php $lastOrder=isset($orders[0])? $orders[0]['Order']['id']:0;?>
<script type="text/javascript">
 	var lastOrder="<?php echo $lastOrder; ?>";
	$(function(){
		$('select[rel]').change(function(){
			alert($(this).attr('rel')+"=>"+$(this).find('option:selected').val());
		});
		setInterval(function(){
			BJS.JSON('/orders/orderStatus/'+lastOrder,{},function(response){
				if(response){
					switch(response.event){
						case "newOrder":
						var tr="<tr class='no-vista nueva'>\
									<td>"+response.value.Order.code+"</td>\
									<td>"+response.value.User.email+"</td>\
									<td>"+response.value.Address.address+"</td>\
									<td>"+response.value.Order.quantity+"</td>\
									<td><a href='/owner/deals/view/"+response.value.Deal.slug+"'>"+response.value.Deal.name+"</a></td>\
									<td>"+"<input type='checkbox' disabled=''>"+"</td>\
									<td>"+response.value.OrderState.name+"</td>\
									<td class='actions'>\
										<a title='View' class='view icon' href='/owner/orders/view/"+response.value.Order.id+"'>Ver</a>\
										<a title='Approve' class='edit icon' href='/owner/orders/approve/"+response.value.Order.id+"'>Aprovar</a>\
									</td>\
								</tr>";
						$("table#orders tr:first-child").after(tr);
						lastOrder=response.value.Order.id;
						break;
						
					}
				}else{
					//NO HAY EVENTO
				}
			});
		},5000);
	});
</script>