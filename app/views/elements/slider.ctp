<style>
	/* container for slides */
#slide {
	width:600px;
	height:220px;
	position:relative;
}
.slides {
	border:1px solid #ccc;
	position:relative;	
	height:220px;
	width:600px;
	float:left;	
	cursor:pointer;
	margin-top:0;
	
}

/* single slide */
.slides div {
	display:none;
	position:absolute;
	top:0;
	left:0;		
	margin:7px;
	padding:15px 30px 15px 15px;
	height:200px;
	font-size:12px;
}

/* header */
.slides h3 {
	font-size:22px;
	font-weight:normal;
	margin:0 0 20px 0;
	color:#456;
}

/* tabs (those little circles below slides) */
.slidetabs {
	clear:both;
	position:absolute;
	right: 10px;
	bottom: 10px;
}

/* single tab */
.slidetabs a {
	width:8px;
	height:8px;
	float:left;
	margin:3px;
	display:block;
	font-size:1px;	
	background:red;	
}

/* mouseover state */
.slidetabs a:hover {
	background-position:0 -8px;      
}

/* active state (current page state) */
.slidetabs a.current {
	background-position:0 -16px;     
} 	


/* prev and next buttons */
.forward, .backward {
	float:left;
	margin-top:140px;
	display:block;
	width:30px;
	height:30px;
	cursor:pointer;
	font-size:1px;
	text-indent:-9999em;	
}

/* next */
.forward 				{ background-position: 0 -30px; clear:right; }
.forward:hover 		{ background-position:-30px -30px; }
.forward:active 	 	{ background-position:-60px -30px; } 


/* prev */
.backward:hover  		{ background-position:-30px 0; }
.backward:active  	{ background-position:-60px 0; }

/* disabled navigational button. is not needed when tabs are configured with rotate: true */
.disabled {
	visibility:hidden !important;		
}
</style>

<div id='slide' class='border_radius'>
<div  class='slides border_radius'>

    <!-- first slide -->
    <?php foreach($slides as $slide):?>
    <div><?php echo $slide[$model]['wysiwyg_content'];?></div>
	<?php endforeach;?>

</div>
<div class="slidetabs">
	<?php foreach($slides as $slide):?>
    <a href="#"></a>
   	<?php endforeach; ?>
</div>

</div>
<script type="text/javascript">
$(function(){
	$(".slidetabs").tabs(".slides > div", {

	// enable "cross-fading" effect
	effect: 'fade',
	fadeOutSpeed: "slow",

	// start from the beginning after the last tab
	rotate: true

// use the slideshow plugin. It accepts its own configuration
	}).slideshow();
});
</script>