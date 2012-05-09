<div class="users refer">
	<h1 style='float:none;clear: both;'><?php __('Referir amigos');?></h1>
	<div style="clear:both"></div>
	<?php echo $this -> element('user/refer');?>
	<!--
	<a class="compartir"href="javascript: void(0);" onclick="window.open('http://www.facebook.com/sharer.php?t=titulo&u=<?php echo urlencode("http://".Configure::read('site_domain').'/users/register/').$code;?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');"><img src="/img/compartir.png" /></a>
	-->
	<div class="compartir">
		<p>
			<?php __('Recomiendanos en facebook y acumula dinero!!');?>
		</p>
			<div class="fb-like" data-href="<?php echo urlencode("http://" . Configure::read('site_domain') . '/users/register/') . $code;?>" data-send="false" data-layout="button_count" data-width="450" data-height="30" data-show-faces="false" data-action="recommend"></div>
		<br />
	</div>
	<div class="compartir twitter">
		<p>
			<?php __('Twitteanos y acumula dinero!!');?>
			
		</p>
		<a href="twitter-share-button" class="twitter-share-button" data-url="<?php echo "http://" . Configure::read('site_domain') . '/users/register/'. $code;?>" data-text="<?php __("Registrate en Como Promos - Todas las promociones de comida a domicilio de tu ciudad, en un solo lugar")?>" data-lang="<?php if(Configure::read('Config.language')=="spa") echo "es"; else echo "en"?>" data-count="none">Twittear</a>
		<script>
			! function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if(!d.getElementById(id)) {
					js = d.createElement(s);
					js.id = id;
					js.src = "//platform.twitter.com/widgets.js";
					fjs.parentNode.insertBefore(js, fjs);
				}
			}(document, "script", "twitter-wjs");

		</script>
	</div>
	<div style="clear:both"></div>
</div>