<div>
	<h3>Torre</h3>
	<?php 
		$selectedId = null;
		if($selected_id) {
			$selectedId = $selected_id;
		}
		echo $form->radio('casing_id',$casings,array('legend'=>false,'value'=>$selectedId));
	?>
</div>