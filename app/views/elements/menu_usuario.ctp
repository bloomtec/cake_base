<div class="menu_usuario">
	<ul>
		<li><a href="/users/profile"><?php __('Mis Ordenes')?></a></li>
		<li><a href="/users/edit/<?php echo $this -> Session -> read('Auth.User.id')?>"><?php __('Datos Personales')?></a></li>
		<li><a href="/users/updateAddresses/<?php echo $this -> Session -> read('Auth.User.id')?>"><?php __('Direcciones')?></a></li>
		<li><a href="/users/refer"><?php __('Referir')?></a></li>
		<li><a href="/users/logout"><?php __('Salir')?></a></li>
	</ul>
</div>