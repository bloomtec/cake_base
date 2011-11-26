<?php 
	$selectedId=$selectedId1 = null; // los seleccionados en a variable pc
?>
<div rel='1'>
	<h3>Memoria:</h3>
	<?php echo $form->radio('memory_id',$memories,array('legend'=>false,'value'=>$selectedId)); ?>	
</div>	
<div rel='2'>
	<h3>Segunda Memoria (obligatorio):</h3>
	<?php echo $form->radio('memory_id2',$memories,array('legend'=>false,'value'=>$selectedId1)); ?>
</div>