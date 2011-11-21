<?php 
	if(!$selectedId) $selectedId = null; 
	echo $form->radio('supply_id',$supplies,array('legend'=>false,'value'=>$selectedId));
?>