<ul id="main_menu">
	<li>
		<?php $prefix = $this -> params['prefix']; ?>
		<a href="/<?php echo $prefix; ?>/pages/ez"><?php __('INICIO'); ?></a>
	</li>
	<!--
	<?php if($this -> Session -> read('Auth.User.role_id') == 1 || $this -> Session -> read('Auth.User.role_id') == 2) : ?>
	<li>
		<a href=""><?php __('CONTENIDO'); ?></a>
		<ul>
			<li>
				<?php echo $html -> link(__('PAGINAS', true), array('controller' => 'pages', 'action' => 'index')); ?>
			</li>
			<?php //if($this -> Session -> read('Auth.User.role_id') == 1) : ?>
			<li>
				<?php echo $html -> link(__('PREMIOS', true), array('controller' => 'prizes', 'action' => 'index')); ?>
			</li>
			<li>
				<?php echo $html -> link(__('AGREGAR PREMIO', true), array('controller' => 'prizes', 'action' => 'add')); ?>
			</li>
			<?php //endif; ?>
		</ul>
	</li>
	<?php endif; ?>
	-->
	<li>
		<?php echo $html -> link(__('PROMOS', true), array('controller' => 'deals', 'action' => 'index')); ?>
	</li>
	<li>
		<?php echo $html -> link(__('ORDENES', true), array('controller' => 'orders', 'action' => 'index')); ?>
	</li>
	<?php if($this -> Session -> read('Auth.User.role_id') != 4) : ?>
	<li>
		<a href='#'> <?php __('CONFIGURACIONES'); ?></a>
		<ul>
			<?php if($this -> Session -> read('Auth.User.role_id') == 1) : ?>
			<li>
				<?php echo $html -> link(__('OPCIONES', true), array('controller' => 'config', 'action' => 'edit', 1)); ?>
			</li>
			<li>
				<?php echo $html -> link(__('PAÍSES', true), array('controller' => 'countries', 'action' => 'index')); ?>
			</li>
			<li>
				<?php echo $html -> link(__('AGREGAR PAÍS', true), array('controller' => 'countries', 'action' => 'add')); ?>
			</li>
			<li>
				<?php echo $html -> link(__('CIUDADES', true), array('controller' => 'cities', 'action' => 'index')); ?>
			</li>
			<li>
				<?php echo $html -> link(__('AGREGAR CIUDAD', true), array('controller' => 'cities', 'action' => 'add')); ?>
			</li>
			<li>
				<?php echo $html -> link(__('COCINAS', true), array('controller' => 'cuisines', 'action' => 'index')); ?>
			</li>
			<li>
				<?php echo $html -> link(__('AGREGAR COCINA', true), array('controller' => 'cuisines', 'action' => 'add')); ?>
			</li>
			<?php endif; ?>
			<?php if($this -> Session -> read('Auth.User.role_id') == 1 || $this -> Session -> read('Auth.User.role_id') == 2) : ?>
			<li>
				<?php echo $html -> link(__('BARRIOS', true), array('controller' => 'zones', 'action' => 'index')); ?>
			</li>
			<li>
				<?php echo $html -> link(__('AGREGAR BARRIO', true), array('controller' => 'zones', 'action' => 'add')); ?>
			</li>
			<?php endif;?>
			<li>
				<?php echo $html -> link(__('RESTAURANTES', true), array('controller' => 'restaurants', 'action' => 'index')); ?>
			</li>
			<li>
				<?php echo $html -> link(__('AGREGAR RESTAURANTE', true), array('controller' => 'restaurants', 'action' => 'add')); ?>
			</li>
		</ul>
	</li>
	<?php endif; ?>
	<?php if($this -> Session -> read('Auth.User.role_id') == 4) : ?>
	<li>
		<?php echo $html -> link(__('RESTAURANTES', true), array('controller' => 'restaurants', 'action' => 'index')); ?>
	</li>
	<?php endif; ?>
	<?php if($this -> Session -> read('Auth.User.role_id') == 1) : ?>
	<li>
		<?php echo $html -> link(__('USUARIOS', true), array('controller' => 'users')); ?>
		<ul>
			<li>
				<?php echo $html -> link(__('AGREGAR USUARIO', true), array('controller' => 'users', 'action' => 'add')); ?>
			</li>
		</ul>
	</li>
	<?php endif; ?>
	<li>
		<?php echo $html -> link(__('MODIFICAR CONTRASEÑA', true), array('controller' => 'users', 'action' => 'modifyPassword')); ?>
	</li>
	<li class="final">
		<?php echo $html -> link(__('SALIR', true), array('controller' => 'users', 'action' => 'logout')); ?>
	</li>
</ul>
