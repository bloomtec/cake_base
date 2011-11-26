<?php 
	$selectedId=$selectedId1 = null; // los seleccionados en a variable pc
?>
<div rel='1'>
	<h3>Primer Disco Duro (obligatorio)::</h3>
	<?php echo $form->radio('drive_id',$items,array('legend'=>false,'value'=>$selectedId)); ?>	
</div>	
<div rel='2'>
	<h3>Segundo Disco Duro (opcional):</h3>
	<?php echo $form->radio('drive_id2',$items,array('legend'=>false,'value'=>$selectedId2)); ?>
</div>