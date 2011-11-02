<!-- the form -->
<form action="#" class="aplicacion">

	
	<div class="panes">
		<div></div>
		<div>Second tab content</div>
		<div>Third tab content</div>
		<div>First tab content. Tab contents are called "panes"</div>
		<div>Second tab content</div>
		<div>Third tab content</div>
		<div>First tab content. Tab contents are called "panes"</div>
		<div>Second tab content</div>
		<div>Third tab content</div>
		<div>First tab content. Tab contents are called "panes"</div>
		<div>Second tab content</div>
	</div>
		<a class="prev browse left"></a>
		<div class="scrollable">   
			<ul class='tabs items'>
				<li><a href="#">Procesador y tarjeta madre<img src="/img/procesador.png" /></a></li>
				<li><a href="#">Tarjeta de video<img src="/img/ram.png" /></a></li>
				<li><a href="#">Memoria Ram<img src="/img/ram.png" /></a></li>
				<li><a href="#">Discos duros<img src="/img/disco_duro.png" /></a></li>
				<li><a href="#">Monitor<img src="/img/monitor.png" /></a></li>
				<li><a href="#">Torre<img src="/img/ram.png" /></a></li>
				<li><a href="#">Fuente<img src="/img/ram.png" /></a></li>
				<li><a href="#">Unidades ópticas<img src="/img/ram.png" /></a></li>
				<li><a href="#">Periféricos<img src="/img/ram.png" /></a></li>
				<li><a href="#">Tarjetas adicionles<img src="/img/tarjeta_adicional.png" /></a></li>
				<li><a href="#">Accesorios<img src="/img/ram.png" /></a></li>
			</ul>
		</div>
		<a class="next browse right"></a>
		<div style="clear: both"></div>
</form>


<script type="text/javascript">
$(function() {
	// setup ul.tabs to work as tabs for each div directly under div.panes
	$("ul.tabs").tabs("div.panes > div");
	$(".scrollable").scrollable();
});
	
	
</script>