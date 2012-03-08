<div class="menu_usuario">
	<ul>
		<li><a href="/users/profile"><?php __('My Orders')?></a></li>
		<li><a href="/users/edit/<?php echo $this -> Session -> read('Auth.User.id')?>"><?php __('Update Info')?></a></li>
		<li><a href="/users/updateAddresses/<?php echo $this -> Session -> read('Auth.User.id')?>"><?php __('Update Addresses')?></a></li>
		<li><a href="/users/refer"><?php __('Refer Friends')?></a></li>
		<li><a href="/users/logout"><?php __('Log out')?></a></li>
	</ul>
</div>