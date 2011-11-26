<?php 
	$selectedId=$selectedId1 = null; // los seleccionados en a variable pc
?>
<div rel='1'>
	<h3>Otras Tarjetas:</h3>
	<?php echo $form->radio('other_cards_id',$items,array('legend'=>false,'value'=>$selectedId)); ?>	
</div>	