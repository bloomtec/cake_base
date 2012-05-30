<div class="deals view">
	<h1><?php echo $deal['Deal']['name'];?></h1>
		<img src="/img/uploads/<?php echo $deal['Deal']['image'];?>" />
		<div class="info_producto">
		<h2 class="precio"><?php __('Nuestro Precio');?>: $<?php echo  number_format($deal['Deal']['price'], 0, ",", ".");?></h2>
		<h2 class="precio_regular"><?php __('Precio regular');?>: $<?php echo number_format($deal['Deal']['normal_price'], 0, ",", ".");?></h2>
		<div style="clear: both;"></div>
			<ul>
				<li>
					<?php __('Promoción válida solo por internet');?> 
				</li>
				<li>
					<?php __('Horario de atención');?>: <?php echo $deal['Restaurant']['schedule'];?>
				</li>
				<li>
					 <?php __('Promoción valida hasta: '); echo $deal['Deal']['expires'];  ?>
				</li>
				<li>
					<span style='color:#ED1C24'><?php __('Áreas de cobertura: '); ?></span> <?php echo $deal['Restaurant']['service_policies']; ?>
				</li>
				
				<li>
					<?php echo $this->Html->link(__('Ver terminos y condiciones',true),array('controller'=>'pages','action'=>'terminosYCondiciones'),array('target'=>'_blank'));?>
				</li>
			</ul>
		<div style="clear: both"></div>
		<div class='compra-actions'>
			<?php $score= $this -> requestAction('/users/getScore');?>
			<a title="<?php __('Compra este producto pagando en efectivo');?>" class="comprar boton" href="/orders/add/<?php echo $deal['Deal']['slug']; ?>"> <?php __('COMPRAR');?></a>
			<?php if($score > $deal['Deal']['price']): ?>
			<a title="<?php __('Compra este producto usando');?> <?php echo "$".number_format($deal['Deal']['price'], 0, ",", "."); ?> de los <?php echo "$".number_format($score, 0, ",", "."); ?> que tienes como bono!!!" class="redimir boton" href="/orders/add/<?php echo $deal['Deal']['slug']; ?>/redimir:1">  REDIMIR</a>
			<?php endif;?>
			<div style="clear:both"></div>
		</div>
		
	</div>
	<div class="descripcion_producto">
		<h1 class="descripcion"><?php __('Descripción del producto'); ?><img src="/img/descripcion_bg.png" /></h1>
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