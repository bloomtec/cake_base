<div>
	<p>
		<?php echo __('Deals regarding ', true) . $deal['Deal']['name'] . __(' have finished.', true); ?>
	</p>
	<p>
		<?php echo __('Please contact your local representative if you wish to add more deals to your restaurant ', true) . $restaurant['Restaurant']['name']; ?>
	</p>
	<p>
		<?php echo __('Thank you for using ', true) . Configure::read('site_domain'); ?>
	</p>
</div>