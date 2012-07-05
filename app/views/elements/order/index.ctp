<?php $mapColor=array("1"=>"pendiente",'2'=>'despachado','3'=>'rechazado','4'=>'entregado', '5'=>'aprobado')?>
<style>
#reject-form p{
	font-size:10px;
	margin-bottom:10px;
}
#reject-form textarea{
	height:75px;
}
.actualizando{
	color:blue;
}
</style>

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
<div id="reject-form" title="<?php __('Motivos de rechazo')?>">
	<p>
		<?php __("Por favor escriba los motivos por los cuales se rechaza esta orden.")?>
		<br /><br />
		<?php __("Lo que escriba en esta área de texto se enviará en un mensaje a la persona que envió la orden y al departamenteo de atención de clientes de ComoPromos")?>
	</p>
	<textarea  name="comments" id="comments" "></textarea>
	<div class="actualizando" style="display:none;font-size: 10px; text-align: center; margin-top: 10px;"> </div>	

</div>
<div id="confirm" title="<?php __('Cambiar estao de orden')?>">
	<p style='sont-size:10px;'>
		<?php __('En realidad desea cambiar el estado de la orden a ')?><span style='color:red;'></span>
	</p>
	<div class="actualizando" style="display:none;font-size: 10px; text-align: center; margin-top: 10px;"> Cambiando Estado .... Espere un momento</div>
</div>
<?php $lastOrder=isset($orders[0])? $orders[0]['Order']['id']:0;?>
<script type="text/javascript">
 var lastOrder="<?php echo $lastOrder; ?>";
$(function(){
	$('#comments').keyup(function(){
		$('#reject-form .actualizando').hide().text('');
	});
	var $selectTrigger=null;
	$( "#reject-form" ).dialog({
			autoOpen: false,
			height: 305,
			width: 350,
			modal: true,
			buttons: {
				"Rechazar": function() {
					if($('#comments').val()){
						$("#reject-form .actualizando").text('Cambiando Estado .... Espere un momento').show();
						$dialog=$( this );
						BJS.JSON('/orders/changeStatus/'+$selectTrigger.attr('rel')+'/'+$selectTrigger.find('option:selected').val()+"/"+$('#comments').val(),{},function(response){
							if(response.success){					
								location.reload(true);
							}else{					
								$selectTrigger.val(response.prev);
								alert('<?php __('No se pudo actualizar el estado de la orden.')?>');
								$dialog.dialog( "close" )
								
							}
							$dialog.dialog( "close" );
							$("#reject-form textarea").val("");
						});
					}else{
						$("#reject-form .actualizando").text('Debe escribir un comentario para rechazar una orden').show();
					}
					
					
				},
				'Cancelar': function() {
					$selectTrigger.val($selectTrigger.attr('prev'));
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				$("#reject-form .actualizando").hide();

			}
	});
	$( "#confirm" ).dialog({
			autoOpen: false,
			height: 180,
			width: 350,
			modal: true,
			buttons: {
				"Aceptar": function() {
					$("#confirm .actualizando").show();
					$dialog=$( this );
					BJS.JSON('/orders/changeStatus/'+$selectTrigger.attr('rel')+'/'+$selectTrigger.find('option:selected').val(),{},function(response){
						if(response.success){					
							location.reload(true);
						}else{					
							$selectTrigger.val(response.prev);
							alert('<?php __('No se pudo actualizar el estado de la orden.')?>');
							$dialog.dialog( "close" )
							
						}
						$dialog.dialog( "close" );
					});
				},
				'Cancelar': function() {
					$dialog=$( this );
					$selectTrigger.val($selectTrigger.attr('prev'));
					$dialog.dialog( "close" );
				}
			},
			close: function() {
				$("#confirm span").text("");
				$("#confirm .actualizando").hide();
			}
	});
	$(document).on('change','select[rel]',function(e){
			var $that=$selectTrigger=$(this);
			var con=false;
			if($that.find('option:selected').val()==3){//QUIERE RECHAZAR EL PEDIDO
				$( "#reject-form" ).dialog( "open" );
			}else{
			$( "#confirm span").text($selectTrigger.find('option:selected').text());
			$( "#confirm").dialog( "open" );
				//con=confirm('<?php __('En realidad desea cambiar el estado de la orden a ')?>'+$(this).find('option:selected').text());
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