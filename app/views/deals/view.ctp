<div class="deals view">
	<img src="/img/uploads/400x400/<?php echo $deal['Deal']['image'];?>" />
	<h1><?php echo $deal['Deal']['name'];?></h1>
	<div class="info_producto">
		<h2 class="precio">Nuestro Precio: $<?php echo  number_format($deal['Deal']['price'], 0, ",", ".");?></h2>
		<h2 class="precio_regular">Precio regular: $<?php echo number_format($deal['Deal']['normal_price'], 0, ",", ".");?></h2>
		<div style="clear: both;"></div>
		<ul>
			<?php if(isset($deal['Deal']['expires']) && !empty($deal['Deal']['expires'])) : ?>
			<li>
				Finaliza el <?php echo $deal['Deal']['expires'];?>
			</li>
			<?php endif; ?>
			<li>
				Promoción válida solo por internet 
			</li>
			<li>
				Horario de atención: <?php echo $deal['Restaurant']['schedule'];?>
			</li>
			<li>
				Tel: <?php echo $deal['Restaurant']['phone'];?>
			</li>
			<!--
			<li>
				<?php echo $deal['Deal']['conditions'];?>
			</li>
			-->
			
			<li>
				<?php echo $this->Html->link(__('Ver terminos y condiciones',true),array('controller'=>'pages','action'=>'terminosYCondiciones'),array('target'=>'_blank'));?>
			</li>
		</ul>
		<div style="clear: both"></div>
		<a class="comprar" href="/orders/add/<?php echo $deal['Deal']['slug']; ?>"></a>
	</div>
	<div class="descripcion_producto">
		<h1 class="descripcion">Descripción del producto<img src="/img/descripcion_bg.png" /></h1>
		<h2><?php echo $deal['Deal']['name'];?></h2>
		<p>
			<?php echo $deal['Deal']['description'];?>
		</p>
	</div>
	
</div>
<?php $this -> requestAction('deals/addVisitCount/'.$deal['Deal']['id']); ?>
<!--
<script type="text/javascript">
	function initialize() {
		var myLatlng = new google.maps.LatLng(<?php echo $deal['Restaurant']['lat']; ?>, <?php echo $deal['Restaurant']['long']; ?>);
		var myOptions = {
			zoom : 17,
			center : myLatlng,
			mapTypeId : google.maps.MapTypeId.ROADMAP
		}
		var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

		var image = '/img/restaurant.png';
		var marker = new google.maps.Marker({
		    position: myLatlng,
		    title:"<?php echo $deal['Restaurant']['name']; ?>",
		    icon: image
		});

		// To add the marker to the map, call setMap();
		marker.setMap(map);
	}

	function loadScript() {
		var script = document.createElement("script");
		script.type = "text/javascript";
		script.src = "http://maps.googleapis.com/maps/api/js?sensor=true&region=CO&callback=initialize";
		document.body.appendChild(script);
	}
	
	window.onload = loadScript;
</script>
-->