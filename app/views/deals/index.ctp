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
	<?php echo $this->element('deal/product_list'); ?>
</div>
	<p>
		<?php
			echo $this->Paginator->counter(array('format' => __('Página %page% de %pages%, mostrando %current% registros de un total de %count%, desde el %start%, hasta el %end%', true)));
		?>
	</p>
<?php if(count($deals) > 8):?>
	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('anterior', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('siguiente', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
<?php endif;?>
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