<?php 
	$selectedId1 = $selectedId2 = null; // los seleccionados en a variable pc
	if(isset($selected_id_1)) {
		$selectedId1 = $selected_id_1;
	}
	if(isset($selected_id_2)) {
		$selectedId2 = $selected_id_2;
	}
?>
<div class="inclusivo" rel="HardDrive">
	<h3>Disco Duro:</h3>
	<?php if($items) echo $form->radio('drive_id1',$items,array('legend'=>false,'value'=>$selectedId1, 'rel'=>'1')); ?>	
	<h3>Segundo Disco Duro (opcional):</h3>
	<?php if($items) echo $form->radio('drive_id2',$items,array('legend'=>false,'value'=>$selectedId2, 'rel'=>'2')); ?>
</div>