<?php echo $this->element("shop-cart-view");?>
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
		<tr>
			<td class="descripcion">
				<div class="img_carrito"><img src="#"/></div>
				<h1 class="titulos_rosado">NOMBRE PRENDA</h1>
				<h2 class="titulos_gris">CLASIFICACION</h2>
				<form class="marcar_regalo">
					<input type="checkbox" /> <label>MARCAR COMO REGALO</label>
				</form>
				<div style="clear: both"></div>
			</td>
			<td class="talla">
				<h1>Small</h1>
			</td>
			<td class="talla">
				<h1>$40.000</h1>
			</td>
			<td class="talla">
				<select>
					<option>1</option>
					<option>2</option>
				</select>
			</td>
			<td class="talla">
				<h1>$80.000</h1>
			</td>
			<td class="talla quitar">
				<h1><a href="#">QUITAR</a></h1>
			</td>
		</tr>
<tr>
			<td class="descripcion">
				<div class="img_carrito"><img src="#"/></div>
				<h1 class="titulos_rosado">NOMBRE PRENDA</h1>
				<h2 class="titulos_gris">CLASIFICACION</h2>
				<form class="marcar_regalo">
					<input type="checkbox" /> <label>MARCAR COMO REGALO</label>
				</form>
				<div style="clear: both"></div>
			</td>
			<td class="talla">
				<h1>Small</h1>
			</td>
			<td class="talla">
				<h1>$40.000</h1>
			</td>
			<td class="talla">
				<select>
					<option>1</option>
					<option>2</option>
				</select>
			</td>
			<td class="talla">
				<h1>$80.000</h1>
			</td>
			<td class="talla quitar">
				<h1><a href="#">QUITAR</a></h1>
			</td>
		</tr>
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
