<?php 
	$selectedId = null;
	if(isset($selected_id)) {
		$selectedId = $selected_id;
	}
	echo $form->radio('supply_id',$supplies,array('legend'=>false,'value'=>$selectedId));
?>