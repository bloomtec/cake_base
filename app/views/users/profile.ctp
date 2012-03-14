<!-- <div class="datos_perfil primero">
<img src="/img/foto_perfil.png" />
<a href="#">Cambiar imagen</a>
</div>

<div class="datos_perfil">
	<h1>Datos Personales</h1>
	<h2>Nombre y apellido:</h2>
	<span><?php echo  $user['User']['name'].' '. $user['User']['last_name']
		?>&nbsp;</span>
	<h2>Email:</h2>
	<span><?php echo $user['User']['email'];?>&nbsp;</span>
	<h2>Teléfono:</h2>
	<span><?php echo  $user['User']['phone']
		?>&nbsp; </span>
	<h2>Ciudad:</h2>
	<span><?php echo $user['City']['name']
		?>&nbsp;</span>

</div>
<div style="clear: both"></div>
-->
<?php //echo $this -> element('share-in-facebook'); ?>
<div class="comprados">
	<h1>Mis pedidos</h1>
	<?php //$productsVisited= $this -> requestAction('/visited_products/visited');?>
	<?php //echo $this -> element('listado_producto',array('products'=>$productsVisited));?>
	<div style="clear: both"></div>
</div>
<?php if($orders){?>
<table id="ordenes">
	<tr>
		<th>Código</th>
		<th>Estado</th>
		<th>Promocion</th>
		<th>Fecha</th>
	</tr>

<?php foreach($orders as $order):?>
	<tr>
		<td><?php echo $order['Order']['code']; ?></td>
		<td><?php echo $order['OrderState']['name']; ?></td>
		<td>
			<?php echo $html->image("uploads/".$order['Deal']['image'],array('width'=>250)); ?>
			<?php echo $order['Deal']['name']; ?>
		</td>
		<td><?php echo $order['Order']['created']; ?></td>
	</tr>
<?php endforeach; ?>
</table>
<?php }else{ ?>
	<p class="message">NO TIENES ORDENES</p>
<?php } ?>