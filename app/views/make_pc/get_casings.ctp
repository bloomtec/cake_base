<div>
	<h3>Torre</h3>
<?php 
	if(!$selectedId) $selectedId = null; 
	echo $form->radio('casing_id',$casings,array('legend'=>false,'value'=>$selectedId));
?>
</div>