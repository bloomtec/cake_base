<h1>Mi Carrito</h1>
<table id="shop-cart-list" class="tahoma">
	<thead>
		<tr>
			<th class="articulo">Articulo</th>
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
					$model = $shoppin_cart_item['model_name'];
					$item = $this->requestAction("/$model" . "s/getProduct/$foreign_key/");
					$subtotal += $item[$model_name]["price"]*$shoppin_cart_item['quantity'];
			?>
			<?php
				$class = null;
				if(!empty($shoppin_cart_item['message'])) {
					if($shoppin_cart_item['message'] === 'La cantidad de este item es inferior a la ingresada originalmente') {
						$class = 'shop-cart-item check-item';
					} else {
						$class = 'shop-cart-item remove-item';
					}
				} else { 
					$class = 'shop-cart-item';
				}
			?>
			<tr class="<?=$class;?>" rel="<?php echo $shoppin_cart_item["id"]?>">
				<td class="description">
					<div class="img-item">
						<img src="<?php echo "/img/uploads/100x100/".$item["$model_name"]["image"]?>"/>
					</div>
					<div class='info-item'>
						<h1><?php echo $item["$model_name"]["name"]?></h1>
						<p>
							Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
						</p>
						<h2>Ref:<?php echo $item["$model_name"]["ref"]?></h2>
					</div>
				</td>

				<td class="price"> <!-- celda con el precio -->
					<h1>$ <?php echo number_format($item["$model_name"]["price"], 0, ' ', '.'); ?></h1>
				</td>
				<td class="quantity">
					<?php 
						$cantidades=array();
						for($i=1; $i <= $item['Inventory']['quantity']; $i++ ){
							$cantidades[$i]=$i;
						}
						echo $form->input('cantidad',array('class'=>'item-quantity','options'=>$cantidades,"selected"=>$shoppin_cart_item['quantity'],'label'=>false,'div'=>false));
						if($class === 'shop-cart-item check-item') {
							echo '<br />';
							echo '<div class="item-message">La disponibilidad de este ítem ha variado.<br />Por favor revisar.</div>';
						} elseif($class === 'shop-cart-item remove-item') {
							echo '<br />';
							echo '<div class="item-message">Este ítem ya no esta disponible.<br /><h1 class="remove-from-cart"><a href="#">QUITAR</a></h1></div>';
						}
					 ?>
				</td>
				<td class="price">
					<h1 >$<?php echo number_format($shoppin_cart_item['quantity']* $item["$model_name"]["price"], 0, ' ', '.');?></h1>
				</td>
				<td>
					<h1 class="remove-from-cart"><a href="#">QUITAR</a></h1>
				</td>
			</tr>
			<?php
				endforeach;
			}
		?>
	</tbody>
</table>

<div id="cupon">
	<h1 class='remove-all'><a href="#">QUITAR TODOS</a></h1>
	<h1 class="total">SUBTOTAL <span class="subtotal">$<?php if(isset($subtotal)) {echo number_format($subtotal, 0, ' ', '.');} else {echo number_format(0, 0, ' ', '.');} ?></span></h1>
	
	<!--<form id="set-coupon">-->
		<?php //if(!$shopping_cart['ShopCart']['coupon_id']) : ?>
		<!--<label class="titulos_rosado">CUPÓN DE DESCUENTO</label>-->
		<!--<input id="get-serial" style="text-align: center; color: white;" type="text" />-->
		<!--<input type="submit" value="APLICAR" />-->
		<?php //endif; ?>
		<?php //if($shopping_cart['ShopCart']['coupon_id']) : ?>
			<!--<h1 class="titulos_rosado">DESCUENTO APLICADO <span class="subtotal">--><?php //echo (100 * $shopping_cart['ShopCart']['coupon_discount'])."%"?><!--</span></h1>-->
		<?php //endif; ?>
	<!--</form>-->
	<?php $coupon_value = 0; if(isset($shopping_cart['ShopCart']['coupon_discount'])) $coupon_value = $shopping_cart['ShopCart']['coupon_discount']; ?>
	<h1 class="total">TOTAL <span class="total">$<?php if(isset($subtotal)) {echo number_format(($subtotal * (1 - $coupon_value)), 0, ' ', '.');} else {echo number_format(0, 0, ' ', '.');} ?></span></h1>
	<div id="btn_cupon">
		<div class="continuar">
			<h1>
				<a href="/bcart/orders/getAddressInfo">Continuar</a>
			</h1>
		</div>
		<div class="seguir">
			<h1>
				<a href="<?php echo $session->read('referer');?>">Seguir Comprando</a>
			</h1>
		</div>
		<div style="clear: both"></div>
	</div>
	<div style="clear: both"></div>
</div>