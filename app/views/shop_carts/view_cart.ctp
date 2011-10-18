<?php echo $this -> element("menu-shop-cart");?>
<div class="shop-cart-list-container">
<table id="shop-cart-list" class="tahoma">
	<thead>
		<tr>
			<th align="left">Descripcion de la Prenda</th>
			<th align="left">Talla</th>
			<th align="left">Valor Unidad</th>
			<th align="left">Cantidad</th>
			<th align="left">Total</th>
			<th align="left">Eliminar</th>
		</tr>
	</thead>
	<tbody>
		<?php
			if(empty($shopping_cart['ShopCartItem'])) {
				// No hay items en el carrito
				e("<tr><td colspan='6'><h2>NO HAY ITEMS EN EL CARRITO</h2></td></tr>");
			} else {
				$subtotal=0;
				foreach($shopping_cart['ShopCartItem'] as $shoppin_cart_item) :
				$model_name = $shoppin_cart_item['model_name'];
				$foreign_key =  $shoppin_cart_item['foreign_key'];
				$item = $this->requestAction("/$model_name"."s/getProduct/$foreign_key/".$shoppin_cart_item['size_id']);
				$subtotal+=$item[$model_name]["price"]*$shoppin_cart_item['quantity'];
		?>
			<tr class="shop-cart-item" rel="<?=$shoppin_cart_item["id"]?>">
				<td class="descripcion">
				<div class="img_carrito">
					<img src="<?php echo"/img/uploads/100x100/".$item["$model_name"]["image"]?>"/>
				</div>
				<div class='info-item'>
				<h1 class="titulos_rosado"><?php echo $item["$model_name"]["name"]?></h1>
				<h2 class="titulos_gris"><?php echo $item["$model_name"]["clasification"]?></h2>
				<form class="marcar_regalo">
					<?php if($shoppin_cart_item['is_gift']){?>
					<input class='gift-control' type="checkbox" checked="checked"/>
					<?php }else{?>
					<input class='gift-control' type="checkbox" />
					<?php } ?>
					<label>MARCAR COMO REGALO</label> <!-- revisar esto del marcado -->
				</form>
				</div>
				<div style="clear: both"></div></td>
				<td class="talla"><!-- celda con la talla -->
					<h1><?php echo $this->requestAction("/size_references/getSize/" .$shoppin_cart_item["size_id"])?></h1>					
				</td>
				<td class="talla"><!-- celda con el precio -->
					<h1>$ <?php echo number_format($item["$model_name"]["price"], 0, ' ', '.'); ?></h1>
				</td>
				<td class="talla"><!-- celda con el select para modificar la cantidad -->
					<?php 
						$cantidades=array();
						for($i=1; $i <= $item['Inventory']['quantity']; $i++ ){
							$cantidades[$i]=$i;
						}
					?>
					<?php echo $form->input('cantidad',array('class'=>'item-quantity','options'=>$cantidades,"selected"=>$shoppin_cart_item['quantity'],'label'=>false,'div'=>false));?>
					</td>
				<td class="talla">
					<h1 class="price">$<?php echo number_format($shoppin_cart_item['quantity']* $item["$model_name"]["price"], 0, ' ', '.');?></h1><!-- celda con el total -->
				</td>
				<td>
					<h1 class="quitar"><a href="#">QUITAR</a></h1>
				</td>
			</tr>
		<?php
				endforeach;
			}
		?>
	</tbody>
</table>

<div id="cupon" class="twCenMt">
	<h1 class='quitar-todos'><a class="titulos_gris" href="#">QUITAR TODOS</a></h1>
	<h1 class="titulos_rosado">SUBTOTAL <span class="subtotal">$<?php if(isset($subtotal)) {echo number_format($subtotal, 0, ' ', '.');} else {echo number_format(0, 0, ' ', '.');} ?></span></h1>
	<form id="set-coupon">
		<?php if(!$shopping_cart['ShopCart']['coupon_id']) : ?>
		<label class="titulos_rosado">CUPÓN DE DESCUENTO</label>
		<input id="get-serial" style="text-align: center; color: white;" type="text" />
		<input type="submit" value="APLICAR" />
		<?php endif; ?>
		<?php if($shopping_cart['ShopCart']['coupon_id']) : ?>
			<h1 class="titulos_rosado">DESCUENTO APLICADO <span class="subtotal"><?=(100 * $shopping_cart['ShopCart']['coupon_discount'])."%"?></span></h1>
		<?php endif; ?>
	</form>
	<?php $coupon_value = 0; if(isset($shopping_cart['ShopCart']['coupon_discount'])) $coupon_value = $shopping_cart['ShopCart']['coupon_discount']; ?>
	<h1 class="titulos_rosado">TOTAL <span class="total">$<?php if(isset($subtotal)) {echo number_format(($subtotal * (1 - $coupon_value)), 0, ' ', '.');} else {echo number_format(0, 0, ' ', '.');} ?></span></h1>
	<div id="btn_cupon">
		<div class="agregar_regalo verde twCenMt">
			<h1><a href="/orders/getAddressInfo">Continuar</a></h1>
		</div>
		<div class="agregar_regalo twCenMt">
			<h1><a class="seguir-comprando" href="#">Seguir Comprando</a></h1>
		</div>
		<div style="clear: both"></div>
	</div>
	<div style="clear: both"></div>
</div>
</div>
