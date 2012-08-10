<div id="footer">
	<div class="wrapper">
		<div class="derecha">
			<h1><?php __('Corre la voz'); ?></h1>
			<p><?php __('Comopromos, Todas las promociones de comida a domicilio de tu ciudad, en un solo lugar.') ?>
			</p>
			<div class="compartir">
				<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://comopromos.com" data-text="<?php __('Comopromos, todas las promociones de comida a domicilio de tu ciudad, en un solo lugar')?>" data-via="comopromos" >Tweet</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</div>
			<div class="compartir">
				<div class="fb-like" data-href="http://comopromos.com" data-send="false" data-layout="button_count" data-width="200" data-show-faces="false"></div>
			</div>
			<div class="sponsors">
				<?php echo $this -> Html -> image('colombia_pasion.png',array('class'=>'colombia','width'=>'200'));?>
				<?php echo $this -> Html -> link($this -> Html -> image('cms/logo-blanco.png'),'http://bloomweb.co',array('escape'=>false,'target'=>'_BLANK'));?>
				<div style="clear:both;"></div>
			</div>

		</div>
		<div class="izquierda">
			<h1><?php __('Terminos y condiciones'); ?></h1>
			<p>
				<?php __('Esta página recoge los términos y condiciones en virtud de los cuáles le proporcionamos nuestros servicios (“Términos y condiciones de la Web”). Por favor, lea atentamente estos términos y condiciones antes de realizar un pedido en nuestra página Web.'); ?>
				<br/>
				<br/>
				<?php __('Deberá entender, que mediante la realización de un pedido, acepta someterse a los presentes términos y condiciones.'); ?>
				<br/>
				<a class="ver_mas" href="/pages/terminosYCondiciones"><?php __('Ver Más'); ?></a>
			</p>
			<div style="clear: both"></div>
			<a href="/pages/comoComprar"><?php __('Cómo comprar'); ?></a>
			<a href="/pages/nuestraEmpresa"><?php __('Nuestra empresa'); ?></a>
			<a href="/pages/dudas"><?php __('¿Tienes alguna sugerencia, queja o reclamo?'); ?></a>
			<a href="/pages/sugierenos"><?php __('Sugierenos un restaurante'); ?></a>
			<a href="/pages/privacidad"><?php __('Privacidad'); ?></a>
			<a href="/pages/contacto"><?php __('Contáctenos'); ?></a>
			<a href="/owner"><?php __('Ingreso a propietarios'); ?></a>
		</div>

		<a class="volver_arriba" href="#"><?php __('Volver Arriba'); ?></a>
		<div style="clear: both"></div>
	</div>
</div>