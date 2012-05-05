<?php
echo $html -> script('pc.js');
echo $html -> script('tab-pc.js');
?>
<div class='pc-error' style='display:none; position:fixed; top:0; left:0;'></div>
<?php $form -> create('PC', array('action' => 'armaTuPC'));?>
<div id="aplicacion">
<div class="panes">
	<div>
		<?php echo $this -> element('make-pc/procesadores-y-tarjetas-madres');?>
	<div>
		<?php echo $this -> element('make-pc/memorias-ram');?>
	</div>
	<div>
		<?php echo $this -> element('make-pc/discos-duros');?>
	</div>
	<div>
		<?php echo $this -> element('make-pc/tarjeta-video');?>
	</div>
	<div>
		<?php echo $this -> element('make-pc/torres');?>
	</div>
	<!-- OPCIONALES-->
	<div>
		<?php echo $this -> element('make-pc/unidades-optica');?>
	</div>
	<div>
		<?php echo $this -> element('make-pc/monitores');?>
	</div>
	<div>
		<?php echo $this -> element('make-pc/perifericos');?>
	</div>
	<div>
		<?php echo $this -> element('make-pc/tarjetas-adicionales');?>
	</div>

</div>
<div id="resumen">
	
</div>

<div class='browse'  style='clear:both;'>
	<div class="wrapper_browse">
		<a href="#" class="paso_anterior">
			<ul>
				<li>Paso Anterior</li>
			</ul>	
		</a>
		<a href="#" class="siguiente_paso">
			<ul>
				<li>Paso Siguiente</li>
			</ul>
		</a>
		<a href="#" class='pagar'>
			<ul>
				<li>Pagar</li>
			</ul>
		</a>
		<div style="clear: both"></div>
	</div>
</div>

<div class="scrollable">
	<ul class='tabs items'>
		<div>
			<li>
				<a href="#processor" id='processor'>
				<div class="img_wrapper"><img src="/img/procesador.png" />
				</div>Procesadores y tarjetas madre</a>
			</li>
			<li>
				<a href="#ram-cards" id='ram-cards'>
				<div class="img_wrapper"><img src="/img/ram.png" />
				</div>Memorias Ram</a>
			</li>
			<li>
				<a href="#hard-drive" id='hard-drive'>
				<div class="img_wrapper"><img src="/img/disco_duro.png" />
				</div>Discos duros</a>
			</li>
			<li>
				<a href="#video-card" id='video-card'>
				<div class="img_wrapper"><img src="/img/tarjeta_video.png" />
				</div>Tarjetas de video</a>
			</li>
			<li>
				<a href="#case" id='case'>
				<div class="img_wrapper"><img src="/img/torre.png" />
				</div>Torres</a>
			</li>
		</div>
		<!-- OPCIONALES-->
		<div>
			<li>
				<a href="#optical-drive" id='optical-drive'>
				<div class="img_wrapper"><img src="/img/cd.png" />
				</div>Unidades ópticas</a>
			</li>
			<li>
				<a href="#monitor" id='monitor'>
				<div class="img_wrapper"><img src="/img/monitor.png" />
				</div>Monitores</a>
			</li>
			<li>
				<a href="#peripherals" id='peripherals'>
				<div class="img_wrapper"><img src="/img/mouse.png" />
				</div>Teclado y Mouse</a>
			</li>
			<li>
				<a href="#other-cards" id='other-cards'>
				<div class="img_wrapper"><img src="/img/tarjeta_adicional.png" />
				</div>Tarjetas adicionles</a>
			</li>
		</div>
	</ul>
</div>
<div style="clear: both"></div>
</div>
</form>