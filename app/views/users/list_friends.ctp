<div class="nomina">
		<?php
			if(isset($friends) && !empty($friends))
				foreach($friends as $friend):
		?>
			<div class="player">
				<?php echo $html->image($friend["UserField"][0]["image"],array("width"=>120));?>
			</div>
		<?php endforeach;?>		
</div>
<div class="paging">
	<?php if(isset($this->Paginator) && !empty($this->Paginator)) { ?>
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	<?php } ?>
</div>