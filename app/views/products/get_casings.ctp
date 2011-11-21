<?php 
	if(!$selectedId) $selectedId = null; 
	echo $form->radio('casing_id',$casings,array('legend'=>false,'value'=>$selectedId));
?>