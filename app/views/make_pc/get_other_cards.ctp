<?php 
	$selectedId1 = $selectedId2 = null; // los seleccionados en a variable pc
	if(isset($selected_id_1)) {
		$selectedId1 = $selected_id_1;
	}
	if(isset($selected_id_2)) {
		$selectedId2 = $selected_id_2;
	}
?>
<div rel='1'>
	<h3>Otras Tarjetas:</h3>
	<?php echo $form->radio('other_cards_id',$items,array('legend'=>false,'value'=>$selectedId)); ?>	
</div>	