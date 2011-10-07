<?php
	echo $this->element("menu-shop-cart");
	$pais = "";
	$nombre = "";
	$appelido = "";
	$direccion = "";
	$telefono = "";
	$celular = "";
	$departamento = "";
	$ciudad = "";
	if($user) {
		$pais = $user['UserField'][''];
		$nombre = $user['UserField'][''];
		$appelido = $user['UserField'][''];
		$direccion = $user['UserField'][''];
		$telefono = $user['UserField'][''];
		$celular = $user['UserField'][''];
		$departamento = $user['UserField'][''];
		$ciudad = $user['UserField'][''];
	}
?>
<p class="costo_envio tahoma">
Recuerda que puedes recibir tu pedido en cualquier parte de Colombia, el tiempo aproximado de entrega es de 3 a 5 días después de haber realizado el 
pago.  También puedes enviar un regalo a cualquier parte de Colombia, pero si tienes varios productos como regalo, todos serán enviados a una única 
dirección. El costo del envió en contra entrega, envíos a la ciudad de Cali no tienen costo o si tu pedido tiene un valor de pago igual o superior a 
$120.000 tampoco tienen costo. 
</p>
<div class="datos_envio form_envio">
	<h1>Datos de envio</h1>
</div>
<div id="der" class="datos_envio form_envio">
	<h1 class="der">Datos de envio para el regalo</h1>
</div>
<div class="form_envio tahoma">
	<?php e($this->Form->create('Order')); ?>
		<?php e($this->Form->input('user_name', array('label'=>'Datos De Usuario'))); ?>
		<?php e($this->Form->input('country', array('label'=>'País'))); ?>
		<label>Nombre</label>
		<input type="text" />
		<label>Apellido</label>
		<input type="text" />
		<label>Dirección</label>
		<input type="text" />
		<label>Numero Telefónico</label>
		<input type="text" />
		<label>Celular</label>
		<input type="text" />
		<?php e($this->Form->input('state', array('label'=>'Departamento'))); ?>
		<?php e($this->Form->input('city', array('label'=>'Ciudad'))); ?>
		<div style="clear: both"></div>
		<input type="checkbox" />
		<label class="azul"> Autorizo a Colors Tennis  que me envíe información por correo electrónico</label>
		<div style="clear: both"></div>
		<input type="checkbox" />
		<label class="azul">  Acepto terminos y condiciones de la compra.</label>
		<div style="clear: both"></div>
	
	<div style="clear: both"></div>
</div>
<div class="form_envio der">
	<form>
		<label>Pais</label>
		<select></select>	
		<label>Nombre destinatario</label>
		<input type="text" />
		<label>Apellido destinatarioo</label>
		<input type="text" />
		<label>Dirección destinatario</label>
		<input type="text" />
		<label>Numero Telefónico</label>
		<input type="text" />
		<label>Departamento</label>
		<select></select>
		<label>Ciudad</label>
		<select></select>


	</form>
	<div style="clear: both"></div>
</div>
<div style="clear: both"></div>
<div id="cupon" class="twCenMt">	
	<h1 class="titulos_rosado">TOTAL <span>$457.000</span></h1>
		<div id="btn_cupon">
			<div class="agregar_regalo verde twCenMt">
				<h1><a class="envio-form" href="#">Continuar</a></h1>
			</div>
			<div class="agregar_regalo twCenMt">
				<h1><a href="#">Seguir Comprando</a></h1>
			</div>
			<div style="clear: both"></div>
		</div>
		<div style="clear: both"></div>	
</div>
