<div class="profile tahoma category">
	<div class='volver'>
		<a href='/users/profile' class="azul"> Volver </a>
	</div>
	<table>
		<tr>
			<td class='first'>Código</td>
			<td class='second'><?php echo $order['Order']['code']
			?></td>
		</tr>
		<tr>
			<td class='first'>Estado del pedido</td>
			<td class='second'><?php echo $order['OrderState']['name']
			?></td>
		</tr>
		<tr>
			<td class='first'>Creada</td>
			<td class='second'><?php echo $order['Order']['created']
			?></td>
		</tr>
		<tr>
			<td class='first'>Sub total</td>
			<td class='second'><?php echo $order['Order']['subtotal']
			?></td>
		</tr>
		<tr>
			<td class='first'>Descuento</td>
			<td class='second'><?php echo $order['Order']['descuento']
			?></td>
		</tr>
		<tr>
			<td class='first'>Total</td>
			<td class='second'><?php echo $order['Order']['total']
			?></td>
		</tr>
		<tr>
			<td class='first'>País</td>
			<td class='second'><?php echo $order['Order']['pais']
			?></td>
		</tr>
		<tr>
			<td class='first'>Estado</td>
			<td class='second'><?php echo $order['Order']['estado']
			?></td>
		</tr>
		<tr>
			<td class='first'>Ciudad</td>
			<td class='second'><?php echo $order['Order']['ciudad']
			?></td>
		</tr>
		<tr>
			<td class='first'>Dirección</td>
			<td class='second'><?php echo $order['Order']['direccion']
			?></td>
		</tr>
		<tr>
			<td class='first'>Teléfono</td>
			<td class='second'><?php echo $order['Order']['telefono']
			?></td>
		</tr>
		<tr>
			<td class='first'>Celular</td>
			<td class='second'><?php echo $order['Order']['celular']
			?></td>
		</tr>
		<tr>
			<td class='first'>Email</td>
			<td class='second'><?php echo $order['Order']['email']
			?></td>
		</tr>
	</table>
	<ul>
		<li class="azul">
			Productos
		</li>
	</ul>
	<br /><br />
	<table id="shop-cart-list" class="tahoma">
		<thead>
			<tr>
				<th align="left">Descripcion de la Prenda</th>
				<th align="left">Talla</th>
				<th align="left">Valor Unidad</th>
				<th align="left">Cantidad</th>
				<th align="left">Total</th>
			</tr>
		</thead>
		<tbody>
			<?php
$subtotal=0;
foreach($order['OrderItem'] as $order_item) :
$model_name = $order_item['model_name'];
$foreign_key =  $order_item['foreign_key'];
$item = $this->requestAction("/$model_name"."s/getProduct/$foreign_key/".$order_item['size_id']);
$subtotal+=$item[$model_name]["price"]*$order_item['quantity'];
			?>
			<tr class="shop-cart-item" rel="<?=$order_item["id"]?>">
				<td class="descripcion">
				<div class="img_carrito">
					<img src="<?php echo"/img/uploads/100x100/".$item["$model_name"]["image"]?>"/>
				</div>
				<div class='info-item'>
					<h1 class="titulos_rosado"><?php echo $item["$model_name"]["name"]
					?></h1>
					<h2 class="titulos_gris"><?php echo $item["$model_name"]["clasification"]
					?></h2>
					<form class="marcar_regalo">
						<?php if($order_item['is_gift']){
						?>
						<label>REGALO</label><!-- revisar esto del marcado -->
						<?php }?>
					</form>
				</div><div style="clear: both"></div></td>
				<td class="talla"><!-- celda con la talla --><h1><?php echo $this->requestAction("/size_references/getSize/" .$order_item["size_id"])
				?></h1></td>
				<td class="talla"><!-- celda con el precio --><h1>$ <?php echo number_format($item["$model_name"]["price"], 0, ' ', '.');?></h1></td>
				<td class="talla"><!-- celda con el select para modificar la cantidad --><h1 class="price"><?php echo $order_item['quantity'];?></h1></td>
				<td class="talla"><h1 class="price">$<?php echo number_format($order_item['quantity'] * $item["$model_name"]["price"], 0, ' ', '.');?></h1><!-- celda con el total --></td>
			</tr>
			<?php
			endforeach;
			?>
		</tbody>
	</table>
	<div class='volver'>
		<a href='/users/profile' class="azul"> Volver </a>
	</div>
</div>