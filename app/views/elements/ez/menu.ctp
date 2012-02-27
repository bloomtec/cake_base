<ul id="main_menu">
	<li>
		<?php $prefix = $this -> params['prefix']; ?>
		<a href="/<?php echo $prefix; ?>/pages/ez"><?php __('HOME'); ?></a>
	</li>
	<?php if($session -> read('Auth.User.role_id') == 1 || $session -> read('Auth.User.role_id') == 2) : ?>
	<li>
		<a href=""><?php __('CONTENT'); ?></a>
		<ul>
			<li>
				<?php echo $html -> link(__('PAGES', true), array('controller' => 'pages', 'action' => 'index')); ?>
			</li>
			<?php if($session -> read('Auth.User.role_id') == 1) : ?>
			<li>
				<?php echo $html -> link(__('PRIZES', true), array('controller' => 'prizes', 'action' => 'index')); ?>
			</li>
			<li>
				<?php echo $html -> link(__('ADD PRIZE', true), array('controller' => 'prizes', 'action' => 'add')); ?>
			</li>
			<?php endif; ?>
		</ul>
	</li>
	<?php endif; ?>
	<li>
		<?php echo $html -> link(__('DEALS', true), array('controller' => 'deals', 'action' => 'index')); ?>
	</li>
	<?php if($this -> Session -> read('Auth.User.role_id') != 4) : ?>
	<li>
		<a href='#'> <?php __('SETTINGS'); ?></a>
		<ul>
			<?php if($session -> read('Auth.User.role_id') == 1) : ?>
			<li>
				<?php echo $html -> link(__('CONFIG', true), array('controller' => 'config', 'action' => 'edit', 1)); ?>
			</li>
			<li>
				<?php echo $html -> link(__('COUNTRIES', true), array('controller' => 'countries', 'action' => 'index')); ?>
			</li>
			<li>
				<?php echo $html -> link(__('ADD COUNTRY', true), array('controller' => 'countries', 'action' => 'add')); ?>
			</li>
			<li>
				<?php echo $html -> link(__('CITIES', true), array('controller' => 'cities', 'action' => 'index')); ?>
			</li>
			<li>
				<?php echo $html -> link(__('ADD CITY', true), array('controller' => 'cities', 'action' => 'add')); ?>
			</li>
			<li>
				<?php echo $html -> link(__('CUISINES', true), array('controller' => 'cuisines', 'action' => 'index')); ?>
			</li>
			<li>
				<?php echo $html -> link(__('ADD CUISINE', true), array('controller' => 'cuisines', 'action' => 'add')); ?>
			</li>
			<?php endif; ?>
			<?php if($session -> read('Auth.User.role_id') == 1 || $session -> read('Auth.User.role_id') == 2) : ?>
			<li>
				<?php echo $html -> link(__('ZONES', true), array('controller' => 'zones', 'action' => 'index')); ?>
			</li>
			<li>
				<?php echo $html -> link(__('ADD ZONE', true), array('controller' => 'zones', 'action' => 'add')); ?>
			</li>
			<?php endif;?>
			<li>
				<?php echo $html -> link(__('RESTAURANTS', true), array('controller' => 'restaurants', 'action' => 'index')); ?>
			</li>
			<li>
				<?php echo $html -> link(__('ADD RESTAURANT', true), array('controller' => 'restaurants', 'action' => 'add')); ?>
			</li>
		</ul>
	</li>
	<?php endif; ?>
	<?php if($this -> Session -> read('Auth.User.role_id') == 4) : ?>
	<li>
		<?php echo $html -> link(__('RESTAURANTS', true), array('controller' => 'restaurants', 'action' => 'index')); ?>
	</li>
	<?php endif; ?>
	<?php if($session -> read('Auth.User.role_id') == 1) : ?>
	<li>
		<?php echo $html -> link(__('USERS', true), array('controller' => 'users')); ?>
		<ul>
			<li>
				<?php echo $html -> link(__('ADD USER', true), array('controller' => 'users', 'action' => 'add')); ?>
			</li>
		</ul>
	</li>
	<?php endif; ?>

	<li class="final">
		<?php echo $html -> link(__('EXIT', true), array('controller' => 'users', 'action' => 'logout')); ?>
	</li>
</ul>
