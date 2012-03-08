<div class="menu_usuario">
	<ul>
		<li><a href="/users/profile">Mis Datos</a></li>
		<li><a href="/users/edit/<?php echo $this -> Session -> read('Auth.User.id')?>">Completar o modificar mis datos</a></li>
		<li><a href="/users/refer">Referir Amigos</a></li>
		<li><a href="/users/logout">Cerrar sesión</a></li>
	</ul>
</div>