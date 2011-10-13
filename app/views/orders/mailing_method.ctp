<?php echo $this->element("menu-shop-cart");?> 
<div class="datos_envio form_envio">
	<h1 class="tahoma">¿Donde vas a recibir el envio? </h1>
</div>
<div id="der" class="datos_envio form_envio">
	<h1 class="der tahoma">Servicio de Mensajeria</h1>
</div>
<div class="form_envio tahoma">
	<div class="form">
	<form>
		<label>Datos Usuario</label>
		<span><?php if($user) echo $user['UserField']['name'] . " " . $user['UserField']['surname']; ?></span>
		<label>Pais</label>
		<span><?=$shop_cart['ShopCart']['pais']?></span>
		<label>Nombre</label>
		<span><?=$shop_cart['ShopCart']['nombre']?></span>
		<label>Apellido</label>
		<span><?=$shop_cart['ShopCart']['apellido']?></span>
		<label>Dirección</label>
		<span><?=$shop_cart['ShopCart']['direccion']?></span>
		<label>Numero Telefónico</label>
		<span><?=$shop_cart['ShopCart']['telefono']?></span>
		<label>Celular</label>
		<span><?=$shop_cart['ShopCart']['celular']?></span>
		<label>Departamento</label>
		<span><?=$shop_cart['ShopCart']['estado']?></span>
		<label>Ciudad</label>
		<span><?=$shop_cart['ShopCart']['ciudad']?></span>
		<div style="clear: both"></div>
	</form>
	</div>
	<div style="clear: both"></div>
</div>
<div class="form_envio der">
	<div class="form">
	<form class="tahoma">
		<label>Entidad</label>
		<span>Servientrega</span>
		<label>Tipo de envio</label>
		<span>Contraentrega/gratis</span>
	</form>
	<div style="clear: both"></div>
	<?php
		$found_gift = false;
		$gift = null;
		foreach($shop_cart['ShopCartItem'] as $item) {
			if($item['is_gift']) {
				$found_gift = true;
				$gift = $item;
				break;
			}
		}
		if(true) :
	?>
		<div class="envio_regalo">
			<h1 class="tahoma">¿Dónde vamos a enviar tu regalo? </h1>
		
			<form class="tahoma">
				<label>Pais</label>
				<span><?=$gift['pais']?></span>
				<label>Nombre</label>
				<span><?=$gift['nombre']?></span>
				<label>Apellido</label>
				<span><?=$gift['apellido']?></span>
				<label>Dirección</label>
				<span><?=$gift['direccion']?></span>
				<label>Numero Telefónico</label>
				<span><?=$gift['telefono']?></span>
				<label>Departamento</label>
				<span><?=$gift['estado']?></span>
				<label>Ciudad</label>
				<span><?=$gift['ciudad']?></span>
				<div style="clear: both"></div>
			</form>
		</div>
		<?php endif; ?>
	</div>
	<div style="clear: both"></div>
</div>
<div style="clear: both"></div>
<div class="hidden-form">
	<!-- formulario pagos online -->
	<form id="PagosOnlineForm" method="post" action="https://gateway2.pagosonline.net/apps/gateway/index.html">
		<input name="usuarioId" type="hidden" value="76075" />
		<input name="refVenta" type="hidden" value="<?=$refVenta?>" />
		<input name="descripcion" type="hidden" value="<?=$descripcion?>" />
		<input name="valor" type="hidden" value="<?=$valor?>" />
		<input name="iva" type="hidden" value="0" />
		<input name="baseDevolucionIva" type="hidden" value="0" />
		<input name="firma" type="hidden" value="<?=$firma?>" />
		<input name="emailComprador" type="hidden" value="<?=$email?>" />
		<input name="moneda" type="hidden" value="<?=$moneda?>" />
		<input name="nombreComprador" type="hidden" value="<?=$nombre?>" />
		<input name="extra1" type="hidden" value="<?=$extra1?>" />
	<!--	<input name="extra2" type="text" value="<?=$extra2?>" /> -->
		<input name="prueba" type="hidden" value="1" />
		<input name="url_confirmacion" type="hidden" value="http://colors.bloomweb.co/orders/confirmarPagosOnline" />
		<input name="url_respuesta" type="hidden" value="http://colors.bloomweb.co/orders/callBackPagosOnline" />
	<!--	<input name="Submit" type="submit" value="Enviar" /> -->
	</form>
</div>
<div id="cupon" class="twCenMt">
	<h1 class="titulos_rosado">TOTAL <span>$<?=number_format($shop_cart['ShopCart']['total'], 0, ' ', '.')?></span></h1>
	<div id="btn_cupon">
		<div class="agregar_regalo verde twCenMt">
			<h1><a class="mailing-form" href="#">Continuar</a></h1>
		</div>
		<div class="agregar_regalo twCenMt">
			<h1><a href="#">Seguir Comprando</a></h1>
		</div>
		<div style="clear: both"></div>
	</div>
	<div style="clear: both"></div>	
</div>
