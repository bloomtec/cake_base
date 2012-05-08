<div class="users refer">
	<h1><?php __('Referir amigos'); ?></h1>
	<p><?php __('Cuéntale a tus amigos acerca de nuestra página y acumula dinero!!'); ?></p>
	<?php echo $this -> element('user/refer'); ?>

	<a class="compartir"href="javascript: void(0);" onclick="window.open('http://www.facebook.com/sharer.php?t=titulo&u=<?php echo urlencode("http://".Configure::read('site_domain').'/users/register/').$code;?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');"><img src="/img/compartir.png" /></a>
	<div style="clear:both"></div>
	<div class="fb-like" data-href="<?php echo urlencode("http://".Configure::read('site_domain').'/users/register/').$code;?>" data-send="true" data-width="450" data-show-faces="false"></div>
</div>