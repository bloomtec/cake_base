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
		<span><?php if($user) echo $user['User']['name'] . " " . $user['User']['last_name']; ?></span>
		<label>Pais</label>
		<span><?=$order['Order']['pais']?></span>
		<label>Nombre</label>
		<span><?=$order['Order']['nombre']?></span>
		<label>Apellido</label>
		<span><?=$order['Order']['apellido']?></span>
		<label>Dirección</label>
		<span><?=$order['Order']['direccion']?></span>
		<label>Numero Telefónico</label>
		<span><?=$order['Order']['telefono']?></span>
		<label>Celular</label>
		<span><?=$order['Order']['celular']?></span>
		<label>Departamento</label>
		<span><?=$order['Order']['estado']?></span>
		<label>Ciudad</label>
		<span><?=$order['Order']['ciudad']?></span>
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
		<span><?=$message?></span>
	</form>
	<div style="clear: both"></div>
	</div>
	<div style="clear: both"></div>
</div>
<div style="clear: both"></div>
<!-- OJO! INICIO SECCION PAGOS ONLINE -->
<div class="hidden-form">
	<!-- formulario pagos online -->
	<form id="PagosOnlineForm" method="post" action="https://gateway.pagosonline.net/apps/gateway/index.html">
<!--	<form id="PagosOnlineForm" method="post" action="https://gateway2.pagosonline.net/apps/gateway/index.html"> -->
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
		<input name="extra2" type="hidden" value="<?php if($user) echo $user['User']['id']; ?>" />
		<input name="prueba" type="hidden" value="0" />
	<!--	<input name="prueba" type="hidden" value="1" /> -->
		<input name="url_confirmacion" type="hidden" value="http://www.colorstennis.com/orders/confirmarPagosOnline" />
		<input name="url_respuesta" type="hidden" value="http://www.colorstennis.com/orders/callBackPagosOnline" />
	<!--	<input name="url_confirmacion" type="hidden" value="http://colors.bloomweb.co/orders/confirmarPagosOnline" />
		<input name="url_respuesta" type="hidden" value="http://colors.bloomweb.co/orders/callBackPagosOnline" /> -->
	</form>
</div>
<!-- OJO! FIN SECCION PAGOS ONLINE -->
<div id="cupon" class="twCenMt">
	<h1 class="titulos_rosado">TOTAL <span>$<?=number_format($order['Order']['total'], 0, ' ', '.')?></span></h1>
	<div id="btn_cupon">
		<div class="agregar_regalo verde twCenMt">
			<h1><a class="mailing-form" href="#">Continuar</a></h1>
		</div>
		<div class="agregar_regalo twCenMt">
			<h1><a class="seguir-comprando" href="<?php echo $session->read('referer');?>">Seguir Comprando</a></h1>
		</div>
		<div style="clear: both"></div>
	</div>
	<div style="clear: both"></div>	
</div>
