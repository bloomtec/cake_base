<?php 
/**
 * $pictures= pictures in gallery
 * $thumbsAtTime = max pictures at time in thumbs
 * Need jquery tools -> scrollable, tabs, slideshow plugin
 * 
 */
?>
<!--
	<img class="activa" src="" />
			<div class="prev_gallery"><a><img src="" /></a></div>
-->
<?php echo $this->Html->css('gallery-thumbs-scrollable'); ?>
<ul id="image_wrap" class="images">
	<!-- Initially the image is a simple 1x1 pixel transparent GIF -->
	<?php foreach($pictures as $picture):?>
		<li>
			<?php echo $html->image('uploads/' . $picture['path']); ?>
		</li>
	<?php endforeach;?>
</ul>
<div class="controls"> 
	<a class="next <?php if(count($picture)<$thumbsAtTime) echo 'disabled';?>" alt="next"> </a>
	<a class="prev" alt="prev"> </a>
	<div class="scrollable">
		<ul class="thumbs slidetabs items">
			<?php foreach($pictures as $picture):?>
				<li> <?php echo $html->image('uploads/100x100/' . $picture['path']); ?></li>
			<?php endforeach;?>
		</ul>
	</div>
</div>
<script type="text/javascript">
$(".slidetabs").tabs(".images > li", {

	// enable "cross-fading" effect
	effect: 'fade',
	fadeOutSpeed: "slow",
	event:"mouseover",
	// start from the beginning after the last tab
	rotate: true

// use the slideshow plugin. It accepts its own configuration
})/*.slideshow({autoplay:false})*/;
var numItems=$("ul.thumbs li").length;
$(".scrollable").scrollable({
	onSeek:function(e,index){
		if(index==0){
		$(".prev").addClass("disabled");
		}
		if(numItems-index < 6){
		$(".next").addClass("disabled");
		}
	}
});
/*
var dentro=true;
$(window).focus(function(){
	if(!dentro){
		$(".slidetabs").data("slideshow").play()
		dentro=true;
	}
	
});
$(window).blur(function(){
	$(".slidetabs").data("slideshow").stop()
	dentro=false;
	
});
*/
</script>