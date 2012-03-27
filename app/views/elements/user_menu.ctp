<ul>
	<li>
		<a href="/users/profile">Mis datos</a>
	</li>
	<li>
		<a href="/users/edit/<?php echo $session -> read('Auth.User.id');?>">Completar o modificar mis datos</a>
	</li>
	<li>
		<a href="/users/changePassword/<?php echo $session -> read('Auth.User.id');?>">Cambiar Contraseña</a>
	</li>
	<li>
		<a href="/users/logout">Salir</a>
	</li>
	<li class="ultimo">
		<a class="carrito" href="/shopCarts/view-cart">Ir a mi carrito</a>
	</li>
	<div style="clear: both"></div>
</ul>