<!-- <div class="datos_perfil primero">
<img src="/img/foto_perfil.png" />
<a href="#">Cambiar imagen</a>
</div>
-->
<div class="datos_perfil">
	<div class="basic-info">
		<h1>Datos Personales</h1>
		<h2>Nombre y apellido:</h2>
		<span><?php echo  $user['User']['name'].' '. $user['User']['last_name']
			?>&nbsp;</span>
		<h2>Email:</h2>
		<span><?php echo $user['User']['email'];?>&nbsp;</span>
	</div>
	<!--<h2>Teléfono:</h2>
	<span><?php echo  $user['User']['phone'] ?> &nbsp; </span>
	<h2>Ciudad:</h2>
	<span><?php echo $user['City']['name'] ?> &nbsp;</span>-->
	<!--<h2>Acerca de mi:</h2>
	<p>
	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
	</p>-->
	<div class="registered-addresses">
		<?php
			if(empty($addresses)) {
				echo '<br />';
			} else {
				echo '<h2>Direcciones Registradas</h2>';
				foreach($addresses as $address):
		?>
		<table class="address-info">
			<tr>
				<td><label>País</label></td>
				<td><?=$address['country'];?></td>
			</tr>
			<tr>
				<td><label>Departamento</label></td>
				<td><?=$address['state'];?></td>
			</tr>
			<tr>
				<td><label>Ciudad</label></td>
				<td><?=$address['city'];?></td>
			</tr>
			<tr>
				<td><label>Dirección Linea 1</label></td>
				<td><?=$address['address_line_1'];?></td>
			</tr>
			<tr>
				<td><label>Dirección Linea 2</label></td>
				<td><?=$address['address_line_2'];?></td>
			</tr>
			<tr>
				<td><label>Teléfono</label></td>
				<td><?=$address['phone'];?></td>
			</tr>
		</table>
			<?php
				endforeach;
			}
		?>
	</div>
</div>
<div style="clear: both"></div>
<div class="comprados">
	<h1>Últimos Productos vistos</h1>
	<?php //$productsVisited= $this -> requestAction('/visited_products/visited');?>
	<?php //echo $this -> element('listado_producto',array('products'=>$productsVisited));?>
	<div style="clear: both"></div>
	<h1>Productos Comprados</h1>
	<div style="clear: both"></div>
</div>