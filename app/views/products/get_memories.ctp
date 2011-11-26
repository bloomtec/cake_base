<?php 
	$selecteds = array(); // los seleccionados en a variable pc
?>
<div rel='1'>
<?php echo $form->radio('memory_id',$memories,array('legend'=>false,'value'=>$selectedId)); ?>	
</div>	
<div rel='2'>
<?php echo $form->radio('memory_id2',$memories,array('legend'=>false,'value'=>$selectedId)); ?>
</div>