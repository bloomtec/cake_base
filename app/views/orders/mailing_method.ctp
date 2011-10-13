<?php echo $this->element("menu-shop-cart");?> 
<div class="datos_envio form_envio">
	<h1 class="tahoma">¿Donde vas a recibir el envio? </h1>
</div>
<div id="der" class="datos_envio form_envio">
	<h1 class="der tahoma">Servicio de Mensajeria</h1>
</div>
<div class="form_envio tahoma">
	<form>
		<label>Datos Usuario</label>
		<span>Jorge Enrique Ceballos Delgado</span>
		<label>Pais</label>
		<span>Colombia</span>
		<label>Nombre</label>
		<span>Jorge Enrique</span>
		<label>Apellido</label>
		<span>Ceballos Delgado</span>
		<label>Dirección</label>
		<span>Carrera 60A # 2A-174</span>
		<label>Numero Telefónico</label>
		<span>5519552</span>
		<label>Celular</label>
		<span>3137430119</span>
		<label>Departamento</label>
		<span>Valle del Cauca</span>
		<label>Ciudad</label>
		<span>Cali</span>
		<div style="clear: both"></div>
	</form>
	
	<div style="clear: both"></div>
</div>
<div class="form_envio der">
	<form class="tahoma">
		<label>Entidad</label>
		<span>Servientrega</span>
		<label>Tipo de envio</label>
		<span>Contraentrega/gratis</span>
	</form>
	<div style="clear: both"></div>
		<div class="envio_regalo">
			<h1 class="tahoma">¿Dónde vamos a enviar tu regalo? </h1>
		
			<form class="tahoma">
				<label>Datos Usuario</label>
				<span>Jorge Enrique Ceballos Delgado</span>
				<label>Pais</label>
				<span>Colombia</span>
				<label>Nombre</label>
				<span>Jorge Enrique</span>
				<label>Apellido</label>
				<span>Ceballos Delgado</span>
				<label>Dirección</label>
				<span>Carrera 60A # 2A-174</span>
				<label>Numero Telefónico</label>
				<span>5519552</span>
				<label>Celular</label>
				<span>3137430119</span>
				<label>Departamento</label>
				<span>Valle del Cauca</span>
				<label>Ciudad</label>
				<span>Cali</span>
				<div style="clear: both"></div>
			</form>
		</div>
	<div style="clear: both"></div>
</div>
<div style="clear: both"></div>
<div class="hidden-form">
	<!-- formulario pagos online -->
	<form id="PagosOnlineForm" method="post" action="https://gateway2.pagosonline.net/apps/gateway/index.html">
		<input name="usuarioId" type="text" value="76075" />
		<input name="refVenta" type="text" value="<?=$refVenta?>" />
		<input name="descripcion" type="text" value="<?=$descripcion?>" />
		<input name="valor" type="text" value="<?=$valor?>" />
		<input name="iva" type="text" value="0" />
		<input name="baseDevolucionIva" type="text" value="0" />
		<input name="firma" type="text" value="<?=$firma?>" />
		<input name="emailComprador" type="text" value="<?=$email?>" />
		<input name="moneda" type="text" value="<?=$moneda?>" />
		<input name="nombreComprador" type="text" value="<?=$nombre?>" />
		<input name="extra1" type="text" value="<?=$extra1?>" />
		<input name="extra2" type="text" value="<?=$extra2?>" />
		<input name="prueba" type="text" value="1" />
		<input name="url_confirmacion" type="text" value="http://colors.bloomweb.co/orders/confirmarPagosOnline" />
		<input name="url_respuesta" type="text" value="http://colors.bloomweb.co/orders/callBackPagosOnline" />
	<!--	<input name="Submit" type="submit" value="Enviar" /> -->
	</form>
</div>
<div id="cupon" class="twCenMt">	
	<h1 class="titulos_rosado">TOTAL <span>$457.000</span></h1>
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
