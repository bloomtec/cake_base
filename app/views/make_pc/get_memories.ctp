<?php 
	$selectedId1 = $selectedId2 = null; // los seleccionados en a variable pc
	if(isset($selected_id_1)) {
		$selectedId1 = $selected_id_1;
	}
	if(isset($selected_id_2)) {
		$selectedId2 = $selected_id_2;
	}
?>
<div class="exclusivo">
	<div rel='1'>
		<h3>Memoria:</h3>
		<?php echo $form -> radio('memory_id1', $items, array('legend'=>false,'value'=>$selectedId1)); ?>	
	</div>
	<div rel='2'>
		<h3>Segunda Memoria (opcional):</h3>
		<?php echo $form -> radio('memory_id2', $items, array('legend'=>false,'value'=>$selectedId2)); ?>
	</div>
</div>