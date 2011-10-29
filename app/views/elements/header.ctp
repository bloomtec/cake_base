<div id="header">
	<div class="wrapper">
		<ul class='nav-usuario'>
		<?php if($session->read('Auth.User.id')){ ?>
			<li><a class='mi-cuenta' href='/users/profile'>Mi cuenta</a></li>
		<?php }else{?>
			<li><a class='mi-cuenta login' href='/users/login'>Ingresar</a></li> <li> / <a class='mi-cuenta login' href='/users/register'>Registrarse</a> </li> 
		<?php } ?>
		</ul>
		<a class="logo_header" href="/">Excelenter</a>
		<?php echo $form->create('Product',array('controller'=>'products','action'=>'searchResults'))?>
			<input type="text" class="input_buscar" placeholder="Buscar..." name='data[query]'/>
			<input type="submit" class="submit" value="" />
		</form>
		<ul id="main_menu">
			<li>
				<a href="/">INICIO</a>
			</li>
			<li>
				<a href="#">PRODUCTOS</a>
				<div class="desplegable">
					
					<ul class="izq">
						<li>
							<a href="/categorias/procesadores">Procesadores</a>
						</li>
						<li>
							<a href="/categorias/tarjetas-madre">Tarjeras madre</a>
						</li>
						<li>
							<a href="/categorias/memorias">Memorias</a>
						</li>
						<li>
							<a href="/categorias/discos-duros">Discos duros</a>
						</li>
						<li>
							<a href="/categorias/tarjetas-de-video">Tarjetas de video</a>
						</li>
						<li>
							<a href="/categorias/tarjetas-de-sonido">Tarjetas de sonido</a>
						</li>
						<li>
							<a href="/categorias/torres">Torres</a>
						</li>
						<li>
							<a href="/categorias/monitores">Monitores</a>
						</li>
						<li>
							<a href="/categorias/otras-tarjetas">Otras Tarjetas</a>
						</li>
						<li>
							<a href="/categorias/software">Software</a>
						</li>
					</ul>
					<ul class="der">
						<li>
							<a href="/categorias/gamers">Gamers</a>
						</li>
						<li>
							<a href="/categorias/computadores-de-escritorio">Computadores de escritorio</a>
						</li>
						<li>
							<a href="/categorias/computadores-portatiles">Computadores portátiles</a>
						</li>
						<li>
							<a href="/categorias/accesorios">Accesorios</a>
						</li>
						<li>
							<a href="/categorias/impresoras">Impresoras</a>
						</li>
						<li>
							<a href="/categorias/dispositivos-usb">Dispositivos usb</a>
						</li>
						<li>
							<a href="/categorias/cables">Cables</a>
						</li>
						<li>
							<a href="/categorias/periféricos">Periféricos</a>
						</li>						
						<li>
							<a href="/categorias/camaras-web-y-digitales">Camaras web y digitales</a>
						</li>
					</ul>
					<div style="clear: both"></div>
				</div>
			</li>
			<li>
				<a href="/empresa">EMPRESA</a>
			</li>
			<li class="ultimo">
				<a href="/contacto">CONTÁCTENOS</a>
			</li>
			<div style="clear: both"></div>
		</ul>
	</div>
</div>