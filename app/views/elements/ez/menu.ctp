<ul id="main_menu">
	<li>
		<a href=""><?php __('HOME'); ?></a>
	</li>

	
	<li>
		<a href=""><?php __('CONTENT')?></a>
		<ul>
			<li>
				<?php echo $html->link(__('PAGES',true),array('controller'=>'pages'));?>

			</li>
		</ul>
	</li>
	
	<li>
		<?php echo $html->link(__('DEALS',true),array('controller'=>'deals'));?>
	</li>
	
	<li>
		<a href='#'> <?php __('SETTINGS') ?></a>
		<ul>
			<?php if($session -> read('Auth.User.role_id') == 1): ?>
			<li><?php echo $html->link(__('COUNTRIES',true),array('controller'=>'countries'));?></li>
			<li><?php echo $html->link(__('ADD COUNTRY',true),array('controller'=>'countries','action' => 'add'));?></li>
			<li><?php echo $html->link(__('CITIES',true),array('controller'=>'cities'));?></li>
			<li><?php echo $html->link(__('ADD CITY',true),array('controller'=>'cities','action' => 'add'));?></li>
			<li><?php echo $html->link(__('RESTAURANTS',true),array('controller'=>'restaurants'));?></li>
			<?php endif; ?>
			<li><?php echo $html->link(__('ADD RESTAURANT',true),array('controller'=>'restaurants','action' => 'add'));?></li>
		</ul>	
	</li>
	
	<?php if($session -> read('Auth.User.role_id') == 1): ?>
	<li>
		<?php echo $html->link(__('USERS',true),array('controller'=>'users'));?>
		<ul>
			<li><?php echo $html->link(__('ADD USER',true),array('controller'=>'users','action' => 'add'));?></li>
		</ul>
	</li>
	<?php endif; ?>

	<li class="final">
		<?php echo $html->link(__('EXIT',true),array('controller'=>'users','action'=>'logout'));?>

	</li>
</ul>
