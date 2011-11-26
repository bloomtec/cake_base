<?php 
	$selectedId = $selectedId1 = null; // los seleccionados en a variable pc
?>
<div rel='1'>
	<h3>Tarjeta de Video (opcional):</h3>
	<?php echo $form->radio('video_card_id',$items,array('legend'=>false,'value'=>$selectedId)); ?>	
</div>	
<div rel='2'>
	<h3>Segunda tarjeta de Video (opcional):</h3>
	<?php echo $form->radio('video_card_id2',$items,array('legend'=>false,'value'=>$selectedId2)); ?>
</div>
