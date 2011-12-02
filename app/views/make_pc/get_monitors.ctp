<?php 
	$selectedId1 = $selectedId2 = null; // los seleccionados en a variable pc
	if(isset($selected_id_1)) {
		$selectedId1 = $selected_id_1;
	}
	if(isset($selected_id_2)) {
		$selectedId2 = $selected_id_2;
	}
?>

<div class="inclusivo opcional" rel="Monitor">
	<h3>Monitor</h3>
	<?php echo $form->radio('monitor_id1',$items,array('legend'=>false,'value'=>$selectedId1, 'rel'=>'1')); ?>	
	<h3>Segundo Monitor (opcional):</h3>
	<?php echo $form->radio('monitor_id2',$items,array('legend'=>false,'value'=>$selectedId2, 'rel'=>'2')); ?>	
</div>