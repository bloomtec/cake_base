<?php 
	if(!$selectedId) $selectedId = null;  
	echo $form->radio('memory_id',$videoCards,array('legend'=>false,'value'=> $selectedId));
?>