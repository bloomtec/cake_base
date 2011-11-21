<?php 
	if(!$selectedId) $selectedId = key($videoCards);  
	echo $form->radio('memory_id',$videoCards,array('legend'=>false,'value'=> $selectedId));
?>