<!-- the form -->
<form action="#">
	<!-- scrollable root element -->
	
	<div class="panes">
		<div><?php echo $this -> element(); ?></div>
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
		<a class="prev browse left">anterior</a>
		<div class="scrollable">   
			<ul class='tabs items'>
				<li><a href="#">Procesador y tarjeta madre</a></li>
				<li><a href="#">Tarjeta de video</a></li>
				<li><a href="#">Memeria Ram</a></li>
				<li><a href="#">Discos duros</a></li>
				<li><a href="#">Monitor</a></li>
				<li><a href="#">Torre</a></li>
				<li><a href="#">Fuente</a></li>
				<li><a href="#">Unidades ópticas</a></li>
				<li><a href="#">Periféricos</a></li>
				<li><a href="#">Tarjetas adicionles</a></li>
				<li><a href="#">Accesorios</a></li>
			</ul>
		</div>
		<a class="next browse right">siguiente</a>
</form>

<style>
	/* root element for tabs  */
.tabs { 
	list-style:none; 
	margin:0 !important; 
	padding:0;
	height:30px;
	border-bottom:1px solid #666;	
}

/* single tab */
.tabs li { 
	float:left;	 
	text-indent:0;
	padding:0;
	margin:0 !important;
	list-style-image:none !important; 
}

/* link inside the tab. uses a background image */
.tabs a { 
	background: url(/img/global/tabs.png) no-repeat -652px 0;
	font-size:11px;
	display:block;
	height: 30px;  
	line-height:30px;
	width: 111px;
	text-align:center;	
	text-decoration:none;siguiente 
	color:#000;
	padding:0px;
	margin:0px;	
	position:relative;
	top:1px;
}

.tabs a:active {
	outline:none;		
}

/* when mouse enters the tab move the background image */
.tabs a:hover {
	background-position: -652px -31px;	
	color:#fff;	
}

/* active tab uses a class name "current". it's highlight is also done by moving the background image. */
.tabs .current, .tabs .current:hover, .tabs li.current a {
	background-position: -652px -62px;		
	cursor:default !important; 
	color:#000 !important;
}

/* Different widths for tabs: use a class name: w1, w2, w3 or w2 */


/* width 1 */
.tabs .w1 			{ background-position: -519px 0; width:134px; }
.tabs .w1:hover 	{ background-position: -519px -31px; }
.tabs .w1.current { background-position: -519px -62px; }

/* width 2 */
.tabs .w2 			{ background-position: -366px -0px; width:154px; }
.tabs .w2:hover 	{ background-position: -366px -31px; }
.tabs .w2.current { background-position: -366px -62px; }


/* width 3 */
.tabs .w3 			{ background-position: -193px -0px; width:174px; }
.tabs .w3:hover 	{ background-position: -193px -31px; }
.tabs .w3.current { background-position: -193px -62px; }

/* width 4 */
.tabs .w4 			{ background-position: -0px -0px; width:194px; }
.tabs .w4:hover 	{ background-position: -0px -31px; }
.tabs .w4.current { background-position: -0px -62px; }


/* initially all panes are hidden */ 
.panes .pane {
	display:none;		
}
.scrollable {

	/* required settings */
	position:relative;
	overflow:hidden;
	width: 660px;
	height:90px;
}

/*
	root element for scrollable items. Must be absolutely positioned
	and it should have a extremely large width to accommodate scrollable items.
	it's enough that you set width and height for the root element and
	not for this element.
*/
.scrollable .items {
	/* this cannot be too large */
	width:20000em;
	position:absolute;
}

/*
	a single item. must be floated in horizontal scrolling.
	typically, this element is the one that *you* will style
	the most.
*/
.items div {
	float:left;
}

</style>
<script type="text/javascript">
$(function() {
	// setup ul.tabs to work as tabs for each div directly under div.panes
	$("ul.tabs").tabs("div.panes > div");
	$(".scrollable").scrollable();
});
	
	
</script>