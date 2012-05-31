<?php $mapColor=array("1"=>"pendiente",'2'=>'despachado','3'=>'rechazado','4'=>'entregado', '5'=>'aprobado')?>
<div class="orders index">
	<h2><?php __('Ordenes');?></h2>
	<table cellpadding="0" cellspacing="0" id ="orders" >
	<tr  >
		<th><?php echo $this->Paginator->sort(__('Código', true), 'code');?></th>
		<th><?php echo $this->Paginator->sort(__('Usuario', true), 'user_id');?></th>
		<th><?php echo $this->Paginator->sort(__('Dirección', true), 'address_id');?></th>
		<th><?php echo $this->Paginator->sort(__('Cantidad', true), 'quantity');?></th>
		<th><?php echo $this->Paginator->sort(__('Promoción', true), 'deal_id');?></th>
		<th><?php echo $this->Paginator->sort('Nota', 'note');?></th>
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
		<td>
			<?php
				echo $order['Order']['note'];
			?>
		</td>
		<td>
			<?php echo $this -> Form -> input('order_state_id',array('options'=>$orderStates,'value'=>$order['OrderState']['id'],'label'=>false,'rel'=>$order['Order']['id'],'prev'=>$order['OrderState']['id']));  ?>
		</td>
		<td class="actions">
			<?php
				echo $this->Html->link(__('Ver', true), array('action' => 'view', $order['Order']['id']),array('class'=>'view icon','title'=>__('View',true)));
				
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
	var prev=-1;
		$(document).on('change','select[rel]',function(e){
			var onPrev=prev;
			var $that=$(this);
			var con=confirm('<?php __('En realidad desea cambiar el estado de la orden a ')?>'+$(this).find('option:selected').text());
			if(con){
				BJS.JSON('/orders/changeStatus/'+$(this).attr('rel')+'/'+$that.find('option:selected').val(),{},function(response){
				if(response.success){					
					location.reload(true);
				}else{					
					$that.val(response.prev);
					alert('<?php __('No se pudo actualizar el estado de la orden.')?>');
				}
			});
			}else{
				$that.val($that.attr('prev'));
			}			
		});
		setInterval(function(){
			BJS.JSON('/orders/orderStatus/'+lastOrder,{},function(response){
				if(response){
					switch(response.event){
						case "newOrder":
						var tr="<tr class='pendiente nueva'>\
									<td>"+response.value.Order.code+"</td>\
									<td>"+response.value.User.email+"</td>\
									<td>"+response.value.Address.address+"</td>\
									<td>"+response.value.Order.quantity+"</td>\
									<td><a href='/owner/deals/view/"+response.value.Deal.slug+"'>"+response.value.Deal.name+"</a></td>\
									<td>"+response.value.Order.note+"</td>\
									<td><select id='order_state_id' rel='"+response.value.Order.id+"' name='data[order_state_id]' prev='1'>\
										<option selected='selected' value='1'>Pendiente</option>\
										<option value='5'>Aprobada</option>\
										<option value='2'>Despachada</option>\
										<option value='3'>Rechazada</option>\
										<option value='4'>Entregada</option>\
										</select></td>\
									<td class='actions'>\
										<a title='View' class='view icon' href='/owner/orders/view/"+response.value.Order.id+"'>Ver</a>\
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