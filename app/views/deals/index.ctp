<div class="slide">
<!-- container for the slides -->
<div class="images">
	
	<?php foreach($large_images as $large_image): ?>
    <!-- first slide -->
    <div><?php echo $this->Html->link($this->Html->image($this -> webroot.'img/uploads/'.$large_image['Deal']['image_large']),array('controller'=>'deals',"action"=>'view',$large_image['Deal']['slug']),array('escape'=>false)); ?></div>
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
			echo $this->Paginator->counter(array('format' => __('Página %page% de %pages%, mostrando %current% promociones de un total de %count%', true)));
		?>
	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('anterior', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('siguiente', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>

<script type="text/javascript">
	$(".slidetabs").tabs(".images > div", {
	effect: 'fade',
	fadeOutSpeed: "slow",
	rotate: true,	
	
	
}).slideshow({
	autoplay:true,
	clickable:false,
	interval:4000
	});
</script>