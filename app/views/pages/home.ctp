<style>
.slider {
    border:1px solid #ccc;
    position:relative;
    width:640x;
    float:left;
    cursor:pointer;
	height:238px;
}

/* single slide */
.slider div {
    display:none;
    position:absolute;
    top:0;
    left:0;
    height:223px;
    font-size:12px;
}
.slider div img{
	width:640px;
}
/* header */
.slider h3 {
    font-size:22px;
    font-weight:normal;
    margin:0 0 20px 0;
    color:#456;
}

/* tabs (those little circles below slides) */
.slidetabs {
    clear:both;
    margin-left:310px;
	margin-bottom:10px;
}

/* single tab */
.slidetabs a {
    width:8px;
    height:8px;
    float:left;
    margin:3px;
    background:url(/img/navigator.png) 0 0 no-repeat;
    display:block;
    font-size:1px;
}

/* mouseover state */
.slidetabs a:hover {
    background-position:0 -8px;
}

/* active state (current page state) */
.slidetabs a.current {
    background-position:0 -16px;
}


/* disabled navigational button. is not needed when tabs are
   configured with rotate: true */
.disabled {
    visibility:hidden !important;
}
</style>
<div class="slider">
	<div>	
		<a href="/pages/venta-de-software/">
			<img src="/img/banners/slide1.jpg"/>	
		</a>
	</div>
	<div>
		<a href="/pages/mantenimiento/">
			<img src="/img/banners/slide2.jpg"/>	
		</a>
	</div>
	<div>	
		<a href="/pages/servicio-a-domicilio/">
			<img src="/img/banners/slide4.jpg"/>
		</a>		
	</div>
	<div>	
		<a href="/pages/tienda-virtual/">
			<img src="/img/banners/slide3.jpg"/>
		</a>		
	</div>
	<span style="display:block;clear:both;"></span>
</div>
<div class="slidetabs">
  <a href="#"></a>
  <a href="#"></a>
  <a href="#"></a>
  <a href="#"></a>
</div>
<script type="text/javascript">
	$(function(){
		 $(".slidetabs").tabs(".slider > div", { 
		// enable "cross-fading" effect
		effect: 'fade',
		fadeOutSpeed: "slow",	 
		// start from the beginning after the last tab
		rotate: true	 
		// use the slideshow plugin. It accepts its own configuration
		}).slideshow({
			autoplay:true,
			clickable:false
		});
	});
</script>
<br />
<div class="info_inicio">
	<img src="/img/computadores.jpg" />
	<h1>Visita nuestra tienda virtual</h1>
	<p>
		En nuestra tienda virtual encontraras una gran variendad de equipos, partes y accesorios para computadores en un solo lugar.
	</p>
	<br />
	<p>
		Todos nuestros productos son de la mas alta calidad y tienen la garantia de una empresa con mas de 5 años de experiencia en la comercializacion de partes y accesorios para PCs
	</p>
	
	<a href="">Ir a la tienda</a>
	<div style="clear: both"></div>
</div>
<div class="info_inicio ultimo">
	<img alt="Nuestra Ubicación" style='float:left; margin-right:20px;' src="http://maps.googleapis.com/maps/api/staticmap?maptype=normal&zoom=15&size=320x225&sensor=true&markers=icon:http://chart.googleapis.com/chart?=|<?php echo "3.466288678446261" ?>,<?php echo "-76.52737259864807" ?>" />
	<h1>Nuestras Tiendas</h1>
	<p>
		Excelenter se encuentran en el Centro Comercial La Pasarela locales 225 y 266 . 
		<br /><br /> Atendemos de lunes a sábados de 9 am a 7 pm.
		<br /><br /> Direccion: Av 5an Nº 23dn-68, Cali - Colombia 
		<br /><br /> Télefonos (2) 660 50 79  - (2) 667 71 16		
	</p>
	<div style="clear: both"></div>
</div>
