<?php 
	if(!$selectedId) $selectedId = null;
	if(!$selectedId2) $selectedId2 = null;
	echo 'Primer Disco Duro (obligatorio):'; 
	echo $form->radio('drive_id',$drives,array('legend'=>false,'value'=>$selectedId));
	
	echo "Segundo Disco Duro (opcional):";
	echo $form->radio('drive_id2',$drives,array('legend'=>false,'value'=>$selectedId2));
?>