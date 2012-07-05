<ul>
	<li>
		<a href="/users/profile"><?php __('Mis datos'); ?></a>
	</li>
	<li>
		<a href="/users/edit/<?php echo $session -> read('Auth.User.id');?>"><?php __('Completar o modificar mis datos'); ?></a>
	</li>
	<li>
		<a href="/users/changePassword/<?php echo $session -> read('Auth.User.id');?>"><?php __('Cambiar Contraseña'); ?></a>
	</li>
	<li>
		<a href="/users/logout"><?php __('Salir'); ?></a>
	</li>
	<li class="ultimo">
		<a class="carrito" href="/shopCarts/view-cart"><?php __('Ir a mi carrito'); ?></a>
	</li>
	<div style="clear: both"></div>
</ul>