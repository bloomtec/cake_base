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
	<?php
		$found_gift = false;
		$gift = null;
		$total_regalo = 0;
		foreach($order['OrderItem'] as $item) {
			if($item['is_gift']) {
				$found_gift = true;
				$gift = $item;
				$model_name = $item['model_name'];
				$foreign_key = $item['foreign_key'];
				$product = $this -> requestAction("/$model_name" . "s/getProduct/$foreign_key");
				$total_regalo += $product[$model_name]["price"] * $item['quantity'];
			}
		}
		$total = $order['Order']['total'];
		$total_para_envio = $total - $total_regalo;
		$message = "";
		if($found_gift) {
			// Hay regalo
			if($total_para_envio > 0) {
				// Hay regalo y envio
				// Revision detalle envío
				if($total_para_envio >= 120000) {
					$message = "Envío Gratis :: ";
				} else {
					$message = "Envío Contraentrega :: ";
				}
				// Revisar si es Cali la ciudad destino
				if(strcasecmp(trim($order['Order']['pais']), "Colombia") == 0) {
					// Destino Colombia
					$words = explode(" ", $order['Order']['ciudad']);
					foreach($words as $word) {
						if(strcasecmp(trim($word), "Cali") == 0) {
							$message = "Envío Gratis :: ";
						}
					}
				}
				// Revision detalle regalo
				if($total_regalo >= 120000) {
					$message = $message . "Envío Regalo Gratis";
				} else {
					$cali_found = false;
					// Revisar si es Cali la ciudad destino
					if(strcasecmp(trim($gift['pais']), "Colombia") == 0) {
						// Destino Colombia
						$words = explode(" ", $gift['ciudad']);
						foreach($words as $word) {
							if(strcasecmp(trim($word), "Cali") == 0) {
								$cali_found = true;
							}
						}
					}
					if($cali_found) {
						$message = $message . "Envío Regalo Gratis";
					} else {
						$message = $message . "Envío Regalo Contraentrega";
					}
				}
			} else {
				// Solo hay regalo
				// Revisar si es Cali la ciudad destino
				$cali_found = false;
				if(strcasecmp(trim($order['Order']['pais']), "Colombia") == 0) {
					// Destino Colombia
					$words = explode(" ", $order['Order']['ciudad']);
					foreach($words as $word) {
						if(strcasecmp(trim($word), "Cali") == 0) {
							$cali_found = true;
						}
					}
				}
				if($cali_found || ($total_regalo >= 120000)) {
					$message = "Envío Regalo Gratis";
				}
			}
		} else {
			// No hay regalo
			if($total >= 120000) {
				$message = "Envío Gratis";
			} else {
				$message = "Envío Contraentrega";
			}
			// Revisar si es Cali la ciudad destino
			if(strcasecmp(trim($order['Order']['pais']), "Colombia") == 0) {
				// Destino Colombia
				$words = explode(" ", $order['Order']['ciudad']);
				foreach($words as $word) {
					if(strcasecmp(trim($word), "Cali") == 0) {
						$message = "Envío Gratis";
					}
				}
			}
		}
	?>
	<form class="tahoma">
		<label>Entidad</label>
		<span>Servientrega</span>
		<label>Tipo de envio</label>
		<span><?=$message?></span>
	</form>
	<div style="clear: both"></div>
	<?php
		if($found_gift) :
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
	</form>
</div>
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
