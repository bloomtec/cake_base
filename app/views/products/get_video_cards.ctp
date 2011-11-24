<?php 
	if(!$selectedId) $selectedId = null;  
	echo $form->radio('memory_card_id',$videoCards,array('legend'=>false,'value'=> $selectedId));
?>