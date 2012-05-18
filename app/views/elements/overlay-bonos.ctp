<style>
	#overlay_bonos h1 {
		font-size: 22px;
		left: 10px;
		position: absolute;
		top: 144px;
	}
	#overlay_bonos .body{
		position:absolute;
		top:172px;
		width:700px;
		left:25px;
	}
	#overlay_bonos h2{
		color:black;
		font-weight: bold;
		font-size: 18px;
		margin-top:15px;
		margin-bottom:10px;
	}
	#overlay_bonos .body li{
		list-style: circle;
		list-style-position: inside;
	}
</style> 
<div class="simple_overlay" id="overlay_bonos">
	<?php $plata=$this->requestAction("/deals/getMoneyForBuying")?>
	<h1><?php __("En comopromos tus domicilios te pueden salir gratis")?></h1>
	<div class='body'>
		<h2> <?php __("De que forma puedes acumular dinero?")?></h2>
		<ul>
			<li>
				<?php __("Registrate y automaticamente ya estas acumunado dinero.")?>
			</li>
			<li>
				<?php __("Invitando a tus amigos a ser parte de nuestra página.")?>
			</li>
			<li>
				<?php __("Comprando nuestras promociones, cualquier día y a cualquier hora.")?>
			</li>
		</ul>
		<h2> <?php __("Por favor ten en cuenta:")?></h2>
		<ul>
			<li>
				<?php echo __("Por cada mil pesos en compras que realices recibirás ",true).$plata.__(" pesos. Este dinero aparecerá al lado derecho de tu pantalla después de realizado tu registro y tu primera compra.",true)?>
			</li>
			<li>
				<?php __("Cuando tengas en dinero acumulado el valor de uno de de los domicilios lo podrás redimir.")?>
			</li>
			<li>
				<?php __("No podrás pagar con este dinero parte de tus domicilios, tu dinero debe cubrir el valor total de el domicilio que desees.")?>
			</li>
			<li>
				<?php __("El dinero que acumules en nuestro sitio web no es redimible por dinero en efectivo.")?>
			</li>
		</ul>
	</div>
</div>