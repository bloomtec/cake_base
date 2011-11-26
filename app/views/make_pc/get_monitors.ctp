<?php 
	$selectedId=$selectedId1 = null; // los seleccionados en a variable pc
?>
<div rel='1'>
	<h3>Monitor</h3>
	<?php echo $form->radio('monitor_id',$items,array('legend'=>false,'value'=>$selectedId)); ?>	
</div>	
<div rel='2'>
	<h3>Segundo Monitor (opcional):</h3>
	<?php echo $form->radio('monitor_id2',$items,array('legend'=>false,'value'=>$selectedId2)); ?>
</div>