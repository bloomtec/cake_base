<div class="slide">
	<?php echo $this->Html->image($this -> webroot.'img/uploads/'.$large_image); ?>
</div>
<div class="deals-list">
	<?php
		foreach ($deals as $deal) {
			echo $this->element('product_list', array('deal'=>$deal));
		}
	?>
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