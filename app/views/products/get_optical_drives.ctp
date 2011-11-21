<?php 
	if(!$selectedId) $selectedId = null;  
	echo $form->radio('drive_id',$drives,array('legend'=>false,'value'=>$selectedId));
?>