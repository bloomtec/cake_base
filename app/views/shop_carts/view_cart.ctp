<?php echo $this -> element("menu-shop-cart");?>
<table class="tahoma">
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
			} else {
				foreach($shopping_cart['ShopCartItem'] as $shoppin_cart_item) :
				$model_name = $shoppin_cart_item['ShopCartItem']['model_name'];
				$foreign_key =  $shoppin_cart_item['ShopCartItem']['foreign_key'];
				$item = $this->requestAction("/$model_name"."s/getProduct/$foreign_key");
		?>
			<tr class="shop-cart-item" rel="Product:<?=$item["$model_name"]["id"]?>">
				<td class="descripcion">
				<div class="img_carrito">
					<img src="<?="/img/uploads/100x100/".$item["$model_name"]["image"]?>"/>
				</div>
				<h1 class="titulos_rosado"><?=$item["$model_name"]["name"]?></h1>
				<h2 class="titulos_gris"><?=$item["$model_name"]["clasification"]?></h2>
				<form class="marcar_regalo">
					<input type="checkbox" />
					<label>MARCAR COMO REGALO</label> <!-- revisar esto del marcado -->
				</form>
				<div style="clear: both"></div></td>
				<td class="talla">
					<h1><?=$this->requestAction("/size_references/getSize/" . $this->$item["$model_name"]["size_id"])?></h1>					
				</td>
				<td class="talla">
					<h1>$40.000</h1>
				</td>
				<td class="talla">
					<select>
						<option>1</option>
						<option>2</option>
					</select></td>
				<td class="talla">
					<h1>$80.000</h1>
				</td>
				<td class="talla quitar">
						<h1><a href="#">QUITAR</a></h1>
				</td>
			</tr>
		<?php
				endforeach;
			}
		?>
	</tbody>
</table>
<div id="cupon" class="twCenMt">
	<h1><a class="titulos_gris" href="#">QUITAR TODOS</a></h1>
	<h1 class="titulos_rosado">SUBTOTAL <span>$457.000</span></h1>
	<form >
		<label class="titulos_rosado">CUPÓN DE DESCUENTO</label>
		<input type="text" />
		<input type="submit" value="APLICAR" />
	</form>
	<h1 class="titulos_rosado">TOTAL <span>$457.000</span></h1>
	<div id="btn_cupon">
		<div class="agregar_regalo verde twCenMt">
			<h1><a href="#">Continuar</a></h1>
		</div>
		<div class="agregar_regalo twCenMt">
			<h1><a href="#">Seguir Comprando</a></h1>
		</div>
		<div style="clear: both"></div>
	</div>
	<div style="clear: both"></div>
</div>
