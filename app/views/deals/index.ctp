<div class="slide">
<!-- container for the slides -->

<div class="images">
	
	<?php foreach($large_images as $large_image): ?>
    <!-- first slide -->
    <div><?php echo $this->Html->image($this -> webroot.'img/uploads/'.$large_image['Deal']['image_large']); ?></div>
    <?php endforeach; ?>

</div>

<!-- the tabs -->
<div class="slidetabs">
	<?php foreach($large_images as $large_image): ?>
    <!-- first slide -->
    <a href="#"></a>
    <?php endforeach; ?>
    <div style="clear: both"></div>
</div>
	
</div>
<div class="deals-list">
	<?php echo $this->element('product_list'); ?>
</div>
<p>
	<?php
		echo $this->Paginator->counter(
			array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true))
		);
	?>
</p>
<div class="paging">
	<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	|	<?php echo $this->Paginator->numbers();?>	|
	<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
</div>
<script type="text/javascript">
	$(".slidetabs").tabs(".images > div", {

	// enable "cross-fading" effect
	effect: 'fade',
	fadeOutSpeed: "slow",

	// start from the beginning after the last tab
	rotate: true

// use the slideshow plugin. It accepts its own configuration
}).slideshow();
</script>