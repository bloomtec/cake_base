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
		$pais = $user['UserField']['country'];
		$nombre = $user['UserField']['name'];
		$appelido = $user['UserField']['surname'];
		$direccion = $user['UserField']['address'];
		$telefono = $user['UserField']['phone'];
		$celular = $user['UserField']['mobile'];
		$departamento = $user['UserField']['state'];
		$ciudad = $user['UserField']['city'];
	}
?>
<p class="costo_envio tahoma">
Recuerda que puedes recibir tu pedido en cualquier parte de Colombia, el tiempo aproximado de entrega es de 3 a 5 días después de haber realizado el 
pago.  También puedes enviar un regalo a cualquier parte de Colombia, pero si tienes varios productos como regalo, todos serán enviados a una única 
dirección. El costo del envió en contra entrega, envíos a la ciudad de Cali no tienen costo o si tu pedido tiene un valor de pago igual o superior a 
$120.000 tampoco tienen costo. 
</p>
<div class="datos_envio form_envio">
	<h1 class="tahoma">Datos de envio</h1>
</div>
<div id="der" class="datos_envio form_envio">
	<h1 class="der tahoma">Datos de envio para el regalo</h1>
</div>
<div class="form_envio tahoma">
	<?php e($this->Form->create('Order')); ?>
		<?php e($this->Form->input('Envio.full_name', array('label'=>'Datos Usuario', 'value'=>$nombre . " " . $appelido))); ?>
		<?php e($this->Form->input('Envio.country', array('label'=>'País', 'value'=>$pais))); ?>
		<?php e($this->Form->input('Envio.name', array('label'=>'Nombre', 'value'=>$nombre))); ?>
		<?php e($this->Form->input('Envio.surname', array('label'=>'Apellido', 'value'=>$appelido))); ?>
		<?php e($this->Form->input('Envio.address', array('label'=>'Nombre', 'value'=>$direccion))); ?>
		<?php e($this->Form->input('Envio.phone', array('label'=>'Número Telefónico', 'value'=>$telefono))); ?>
		<?php e($this->Form->input('Envio.mobile', array('label'=>'Celular', 'value'=>$celular))); ?>
		<?php e($this->Form->input('Envio.state', array('label'=>'Departamento'))); ?>
		<?php e($this->Form->input('Envio.city', array('label'=>'Ciudad'))); ?>
		<div style="clear: both"></div>
		<input id="EnvioAuthorize" name="data[Envio][authorize]" type="checkbox" />
		<label for="EnvioAuthorize" class="azul"> Autorizo a Colors Tennis  que me envíe información por correo electrónico</label>
		<div style="clear: both"></div>
		<input id="EnvioConditions" name="data[Envio][conditions]" type="checkbox" />
		<label for="EnvioConditions" class="azul">  Acepto terminos y condiciones de la compra.</label>
		<div style="clear: both"></div>
	</form>
	<div style="clear: both"></div>
</div>
<div class="form_envio der tahoma">
	<form>
		<?php e($this->Form->input('Gift.country', array('label'=>'País'))); ?>
		<?php e($this->Form->input('Gift.name', array('label'=>'Nombre', 'value'=>$nombre))); ?>
		<?php e($this->Form->input('Gift.surname', array('label'=>'Apellido', 'value'=>$appelido))); ?>
		<?php e($this->Form->input('Gift.address', array('label'=>'Nombre', 'value'=>$direccion))); ?>
		<?php e($this->Form->input('Gift.phone', array('label'=>'Número Telefónico', 'value'=>$telefono))); ?>
		<?php e($this->Form->input('Gift.state', array('label'=>'Departamento'))); ?>
		<?php e($this->Form->input('Gift.city', array('label'=>'Ciudad'))); ?>
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
