<?php if($order){?>
<h1 class="subtitulos_gris tahoma">NOMBRE CLIENTE:</h1><h2 class="subtitulos_blanco"><?php echo $order['Order']['nombre']." ".$order['Order']['apellido'];?></h2>
<h1 class="subtitulos_gris tahoma">DIRECCION DE ENVIO:</h1><h2 class="subtitulos_blanco"><?php echo $order['Order']['direccion']?></h2>
<h1 class="subtitulos_gris tahoma">CIUDAD:</h1><h2 class="subtitulos_blanco"><?php echo $order['Order']['ciudad']?></h2>
<!--<h1 class="subtitulos_gris tahoma">NOMBRE PRENDA:</h1><h2 class="subtitulos_blanco">NOMBRE </h2>
<h1 class="subtitulos_gris tahoma">TALLA:</h1><h2 class="subtitulos_blanco">35</h2> -->
<h1 class="subtitulos_gris tahoma">ESTADO:</h1><h2 class="subtitulos_blanco"><?php echo $order['OrderState']['name']?></h2>
<!--
<h1 class="subtitulos_gris tahoma">TRANSPORTADORA:</h1><h2 class="subtitulos_blanco"><?php echo $order['Order']['transportadora']?></h2>
<h1 class="subtitulos_gris tahoma">NUMERO DE GUIA:</h1><h2 class="subtitulos_blanco"><?php echo $order['Order']['guia']?></h2>
<h1 class="subtitulos_gris tahoma">SITIO WEB:</h1><h2 class="subtitulos_blanco"><?php echo $order['Order']['web_transportadora']?></h2>
-->
<?php }else{?>
	<h1>NO SE REGISTRA NINGUN PEDIDO CON ESE CODIGO</h1>
<?php }?>
