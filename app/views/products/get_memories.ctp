<?php 
	if(!$selectedId) $selectedId = null; 
	echo $form->radio('memory_id',$memories,array('legend'=>false,'value'=>$selectedId));
?>