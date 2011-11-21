<?php 
	if(!$selectedId) $selectedId = null; 
	echo $form->radio('motherboard_id',$motherboards,array('legend'=>false,'value'=>$selectedId));

?>