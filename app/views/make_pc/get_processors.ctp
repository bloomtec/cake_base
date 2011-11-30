<?php
	$selectedId = null;
	if(isset($selected_id)) {
		$selectedId = $selected_id;
	}
	echo $form->radio('processor_id',$items,array('legend'=>false, 'value' => $selectedId));
?>